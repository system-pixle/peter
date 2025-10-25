<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;

class ClassExportController extends Controller
{
    /**
     * Show export page (with dropdown for classes)
     */
    public function index()
    {
        // You can pull actual classes from DB if you have a table
        $classes = [
            'Grade 1', 'Grade 2', 'Grade 3', 'Grade 4', 'Grade 5',
            'Grade 6', 'Grade 7', 'Grade 8', 'Form 1', 'Form 2', 'Form 3', 'Form 4'
        ];

        return view('exports.classes', compact('classes'));
    }

    /**
     * Export selected class to Excel (CSV for now)
     */
    public function exportExcel($class_name)
    {
        $students = Student::where('class', $class_name)->get();

        if ($students->isEmpty()) {
            return back()->with('error', "No students found for {$class_name}");
        }

        $filename = 'students_' . str_replace(' ', '_', strtolower($class_name)) . '_' . now()->format('Y_m_d_His') . '.csv';

        $handle = fopen($filename, 'w+');
        fputcsv($handle, ['Name', 'Class', 'Admission No', 'Parent Contact', 'Created At']);

        foreach ($students as $student) {
            fputcsv($handle, [
                $student->name,
                $student->class ?? $class_name,
                $student->admission_no ?? '—',
                $student->parent_contact ?? '—',
                $student->created_at->format('Y-m-d'),
            ]);
        }

        fclose($handle);

        return response()->download($filename)->deleteFileAfterSend(true);
    }

    /**
     * Export selected class to PDF
     */
    public function exportPdf($class_name)
    {
        $students = Student::where('class', $class_name)->get();

        if ($students->isEmpty()) {
            return back()->with('error', "No students found for {$class_name}");
        }

        $pdf = Pdf::loadView('exports.class_pdf', [
            'students' => $students,
            'class_name' => $class_name
        ]);

        return $pdf->download('students_' . str_replace(' ', '_', strtolower($class_name)) . '.pdf');
    }
}

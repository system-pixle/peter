<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentFee;
use App\Models\Attendance;
use Illuminate\Http\Request;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClassExport;

class ClassOverviewController extends Controller
{
    public function index()
    {
        $classes = Student::select('class_name')->distinct()->whereNotNull('class_name')->get();
        return view('classes.index', compact('classes'));
    }

    public function show($class_name)
    {
        $students = Student::where('class_name', $class_name)->get();

        $students = $students->map(function ($student) {
            $student->attendance_count = Attendance::where('student_id', $student->id)->count();
            $fees = StudentFee::where('student_id', $student->id)->get();
            $student->amount_due = $fees->sum('amount_due');
            $student->amount_paid = $fees->sum('amount_paid');
            $student->balance = $student->amount_due - $student->amount_paid;
            return $student;
        });

        return view('classes.show', compact('students', 'class_name'));
    }

    public function exportPdf($class_name)
    {
        $students = Student::where('class_name', $class_name)->get();

        $students = $students->map(function ($student) {
            $student->attendance_count = Attendance::where('student_id', $student->id)->count();
            $fees = StudentFee::where('student_id', $student->id)->get();
            $student->amount_due = $fees->sum('amount_due');
            $student->amount_paid = $fees->sum('amount_paid');
            $student->balance = $student->amount_due - $student->amount_paid;
            return $student;
        });

        $pdf = PDF::loadView('classes.export-pdf', compact('students', 'class_name'));
        return $pdf->download("Class_Report_{$class_name}.pdf");
    }

    public function exportExcel($class_name)
    {
        return Excel::download(new ClassExport($class_name), "Class_Report_{$class_name}.xlsx");
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClassExport;
use PDF;

class ReportController extends Controller
{
    public function exportClass(Request $request)
    {
        $class = $request->input('class');
        return Excel::download(new ClassExport($class), "{$class}_report.xlsx");
    }

    public function exportPDF(Request $request)
    {
        $class = $request->input('class');
        $students = Student::where('class', $class)->get();

        $pdf = PDF::loadView('exports.class_pdf', compact('students', 'class'));
        return $pdf->download("{$class}_report.pdf");
    }
}

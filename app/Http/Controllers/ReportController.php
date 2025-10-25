<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClassExport;
use PDF;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }
}

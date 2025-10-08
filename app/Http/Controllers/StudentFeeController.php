<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentFee;
use Illuminate\Http\Request;

class StudentFeeController extends Controller
{
    public function index()
    {
        $fees = StudentFee::with('student')->get();
        return view('fees.student_index', compact('fees'));
    }

    public function create()
    {
        $students = Student::all();
        return view('fees.create_student_fee', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'term' => 'required',
            'amount_due' => 'required|numeric',
            'amount_paid' => 'required|numeric',
        ]);

        StudentFee::create($request->all());

        return redirect()->route('student_fees.index')->with('success', 'Fee record added successfully!');
    }
}

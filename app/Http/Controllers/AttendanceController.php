<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    // Show all attendance records (for admin/director)
    public function index()
    {
        $records = Attendance::with('student', 'teacher')->orderBy('date', 'desc')->get();
        return view('attendance.index', compact('records'));
    }

    // Show form for marking attendance
    public function create()
    {
        $students = Student::all();
        return view('attendance.create', compact('students'));
    }

    // Store attendance
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'status' => 'array',
        ]);

        foreach ($request->status as $student_id => $status) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $student_id,
                    'date' => $request->date,
                ],
                [
                    'teacher_id' => Auth::id(),
                    'status' => $status,
                ]
            );
        }

        return redirect()->route('attendance.index')->with('success', 'Attendance recorded successfully!');
    }
}

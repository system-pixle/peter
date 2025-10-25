<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Student;
use App\Models\Fee;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (! $user) return redirect()->route('welcome');

        switch ($user->role) {
            case 'director':
                return redirect()->route('director.dashboard');
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'teacher':
                return redirect()->route('teacher.dashboard');
            default:
                abort(403);
        }
    }

    public function director()
    {
        $teachersCount = User::where('role','teacher')->count();
        $studentsCount = Student::count();
        $adminsCount   = User::where('role','admin')->count();

        $totalPaid = Fee::sum('amount_paid');
        $totalDue  = Fee::sum('amount_due');

        return view('director.director', [
            'teachers'  => $teachersCount,
            'students'  => $studentsCount,
            'admins'    => $adminsCount, // count passed as $admins
            'totalPaid' => $totalPaid,
            'totalDue'  => $totalDue,
        ]);
    }

    public function admin()
    {
        $studentsCount = \App\Models\Student::count();
        $teachersCount = \App\Models\User::where('role', 'teacher')->count();
        $adminsCount   = \App\Models\User::where('role', 'admin')->count();

        return view('admins.dashboard', [
            'studentsCount' => $studentsCount,
            'teachersCount' => $teachersCount,
            'adminsCount'   => $adminsCount,
        ]);
    }

    public function teacher()
    {
        $teacher = Auth::user();

        // Replace with class filter later if classes are linked to teachers
        $studentsCount = \App\Models\Student::count();
        $classCount = \App\Models\Schoolclass::count();
        $attendanceCount = \App\Models\Attendance::count();

        return view('teachers.dashboard', [
            'teacher' => $teacher,
            'studentsCount' => $studentsCount,
            'classCount' => $classCount,
            'attendanceCount' => $attendanceCount,
        ]);
    }
}

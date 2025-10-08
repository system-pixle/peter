@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-semibold mb-4">
        Welcome, {{ Auth::user()->name }} ({{ ucfirst(Auth::user()->role) }}) 👋
    </h1>

    {{-- Director Section --}}
    @if (Auth::user()->role === 'director')
        <div class="space-y-4">
            <h2 class="text-xl font-semibold text-blue-700">Director Dashboard</h2>
            <p class="text-gray-700">You have full system control.</p>

            <ul class="list-disc ml-6">
                <li><a href="{{ route('admins.index') }}" class="text-blue-600">Manage Admins</a></li>
                <li><a href="{{ route('teachers.index') }}" class="text-blue-600">Manage Teachers</a></li>
                <li><a href="#" class="text-blue-600">View Reports</a></li>
                <li><a href="{{ route('student_fees.index') }}" class="text-blue-600">Manage Fees</a></li>
                <li><a href="{{ route('fees.report') }}" class="text-green-600">View Fees Report</a></li>
                <li><a href="{{ route('attendance.index') }}" class="text-blue-600">View Attendance Reports</a></li>
                <li><a href="{{ route('classes.index') }}" class="text-blue-600">📚 Class Overview</a></li>
                <li><a href="#" class="text-blue-600">System Settings</a></li>

                {{-- Export Section --}}
                <li class="mt-3">
                    <div class="flex flex-col space-y-2">
                        <form action="{{ route('export.class') }}" method="GET" class="flex items-center space-x-2">
                            <select name="class" class="border border-gray-300 rounded px-2 py-1 text-sm focus:ring-blue-500">
                                <option value="Grade 1">Grade 1</option>
                                <option value="Grade 2">Grade 2</option>
                                <option value="Grade 3">Grade 3</option>
                                <option value="Grade 4">Grade 4</option>
                                <option value="Grade 5">Grade 5</option>
                                <!-- Add more as needed -->
                            </select>
                            <button type="submit" class="bg-green-600 text-white text-sm px-3 py-1 rounded hover:bg-green-700">
                                <i class="fa fa-file-excel"></i> Export Excel
                            </button>
                        </form>

                        <form action="{{ route('export.pdf') }}" method="GET" class="flex items-center space-x-2">
                            <select name="class" class="border border-gray-300 rounded px-2 py-1 text-sm focus:ring-red-500">
                                <option value="Grade 1">Grade 1</option>
                                <option value="Grade 2">Grade 2</option>
                                <option value="Grade 3">Grade 3</option>
                                <option value="Grade 4">Grade 4</option>
                                <option value="Grade 5">Grade 5</option>
                                <!-- Add more as needed -->
                            </select>
                            <button type="submit" class="bg-red-600 text-white text-sm px-3 py-1 rounded hover:bg-red-700">
                                <i class="fa fa-file-pdf"></i> Export PDF
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    @endif

    {{-- Admin Section --}}
    @if (Auth::user()->role === 'admin')
        <div class="space-y-4">
            <h2 class="text-xl font-semibold text-green-700">Admin Dashboard</h2>
            <p class="text-gray-700">You can manage teachers, students, and records.</p>

            <ul class="list-disc ml-6">
                <li><a href="{{ route('teachers.index') }}" class="text-green-600">Manage Teachers</a></li>
                <li><a href="{{ route('students.index') }}" class="text-green-600">Manage Students</a></li>
                <li><a href="{{ route('attendance.index') }}" class="text-green-600">Attendance Records</a></li>
                <li><a href="{{ route('student_fees.index') }}" class="text-green-600">Manage Fees</a></li>
                <li><a href="{{ route('classes.index') }}" class="text-blue-600">📚 Class Overview</a></li>
            </ul>
        </div>
    @endif

    {{-- Teacher Section --}}
    @if (Auth::user()->role === 'teacher')
        <div class="space-y-4">
            <h2 class="text-xl font-semibold text-orange-700">Teacher Dashboard</h2>
            <p class="text-gray-700">You can record student assessments and attendance.</p>

            <ul class="list-disc ml-6">
                <li><a href="{{ route('attendance.create') }}" class="text-orange-600">Mark Attendance</a></li>
                <li><a href="{{ route('attendance.index') }}" class="text-orange-600">View Attendance</a></li>
                <li><a href="#" class="text-orange-600">Record Assessments</a></li>
                <li><a href="{{ route('students.index') }}" class="text-orange-600">View Students</a></li>
            </ul>
        </div>
    @endif
</div>
@endsection

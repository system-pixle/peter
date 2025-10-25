@extends('layouts.app')

@section('title', 'Teacher Dashboard')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-3xl font-bold text-blue-700 mb-6">👩‍🏫 Teacher Dashboard</h1>

    <div class="grid md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white shadow rounded-lg p-6 text-center">
            <h2 class="text-gray-600">Total Students</h2>
            <p class="text-3xl font-semibold text-green-600">{{ $studentsCount }}</p>
        </div>

        <div class="bg-white shadow rounded-lg p-6 text-center">
            <h2 class="text-gray-600">Your Classes</h2>
            <p class="text-3xl font-semibold text-indigo-600">{{ $classCount }}</p>
        </div>

        <div class="bg-white shadow rounded-lg p-6 text-center">
            <h2 class="text-gray-600">Attendance Records</h2>
            <p class="text-3xl font-semibold text-amber-600">{{ $attendanceCount }}</p>
        </div>
    </div>

    <div class="grid md:grid-cols-3 gap-6">
        <x-dashboard-card title="Mark Attendance" link="{{ route('attendance.create') }}" />
        <x-dashboard-card title="View Attendance Records" link="{{ route('attendance.index') }}" />
        <x-dashboard-card title="View Students" link="{{ route('students.index') }}" />
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-3xl font-bold text-blue-700 mb-6">🧭 Admin Dashboard</h1>

    <div class="grid md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white shadow rounded-lg p-6 text-center">
            <h2 class="text-gray-600">Students</h2>
            <p class="text-3xl font-semibold text-green-600">{{ $studentsCount }}</p>
        </div>

        <div class="bg-white shadow rounded-lg p-6 text-center">
            <h2 class="text-gray-600">Teachers</h2>
            <p class="text-3xl font-semibold text-blue-600">{{ $teachersCount }}</p>
        </div>

        <div class="bg-white shadow rounded-lg p-6 text-center">
            <h2 class="text-gray-600">Total Admins</h2>
            <p class="text-3xl font-semibold text-indigo-600">{{ $adminsCount }}</p>
        </div>
    </div>

    <div class="grid md:grid-cols-3 gap-6">
        <x-dashboard-card title="Manage Teachers" link="{{ route('teachers.index') }}" />
        <x-dashboard-card title="Manage Students" link="{{ route('students.index') }}" />
        <x-dashboard-card title="Manage Admins" link="{{ route('admins.index') }}" />
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Director Dashboard')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-3xl font-bold text-blue-700 mb-6">🎓 Director Dashboard</h1>

        <a href="{{ route('director.finances') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
    Manage Finances
    </a>


    <div class="grid md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white shadow rounded-lg p-6 text-center">
            <h2 class="text-gray-600">Teachers</h2>
            <p class="text-3xl font-semibold text-blue-600">{{ $teachers }}</p>
        </div>
        <div class="bg-white shadow rounded-lg p-6 text-center">
            <h2 class="text-gray-600">Students</h2>
            <p class="text-3xl font-semibold text-green-600">{{ $students }}</p>
        </div>
        <div class="bg-white shadow rounded-lg p-6 text-center">
            <h2 class="text-gray-600">Admins</h2>
            <p class="text-3xl font-semibold text-indigo-600">{{ $admins }}</p>
        </div>
        <div class="bg-white shadow rounded-lg p-6 text-center">
            <h2 class="text-gray-600">Total Amount</h2>
            <p class="text-3xl font-semibold text-amber-600">KSh {{ number_format($totalPaid, 2) }}</p>
        </div>
    </div>

    <div class="grid md:grid-cols-3 gap-6">
        <x-dashboard-card title="Manage Teachers" link="{{ route('teachers.index') }}" color="blue" />
        <x-dashboard-card title="Manage Students" link="{{ route('students.index') }}" color="green" />
        <x-dashboard-card title="Manage Admins" link="{{ route('admins.index') }}" color="indigo" />
    </div>
</div>
@endsection

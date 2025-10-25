@extends('layouts.app')

@section('title', 'Director Dashboard | Saint Paul’s Academy')

@section('content')
<div class="bg-gray-50 min-h-screen py-10 px-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-10">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/saintpauls-logo.png') }}" alt="Saint Paul’s Academy" class="w-12 h-12 rounded-full shadow">
            <div>
                <h1 class="text-3xl font-bold text-blue-900">Saint Paul’s Academy</h1>
                <p class="text-gray-600 text-sm">Director’s Management Dashboard</p>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="bg-blue-900 text-white px-4 py-2 rounded-lg hover:bg-blue-800 shadow">
                Logout
            </button>
        </form>
    </div>

    <!-- Dashboard Cards -->
    <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-6">
        <!-- Finance -->
        <a href="{{ route('director.finances') }}" class="block bg-white p-6 rounded-2xl shadow hover:shadow-lg transition transform hover:-translate-y-1">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-xl font-semibold text-blue-900">Finance</h2>
                <span class="bg-yellow-400 text-blue-900 px-2 py-1 rounded-full text-xs font-semibold">💰</span>
            </div>
            <p class="text-gray-600 text-sm">Manage fees, reports, and breakdowns.</p>
        </a>

        <!-- Employees -->
        <a href="{{ route('finance.employees') }}" class="block bg-white p-6 rounded-2xl shadow hover:shadow-lg transition transform hover:-translate-y-1">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-xl font-semibold text-blue-900">Employees</h2>
                <span class="bg-yellow-400 text-blue-900 px-2 py-1 rounded-full text-xs font-semibold">👩‍🏫</span>
            </div>
            <p class="text-gray-600 text-sm">Add or view staff members and their roles.</p>
        </a>

        <!-- Admins -->
        <a href="{{ route('admins.index') }}" class="block bg-white p-6 rounded-2xl shadow hover:shadow-lg transition transform hover:-translate-y-1">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-xl font-semibold text-blue-900">Admins</h2>
                <span class="bg-yellow-400 text-blue-900 px-2 py-1 rounded-full text-xs font-semibold">🧑‍💼</span>
            </div>
            <p class="text-gray-600 text-sm">Manage administrative users.</p>
        </a>

        <!-- Teachers -->
        <a href="{{ route('teachers.index') }}" class="block bg-white p-6 rounded-2xl shadow hover:shadow-lg transition transform hover:-translate-y-1">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-xl font-semibold text-blue-900">Teachers</h2>
                <span class="bg-yellow-400 text-blue-900 px-2 py-1 rounded-full text-xs font-semibold">📚</span>
            </div>
            <p class="text-gray-600 text-sm">Manage teachers and class assignments.</p>
        </a>

        <!-- Students -->
        <a href="{{ route('students.index') }}" class="block bg-white p-6 rounded-2xl shadow hover:shadow-lg transition transform hover:-translate-y-1">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-xl font-semibold text-blue-900">Students</h2>
                <span class="bg-yellow-400 text-blue-900 px-2 py-1 rounded-full text-xs font-semibold">👩‍🎓</span>
            </div>
            <p class="text-gray-600 text-sm">View and manage student details.</p>
        </a>
    </div>

    <!-- Footer -->
    <div class="mt-12 text-center text-sm text-gray-500">
        © {{ date('Y') }} Saint Paul’s Academy. All Rights Reserved.
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Finance Management')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-3xl font-bold text-blue-700 mb-6">💰 Finance Management</h1>

    <div class="grid md:grid-cols-3 gap-6 mb-6">
        <div class="bg-green-100 p-4 rounded text-center">
            <h2 class="text-gray-600">Total Expected</h2>
            <p class="text-2xl font-bold text-green-600">KSh {{ number_format($totalExpected, 2) }}</p>
        </div>
        <div class="bg-blue-100 p-4 rounded text-center">
            <h2 class="text-gray-600">Total Paid</h2>
            <p class="text-2xl font-bold text-blue-600">KSh {{ number_format($totalPaid, 2) }}</p>
        </div>
        <div class="bg-red-100 p-4 rounded text-center">
            <h2 class="text-gray-600">Balance</h2>
            <p class="text-2xl font-bold text-red-600">KSh {{ number_format($totalBalance, 2) }}</p>
        </div>
    </div>

    <h2 class="text-xl font-semibold mt-8 mb-4">Class-wise Summary</h2>
    <table class="w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">Class</th>
                <th class="p-2 border">Students</th>
            </tr>
        </thead>
        <tbody>
            @foreach($classSummary as $class)
            <tr>
                <td class="border p-2">{{ $class->class }}</td>
                <td class="border p-2 text-center">{{ $class->total_students }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-8">
        <a href="{{ route('director.employees') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            View Employees
        </a>
    </div>
</div>
@endsection

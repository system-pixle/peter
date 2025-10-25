@extends('layouts.app')

@section('title', 'Finance Dashboard')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-3xl font-bold text-blue-700 mb-6">💰 Finance Management Dashboard</h1>

    <div class="grid md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white shadow rounded-lg p-6 text-center">
            <h2 class="text-gray-600">Total Collected</h2>
            <p class="text-3xl font-semibold text-green-600">KSh {{ number_format($totalCollected, 2) }}</p>
        </div>

        <div class="bg-white shadow rounded-lg p-6 text-center">
            <h2 class="text-gray-600">Total Due</h2>
            <p class="text-3xl font-semibold text-amber-600">KSh {{ number_format($totalDue, 2) }}</p>
        </div>

        <div class="bg-white shadow rounded-lg p-6 text-center">
            <h2 class="text-gray-600">Balance</h2>
            <p class="text-3xl font-semibold text-red-600">KSh {{ number_format($balance, 2) }}</p>
        </div>

        <div class="bg-white shadow rounded-lg p-6 text-center">
            <h2 class="text-gray-600">Employees</h2>
            <p class="text-3xl font-semibold text-blue-600">{{ $employeeCount }}</p>
        </div>
    </div>

    <div class="mt-8">
        <a href="{{ route('finance.employees') }}" class="bg-indigo-600 text-white px-5 py-3 rounded-lg hover:bg-indigo-700">
            👩‍🏫 Manage Employees
        </a>
        <a href="{{ route('finance.breakdowns') }}" class="bg-green-600 text-white px-5 py-3 rounded-lg hover:bg-green-700 ml-3">
        🧾 Manage Fee Breakdown
        </a>
        
    </div>


    <div class="mt-8">
        <h2 class="text-xl font-semibold mb-3">Student Fee Reports</h2>
        <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Student Name</th>
                    <th class="p-2 border">Total Paid</th>
                    <th class="p-2 border">Total Due</th>
                    <th class="p-2 border">Balance</th>
                    <th class="p-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach(App\Models\Student::all() as $student)
                    @php
                        $paid = App\Models\Fee::where('student_id', $student->id)->sum('amount_paid');
                        $due  = App\Models\Fee::where('student_id', $student->id)->sum('amount_due');
                        $bal  = $due - $paid;
                    @endphp
                    <tr>
                        <td class="p-2 border">{{ $student->name }}</td>
                        <td class="p-2 border text-green-600">KSh {{ number_format($paid, 2) }}</td>
                        <td class="p-2 border text-amber-600">KSh {{ number_format($due, 2) }}</td>
                        <td class="p-2 border text-red-600">KSh {{ number_format($bal, 2) }}</td>
                        <td class="p-2 border">
                            <a href="{{ route('finance.student.report', $student->id) }}" class="text-blue-600 hover:underline">View</a> |
                            <a href="{{ route('finance.student.print', $student->id) }}" class="text-indigo-600 hover:underline">Print</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

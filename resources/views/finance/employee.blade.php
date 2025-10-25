@extends('layouts.app')

@section('title', 'Manage Employees')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-3xl font-bold text-blue-700 mb-6">🏫 Employees Management</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('finance.employees.store') }}" class="mb-6 bg-gray-50 p-4 rounded-lg shadow">
        @csrf
        <div class="grid md:grid-cols-4 gap-4">
            <input type="text" name="name" placeholder="Full Name" class="border rounded p-2" required>
            <input type="text" name="role" placeholder="Role" class="border rounded p-2" required>
            <input type="number" name="salary" placeholder="Salary (KSh)" class="border rounded p-2" required>
            <input type="number" name="paid_amount" placeholder="Paid Amount (KSh)" class="border rounded p-2">
        </div>
        <button class="mt-3 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Employee</button>
    </form>

    <table class="w-full border-collapse border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Name</th>
                <th class="border p-2">Role</th>
                <th class="border p-2">Salary</th>
                <th class="border p-2">Paid</th>
                <th class="border p-2">Balance</th>
                <th class="border p-2">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td class="border p-2">{{ $employee->name }}</td>
                    <td class="border p-2">{{ $employee->role }}</td>
                    <td class="border p-2 text-gray-700">KSh {{ number_format($employee->salary, 2) }}</td>
                    <td class="border p-2 text-green-600">KSh {{ number_format($employee->paid_amount, 2) }}</td>
                    <td class="border p-2 text-red-600">KSh {{ number_format($employee->balance, 2) }}</td>
                    <td class="border p-2">{{ $employee->payment_status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Employees')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-3xl font-bold text-blue-700 mb-6">👥 Employees</h1>

    <table class="w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Name</th>
                <th class="border p-2">Role</th>
                <th class="border p-2">Salary</th>
                <th class="border p-2">Paid</th>
                <th class="border p-2">Balance</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $emp)
            <tr>
                <td class="border p-2">{{ $emp->name }}</td>
                <td class="border p-2">{{ ucfirst($emp->role) }}</td>
                <td class="border p-2">KSh {{ number_format($emp->salary, 2) }}</td>
                <td class="border p-2 text-green-700">KSh {{ number_format($emp->paid_amount, 2) }}</td>
                <td class="border p-2 text-red-600">KSh {{ number_format($emp->salary - $emp->paid_amount, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

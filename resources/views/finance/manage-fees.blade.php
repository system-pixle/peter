@extends('layouts.app')

@section('title', 'Manage Fees')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Manage Student Fees</h1>

    <a href="{{ route('finance.fees.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Add Fee</a>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 mt-4 rounded">{{ session('success') }}</div>
    @endif

    <table class="w-full border-collapse border mt-6">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Student</th>
                <th class="border p-2">Term</th>
                <th class="border p-2">Amount Due</th>
                <th class="border p-2">Amount Paid</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fees as $fee)
            <tr>
                <td class="border p-2">{{ $fee->student->name }}</td>
                <td class="border p-2">{{ $fee->term }}</td>
                <td class="border p-2 text-amber-600">KSh {{ number_format($fee->amount_due, 2) }}</td>
                <td class="border p-2 text-green-600">KSh {{ number_format($fee->amount_paid, 2) }}</td>
                <td class="border p-2">
                    <a href="{{ route('finance.fees.edit', $fee->id) }}" class="text-blue-600 hover:underline">Edit</a> |
                    <form action="{{ route('finance.fees.destroy', $fee->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete fee record?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

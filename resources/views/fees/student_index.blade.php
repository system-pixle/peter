@extends('layouts.app')

@section('title', 'Student Fees')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-semibold mb-4">🎓 Student Fees Records</h1>
    <a href="{{ route('student_fees.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">Add Fee Record</a>

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 text-left">Student Name</th>
                <th class="p-2 text-left">Term</th>
                <th class="p-2 text-right">Amount Due (Ksh)</th>
                <th class="p-2 text-right">Amount Paid (Ksh)</th>
                <th class="p-2 text-right">Balance (Ksh)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fees as $fee)
                <tr class="border-b">
                    <td class="p-2">{{ $fee->student->name }}</td>
                    <td class="p-2">{{ $fee->term }}</td>
                    <td class="p-2 text-right">{{ number_format($fee->amount_due, 2) }}</td>
                    <td class="p-2 text-right">{{ number_format($fee->amount_paid, 2) }}</td>
                    <td class="p-2 text-right {{ $fee->balance > 0 ? 'text-red-600' : 'text-green-600' }}">
                        {{ number_format($fee->balance, 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

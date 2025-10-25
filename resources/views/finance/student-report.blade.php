@extends('layouts.app')

@section('title', 'Student Finance Report')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold text-blue-700 mb-4">{{ $student->name }} - Finance Report</h1>

    <p><strong>Total Paid:</strong> KSh {{ number_format($totalPaid, 2) }}</p>
    <p><strong>Total Due:</strong> KSh {{ number_format($totalDue, 2) }}</p>
    <p><strong>Balance:</strong> KSh {{ number_format($balance, 2) }}</p>

    <h2 class="mt-6 text-xl font-semibold">Fee Breakdown</h2>
    <table class="w-full mt-3 border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">Term</th>
                <th class="p-2 border">Amount Due</th>
                <th class="p-2 border">Amount Paid</th>
                <th class="p-2 border">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fees as $fee)
                <tr>
                    <td class="border p-2">{{ $fee->term }}</td>
                    <td class="border p-2 text-amber-600">KSh {{ number_format($fee->amount_due, 2) }}</td>
                    <td class="border p-2 text-green-600">KSh {{ number_format($fee->amount_paid, 2) }}</td>
                    <td class="border p-2">{{ $fee->created_at->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-6">
        <a href="{{ route('finance.student.print', $student->id) }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            🖨 Print Report
        </a>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Student Payments')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4 text-blue-700">
        💰 Payment History — {{ $student->name }} ({{ $student->schoolclass->name ?? 'Unassigned' }})
    </h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Summary --}}
    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-blue-100 p-4 rounded shadow">
            <h2 class="text-sm text-gray-600">Total Fees</h2>
            <p class="text-xl font-bold text-blue-700">KSh {{ number_format($totalDue, 2) }}</p>
        </div>
        <div class="bg-green-100 p-4 rounded shadow">
            <h2 class="text-sm text-gray-600">Total Paid</h2>
            <p class="text-xl font-bold text-green-700">KSh {{ number_format($totalPaid, 2) }}</p>
        </div>
        <div class="bg-red-100 p-4 rounded shadow">
            <h2 class="text-sm text-gray-600">Balance</h2>
            <p class="text-xl font-bold text-red-700">KSh {{ number_format($balance, 2) }}</p>
        </div>
    </div>

    {{-- Add Payment --}}
    <div class="bg-gray-50 p-4 rounded shadow mb-6">
        <h3 class="text-lg font-semibold mb-2 text-gray-700">➕ Record a New Payment</h3>
        <form method="POST" action="{{ route('finance.payments.store', $student->id) }}" class="grid grid-cols-4 gap-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Term</label>
                <select name="term" class="border rounded p-2 w-full" required>
                    <option value="">-- Select Term --</option>
                    <option value="Term 1">Term 1</option>
                    <option value="Term 2">Term 2</option>
                    <option value="Term 3">Term 3</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Amount Paid</label>
                <input type="number" name="amount_paid" class="border rounded p-2 w-full" placeholder="KSh" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Payment Date</label>
                <input type="date" name="payment_date" class="border rounded p-2 w-full" required>
            </div>

            <div class="flex items-end">
                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">
                    Save Payment
                </button>
            </div>
        </form>
    </div>

    {{-- Payment Records --}}
    <h3 class="text-lg font-semibold mb-2 text-gray-700">📜 Payment History</h3>
    <table class="w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Term</th>
                <th class="border p-2">Amount Due</th>
                <th class="border p-2">Amount Paid</th>
                <th class="border p-2">Payment Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($fees as $fee)
                <tr>
                    <td class="border p-2">{{ $fee->term }}</td>
                    <td class="border p-2 text-gray-700">KSh {{ number_format($fee->amount_due, 2) }}</td>
                    <td class="border p-2 text-green-700">KSh {{ number_format($fee->amount_paid, 2) }}</td>
                    <td class="border p-2">{{ $fee->payment_date ? $fee->payment_date->format('d M Y') : '—' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-gray-500 p-4">No payments recorded yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

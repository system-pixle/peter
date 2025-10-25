@extends('layouts.app')

@section('title', 'Payments for ' . $student->name)

@section('content')
<div class="max-w-5xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4 text-blue-700">
        💰 Payment History: {{ $student->name }} ({{ $student->admission_no }})
    </h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Add Payment Form -->
    <form method="POST" action="{{ route('finance.payments.store', $student->id) }}" class="bg-gray-50 p-4 rounded mb-6 shadow">
        @csrf
        <div class="grid md:grid-cols-4 gap-4">
            <input type="number" name="amount_paid" placeholder="Amount (KSh)" class="border rounded p-2" required>
            <input type="text" name="term" placeholder="Term (e.g., Term 1)" class="border rounded p-2">
            <input type="date" name="payment_date" class="border rounded p-2" required>
            <input type="text" name="payment_method" placeholder="Payment Method" class="border rounded p-2">
        </div>
        <textarea name="remarks" placeholder="Remarks" class="border rounded p-2 w-full mt-3"></textarea>
        <button class="mt-3 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Payment</button>
    </form>

    <!-- Payment History Table -->
    <h2 class="text-xl font-semibold mb-2">📜 Payment History</h2>
    <table class="w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Date</th>
                <th class="border p-2">Term</th>
                <th class="border p-2">Amount</th>
                <th class="border p-2">Method</th>
                <th class="border p-2">Remarks</th>
            </tr>
        </thead>
        <tbody>
            @forelse($student->payments as $payment)
                <tr>
                    <td class="border p-2">{{ $payment->payment_date }}</td>
                    <td class="border p-2">{{ $payment->term }}</td>
                    <td class="border p-2 text-green-600">KSh {{ number_format($payment->amount_paid, 2) }}</td>
                    <td class="border p-2">{{ $payment->payment_method }}</td>
                    <td class="border p-2">{{ $payment->remarks }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="border p-2 text-center text-gray-500">No payments yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

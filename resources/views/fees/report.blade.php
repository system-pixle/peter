@extends('layouts.app')

@section('title', 'Fees Summary Report')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-semibold mb-6">💰 Fees Summary Report</h1>

    {{-- Overall Stats --}}
    <div class="grid grid-cols-3 gap-6 mb-6">
        <div class="bg-blue-100 p-4 rounded-lg text-center">
            <h2 class="text-lg font-semibold text-blue-700">Total Amount Due</h2>
            <p class="text-2xl font-bold text-blue-800">Ksh {{ number_format($total_due, 2) }}</p>
        </div>
        <div class="bg-green-100 p-4 rounded-lg text-center">
            <h2 class="text-lg font-semibold text-green-700">Total Amount Paid</h2>
            <p class="text-2xl font-bold text-green-800">Ksh {{ number_format($total_paid, 2) }}</p>
        </div>
        <div class="bg-red-100 p-4 rounded-lg text-center">
            <h2 class="text-lg font-semibold text-red-700">Outstanding Balance</h2>
            <p class="text-2xl font-bold text-red-800">Ksh {{ number_format($total_balance, 2) }}</p>
        </div>
    </div>

    {{-- Term Breakdown --}}
    <h2 class="text-xl font-semibold mb-2">📘 Term Breakdown</h2>
    <table class="w-full border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 text-left">Term</th>
                <th class="p-2 text-right">Total Due (Ksh)</th>
                <th class="p-2 text-right">Total Paid (Ksh)</th>
                <th class="p-2 text-right">Balance (Ksh)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($term_summary as $term)
                <tr class="border-b">
                    <td class="p-2">{{ $term->term }}</td>
                    <td class="p-2 text-right">{{ number_format($term->due, 2) }}</td>
                    <td class="p-2 text-right">{{ number_format($term->paid, 2) }}</td>
                    <td class="p-2 text-right {{ ($term->due - $term->paid) > 0 ? 'text-red-600' : 'text-green-600' }}">
                        {{ number_format($term->due - $term->paid, 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

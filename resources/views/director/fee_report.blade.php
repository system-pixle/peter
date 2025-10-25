@extends('layouts.app')

@section('title', 'Student Fee Report')

@section('content')
<div class="max-w-5xl mx-auto p-6">
    <h1 class="text-2xl font-bold text-blue-700 mb-4">Fee Report - {{ $student->name }}</h1>
    <p class="text-gray-600 mb-6">Class: {{ $student->class }}</p>

    @foreach ($reportData as $term)
        <div class="border rounded p-4 mb-6 bg-white shadow">
            <h2 class="font-semibold text-lg text-gray-800 mb-2">Term: {{ $term['term'] }}</h2>
            <p>Expected: KSh {{ number_format($term['expected'], 2) }}</p>
            <p>Paid: KSh {{ number_format($term['paid'], 2) }}</p>
            <p>Balance: KSh {{ number_format($term['balance'], 2) }}</p>

            <h3 class="mt-4 font-semibold text-gray-700">Breakdown:</h3>
            <table class="w-full border border-gray-300 mt-2">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-2">Item</th>
                        <th class="border p-2">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($term['breakdown'] as $item)
                    <tr>
                        <td class="border p-2">{{ $item->item }}</td>
                        <td class="border p-2">KSh {{ number_format($item->amount, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach

    <button onclick="window.print()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        🖨 Print Report
    </button>
</div>
@endsection

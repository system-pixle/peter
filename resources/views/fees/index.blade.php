@extends('layouts.app')

@section('title', 'Fees Management')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-semibold">Fees Records</h1>
        <a href="{{ route('fees.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Add Fee Record</a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 text-left">Student</th>
                <th class="p-2 text-left">Term</th>
                <th class="p-2 text-right">Amount Due</th>
                <th class="p-2 text-right">Amount Paid</th>
                <th class="p-2 text-right">Balance</th>
                <th class="p-2 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fees as $fee)
                <tr class="border-b">
                    <td class="p-2">{{ $fee->student->name }}</td>
                    <td class="p-2">{{ $fee->term }}</td>
                    <td class="p-2 text-right">{{ number_format($fee->amount_due, 2) }}</td>
                    <td class="p-2 text-right">{{ number_format($fee->amount_paid, 2) }}</td>
                    <td class="p-2 text-right {{ $fee->balance > 0 ? 'text-red-600' : 'text-green-600' }}">
                        {{ number_format($fee->balance, 2) }}
                    </td>
                    <td class="p-2 text-center">
                        <a href="{{ route('fees.edit', $fee->id) }}" class="text-blue-600">Edit</a>
                        <form action="{{ route('fees.destroy', $fee->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 ml-2">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

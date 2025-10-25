@extends('layouts.app')

@section('title', 'Manage Fee Breakdown')

@section('content')
<div class="max-w-5xl mx-auto p-6 bg-white shadow rounded-lg">
    <h1 class="text-2xl font-bold text-blue-700 mb-6">💡 Manage Fee Breakdown</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Create New Breakdown Item --}}
    <form action="{{ route('finance.breakdowns.store') }}" method="POST" class="mb-8">
        @csrf
        <div class="grid md:grid-cols-4 gap-4">
            <div>
                <label class="block text-gray-700 text-sm mb-1">Term</label>
                <input type="text" name="term" class="w-full border-gray-300 rounded p-2" placeholder="e.g. Term 1" required>
            </div>

            <div>
                <label class="block text-gray-700 text-sm mb-1">Description</label>
                <input type="text" name="description" class="w-full border-gray-300 rounded p-2" placeholder="e.g. Tuition" required>
            </div>

            <div>
                <label class="block text-gray-700 text-sm mb-1">Amount (KSh)</label>
                <input type="number" name="amount" class="w-full border-gray-300 rounded p-2" placeholder="e.g. 5000" required>
            </div>

            <div class="flex items-end">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">
                    ➕ Add Item
                </button>
            </div>
        </div>
    </form>

    {{-- Existing Breakdown List --}}
    <h2 class="text-lg font-semibold mb-3">📋 Existing Fee Breakdown</h2>

    <table class="w-full border-collapse border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2 text-left">Term</th>
                <th class="border p-2 text-left">Description</th>
                <th class="border p-2 text-right">Amount (KSh)</th>
                <th class="border p-2 text-center w-20">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($breakdowns as $item)
                <tr>
                    <td class="border p-2">{{ $item->term }}</td>
                    <td class="border p-2">{{ $item->description }}</td>
                    <td class="border p-2 text-right">KSh {{ number_format($item->amount, 2) }}</td>
                    <td class="border p-2 text-center">
                        <form action="{{ route('finance.breakdowns.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Delete this item?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-500">No breakdown items found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

<div class="flex justify-end mb-4">
    <form action="{{ route('finance.breakdowns.print', request('term', 'Term 1')) }}" method="GET">
        <select name="term" class="border rounded p-2">
            <option value="Term 1">Term 1</option>
            <option value="Term 2">Term 2</option>
            <option value="Term 3">Term 3</option>
        </select>
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 ml-2">
            🖨️ Print Breakdown
        </button>
    </form>
</div>


</div>
@endsection

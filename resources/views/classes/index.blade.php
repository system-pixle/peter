@extends('layouts.app')

@section('title', 'Classes Overview')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-semibold mb-4">Classes Overview</h2>

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 text-left">Class Name</th>
                <th class="p-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($classes as $class)
                <tr class="border-t">
                    <td class="p-2">{{ $class->class_name }}</td>
                    <td class="p-2">
                        <a href="{{ route('classes.show', $class->class_name) }}" class="text-blue-600">View Details</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">{{ $class->name }} - Class Overview</h2>

    <p><strong>Teacher:</strong> {{ $class->teacher_name ?? 'Not assigned' }}</p>
    <p><strong>Description:</strong> {{ $class->description ?? 'No description' }}</p>

    <hr>

    <h4>Students in this Class</h4>

    @if($class->students->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Admission No.</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th>Parent</th>
                    <th>Contact</th>
                </tr>
            </thead>
            <tbody>
                @foreach($class->students as $student)
                    <tr>
                        <td>{{ $student->admission_number }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->gender }}</td>
                        <td>{{ $student->dob }}</td>
                        <td>{{ $student->parent_name }}</td>
                        <td>{{ $student->contact }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No students have been added to this class yet.</p>
    @endif
</div>
@endsection

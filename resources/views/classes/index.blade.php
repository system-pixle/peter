@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Classes Overview</h2>

        {{-- Show Add Class button only for Admin & Director --}}
        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'director')
            <a href="{{ route('classes.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add Class
            </a>
        @endif
    </div>

    {{-- Display list of classes --}}
    <div class="card shadow-sm">
        <div class="card-body">
            @if($classes->isEmpty())
                <p class="text-muted">No classes available yet.</p>
            @else
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Class Name</th>
                            <th>Students</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($classes as $index => $class)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $class->name }}</td>
                                <td>{{ $class->students_count ?? 0 }}</td>
                                <td>
                                    <a href="{{ route('classes.show', $class->name) }}" class="btn btn-sm btn-info">View</a>

                                    {{-- Edit/Delete only for Admin & Director --}}
                                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'director')
                                        <a href="{{ route('classes.edit', $class->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('classes.destroy', $class->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this class?')">
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection

<!-- resources/views/teachers/index.blade.php -->

<div>
    <h2>Teachers</h2>
    <a href="{{ route('teachers.create') }}" class="btn btn-primary">Add Teacher</a>

    <div><a href="{{ route('dashboard') }}">Back Menu</a></div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NIP</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Subject</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teachers as $teacher)
                <tr>
                    <td>{{ $teacher->nip }}</td>
                    <td>{{ $teacher->name }}</td>
                    <td>{{ $teacher->jenis_kelamin }}</td>
                    <td>{{ $teacher->subject->name }}</td>
                    <td>
                        <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@extends('layouts.app')

@section('content')
@endsection

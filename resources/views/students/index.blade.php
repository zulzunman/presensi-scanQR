@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Students List</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('students.create') }}" class="btn btn-primary">Add Student</a>

    <div><a href="{{ route('dashboard') }}">Back Menu</a></div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>NIS</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Class</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->nis }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->jenis_kelamin }}</td>
                    <td>{{ $student->class->name }}</td>
                    <td>
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
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
@endsection

<!-- resources/views/teachers/index.blade.php -->

<div>
    <h2>Teachers</h2>
    <a href="{{ route('teachers.create') }}" class="btn btn-primary">Add Teacher</a>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teachers as $teacher)
                <tr>
                    <td>{{ $teacher->name }}</td>
                    <td>
                        <a href="{{ route('teachers.show', $teacher->id) }}">View</a>
                        <a href="{{ route('teachers.edit', $teacher->id) }}">Edit</a>
                        <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
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

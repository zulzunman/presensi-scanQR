<!-- resources/views/subjects/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div>
        <h2>Subjects</h2>
        <a href="{{ route('subjects.create') }}" class="btn btn-primary">Add Subject</a>

        <div><a href="{{ route('dashboard') }}">Back Menu</a></div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subjects as $subject)
                    <tr>
                        <td>{{ $subject->name }}</td>
                        <td>
                            <a href="{{ route('subjects.show', $subject->id) }}">View</a>
                            <a href="{{ route('subjects.edit', $subject->id) }}">Edit</a>
                            <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" style="display:inline;">
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
@endsection

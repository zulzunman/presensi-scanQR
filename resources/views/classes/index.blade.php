<!-- resources/views/classes/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div>
        <h2>Classes</h2>
        <a href="{{ route('classes.create') }}" class="btn btn-primary">Add Class</a>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classes as $class)
                    <tr>
                        <td>{{ $class->name }}</td>
                        <td>
                            <a href="{{ route('classes.show', $class->id) }}">View</a>
                            <a href="{{ route('classes.edit', $class->id) }}">Edit</a>
                            <form action="{{ route('classes.destroy', $class->id) }}" method="POST" style="display:inline;">
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

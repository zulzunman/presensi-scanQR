<!-- resources/views/users/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div>
        <h2>Users</h2>
        <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <a href="{{ route('users.show', $user->id) }}">View</a>
                            @if ($currentUserRole === 'admin')
                                <a href="{{ route('users.edit', $user->id) }}">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                <div><a href="{{ route('dashboard') }}">Back Menu</a></div>
            </tbody>
        </table>
    </div>
@endsection

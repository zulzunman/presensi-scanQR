<!-- resources/views/users/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div>
        <h2>Edit User</h2>
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="{{ $user->username }}" required>
            </div>
            <div>
                <label for="password">Password (leave blank to keep current password):</label>
                <input type="password" id="password" name="password">
            </div>
            <div>
                <label for="role">Role:</label>
                <select id="role" name="role" required>
                    @if ($role === 'admin')
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    @elseif ($role === 'teacher')
                    <option value="teacher" {{ $user->role == 'teacher' ? 'selected' : '' }}>Teacher</option>
                    <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>Student</option>
                    @endif
                </select>
            </div>
            <div>
                <button type="submit">Update User</button>
            </div>
        </form>

        <div>
            <a href="{{ route('users.index') }}">Back to Users</a>
        </div>
    </div>
@endsection

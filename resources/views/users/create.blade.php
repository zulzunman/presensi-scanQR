<!-- resources/views/users/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div>
        <h2>Add User</h2>
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <label for="role">Role:</label>
                <select id="role" name="role" required>
                    @if ($role === 'admin')
                    <option value="admin">Admin</option>
                    <option value="teacher">Teacher</option>
                    <option value="student">Student</option>
                        <!-- tambahkan menu lainnya untuk admin -->
                    @elseif ($role === 'teacher')
                    <option value="teacher">Teacher</option>
                    <option value="student">Student</option>
                        <!-- tambahkan menu untuk guru jika diperlukan -->
                    @endif
                </select>
            </div>
            <div>
                <button type="submit">Add User</button>
            </div>
        </form>

        <div>
            <a href="{{ route('users.index') }}">Back to Users</a>
        </div>
    </div>
@endsection

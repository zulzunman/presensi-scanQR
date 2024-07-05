<!-- resources/views/users/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div>
        <h2>User Detail</h2>
        <p><strong>Username:</strong> {{ $user->username }}</p>
        <p><strong>Role:</strong> {{ $user->role }}</p>
        <div>
            <a href="{{ route('users.index') }}">Back to Users</a>
        </div>
    </div>
@endsection

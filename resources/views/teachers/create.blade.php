<!-- resources/views/teachers/create.blade.php -->

@extends('layouts.app')
<div>
    <h2>Add Teacher</h2>
    <form method="POST" action="{{ route('teachers.store') }}">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <!-- tambahkan input lainnya sesuai kebutuhan -->
        <div>
            <button type="submit">Add Teacher</button>
        </div>
    </form>
</div>

@section('content')
@endsection

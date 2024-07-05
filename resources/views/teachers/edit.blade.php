<!-- resources/views/teachers/edit.blade.php -->

<div>
    <h2>Edit Teacher</h2>
    <form method="POST" action="{{ route('teachers.update', $teacher->id) }}">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $teacher->name }}" required>
        </div>
        <!-- tambahkan input lainnya sesuai kebutuhan -->
        <div>
            <button type="submit">Update Teacher</button>
        </div>
    </form>
</div>
@extends('layouts.app')

@section('content')
@endsection

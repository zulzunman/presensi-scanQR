<!-- resources/views/classes/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div>
        <h2>Edit Class</h2>
        <form method="POST" action="{{ route('classes.update', $class->id) }}">
            @csrf
            @method('PUT')
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ $class->name }}" required>
            </div>
            <div>
                <button type="submit">Update Class</button>
            </div>
        </form>
    </div>
@endsection

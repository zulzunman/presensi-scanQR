<!-- resources/views/subjects/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div>
        <h2>Edit Subject</h2>
        <form method="POST" action="{{ route('subjects.update', $subject->id) }}">
            @csrf
            @method('PUT')
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ $subject->name }}" required>
            </div>
            <div>
                <button type="submit">Update Subject</button>
            </div>
        </form>
    </div>
@endsection

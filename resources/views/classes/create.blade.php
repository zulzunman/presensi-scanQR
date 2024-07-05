<!-- resources/views/classes/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div>
        <h2>Add Class</h2>
        <form method="POST" action="{{ route('classes.store') }}">
            @csrf
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <button type="submit">Add Class</button>
            </div>
        </form>
    </div>
@endsection

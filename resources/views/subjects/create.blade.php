<!-- resources/views/susbjects/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div>
        <h2>Add Subject</h2>
        <form method="POST" action="{{ route('subjects.store') }}">
            @csrf
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <button type="submit">Add Subject</button>
            </div>
        </form>
    </div>
@endsection

<!-- resources/views/subjects/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div>
        <h2>Subject Detail</h2>
        <p><strong>Name:</strong> {{ $subject->name }}</p>
        <div>
            <a href="{{ route('subjects.index') }}">Back to Subjects</a>
        </div>
    </div>
@endsection

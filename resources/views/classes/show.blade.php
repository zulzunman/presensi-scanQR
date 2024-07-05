<!-- resources/views/classes/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div>
        <h2>Class Detail</h2>
        <p><strong>Name:</strong> {{ $class->name }}</p>
        <div>
            <a href="{{ route('classes.index') }}">Back to Classes</a>
        </div>
    </div>
@endsection

<!-- resources/views/teachers/show.blade.php -->

<div>
    <h2>Teacher Detail</h2>
    <p><strong>Name:</strong> {{ $teacher->name }}</p>
    <!-- tambahkan detail lainnya sesuai kebutuhan -->
    <div>
        <a href="{{ route('teachers.index') }}">Back to Teachers</a>
    </div>
</div>
@extends('layouts.app')

@section('content')
@endsection

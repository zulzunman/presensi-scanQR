@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Attendance List</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('attendances.create') }}" class="btn btn-primary">Add Attendance</a>

    <div><a href="{{ route('dashboard') }}">Back Menu</a></div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NIS</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Class</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->student->nis }}</td>
                    <td>{{ $attendance->student->name }}</td>
                    <td>{{ $attendance->student->jenis_kelamin }}</td>
                    <td>{{ $attendance->student->class->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

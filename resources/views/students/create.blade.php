@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Student</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nis">NIS:</label>
            <input type="text" name="nis" id="nis" class="form-control" value="{{ old('nis') }}">
        </div>

        <div class="form-group">
            <label for="user_id">Student:</label>
            <select name="user_id" id="user_id" class="form-control">
                @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->username }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Gender:</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                <option value="Laki - Laki">Laki - Laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="class_id">Class:</label>

            <select name="class_id" id="class_id" class="form-control">
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>

    <div>
        <a href="{{ route('students.index') }}">Back to Students</a>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Teacher</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('teachers.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nip">NIP:</label>
            <input type="text" name="nip" id="nip" class="form-control" value="{{ old('nip') }}">
        </div>

        <div class="form-group">
            <label for="user_id">Teacher:</label>
            <select name="user_id" id="user_id" class="form-control">
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->username }}</option>
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
            <label for="subject_id">Subject:</label>

            <select name="subject_id" id="subject_id" class="form-control">
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>

    <div>
        <a href="{{ route('teachers.index') }}">Back to Teachers</a>
    </div>
</div>
@endsection

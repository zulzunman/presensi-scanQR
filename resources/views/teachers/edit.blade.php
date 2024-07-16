<!-- resources/views/teachers/edit.blade.php -->

@extends('layouts.app')
<div class="container">
    <h2>Edit Teacher</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('teachers.update', $teacher->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nip">NIP:</label>
            <input type="text" name="nip" id="nip" class="form-control" value="{{ $teacher->nip }}">
        </div>

        <div class="form-group">
            <label for="user_id">Account:</label>
            <select name="user_id" id="user_id" class="form-control">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $teacher->user_id ? 'selected' : '' }}>{{ $user->username }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $teacher->name }}">
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Gender:</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                <option value="Laki - Laki" {{ $teacher->jenis_kelamin == 'Laki - Laki' ? 'selected' : '' }}>Laki - Laki</option>
                <option value="Perempuan" {{ $teacher->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="subject_id">Subject:</label>
            <select name="subject_id" id="subject_id" class="form-control">
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ $subject->id == $teacher->subject_id ? 'selected' : '' }}>{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <div>
        <a href="{{ route('teachers.index') }}">Back to Teachers</a>
    </div>
</div>
@section('content')
@endsection

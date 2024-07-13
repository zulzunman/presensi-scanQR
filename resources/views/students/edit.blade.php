@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Student</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nis">NIS:</label>
            <input type="text" name="nis" id="nis" class="form-control" value="{{ $student->nis }}">
        </div>

        <div class="form-group">
            <label for="user_id">Account:</label>
            <select name="user_id" id="user_id" class="form-control">
                @foreach ($users as $account)
                    <option value="{{ $account->id }}" {{ $account->id == $account->user_id ? 'selected' : '' }}>{{ $account->username }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $student->name }}">
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Gender:</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                <option value="Laki - Laki" {{ $student->jenis_kelamin == 'Laki - Laki' ? 'selected' : '' }}>Laki - Laki</option>
                <option value="Perempuan" {{ $student->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="class_id">Class:</label>
            <select name="class_id" id="class_id" class="form-control">
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}" {{ $class->id == $student->class_id ? 'selected' : '' }}>{{ $class->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <div>
        <a href="{{ route('students.index') }}">Back to Students</a>
    </div>
</div>
@endsection

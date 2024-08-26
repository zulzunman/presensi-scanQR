@extends('layouts.app')
@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Students List</h4>
                                @if (auth()->user()->role == 'admin' || (auth()->user()->role == 'student' && $students->isEmpty()))
                                    <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                        data-bs-target="#createStudentModal">
                                        <i class="fa fa-plus"></i>
                                        Add Student
                                    </button>
                                @elseif (auth()->user()->role == 'admin')
                                    <a href="{{ url('/download-template') }}" class="btn btn-primary">Download Template Excel</a>
                                    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="file">Upload Excel</label>
                                            <input type="file" name="file" class="form-control" required>
                                        </div>
                                        <button class="btn btn-primary">Upload</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="user-table" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>NIS</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Class</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                <td>{{ $student->nis }}</td>
                                                <td>{{ $student->name }}</td>
                                                <td>{{ $student->jenis_kelamin }}</td>
                                                <td>{{ $student->class->name }}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        @if (auth()->user()->role == 'student')
                                                            @foreach ($users as $user)
                                                                <button class="btn btn-link btn-primary btn-lg"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#editUserModal{{ $user->id }}">
                                                                    <i class="fa fa-user"></i>
                                                                </button>
                                                                @include('users.edit', [
                                                                    'user' => $user,
                                                                    'role' => $currentUserRole,
                                                                ])
                                                            @endforeach
                                                        @endif
                                                        <button class="btn btn-link btn-primary btn-lg"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editStudentModal{{ $student->id }}">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        @if (auth()->user()->role == 'admin')
                                                            <form action="{{ route('students.destroy', $student->id) }}"
                                                                method="POST" class="delete-form"
                                                                data-name="{{ $student->name }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" data-bs-toggle="tooltip"
                                                                    title="Remove"
                                                                    class="btn btn-link btn-danger delete-btn">
                                                                    <i class="fa fa-times"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @include('students.edit', [
                                                'student' => $student,
                                                'classes' => $classes,
                                                'users' => $users,
                                            ])
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @include('students.create', ['classes' => $classes, 'users' => $users])
                </div>
            </div>
        </div>
    </div>
@endsection

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
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Daftar Siswa</h4>
                                @if (auth()->user()->role == 'admin' || (auth()->user()->role == 'student' && $students->isEmpty()))
                                    <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                        data-bs-target="#createStudentModal">
                                        <i class="fa fa-plus"></i>
                                        Tambah Siswa
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="user-table" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>NIS</th>
                                            <th>Nama Lengkap</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Kelas</th>
                                            <th>Aksi</th>
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

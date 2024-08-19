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
                                <h4 class="card-title">List Teachers</h4>
                                @if (auth()->user()->role == 'admin' || (auth()->user()->role == 'teacher' && $teachers->isEmpty()))
                                    <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                        data-bs-target=" #createTeacherModal">
                                        <i class="fa fa-plus"></i>
                                        Add Teachers
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                @if (session('qrCodePath'))
                                    <div>
                                        <img src="{{ asset('storage/' . session('qrCodePath')) }}" alt="QR Code Siswa">
                                    </div>
                                @endif
                            </div>
                            <table id="user-table" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($teachers as $teacher)
                                        <tr>
                                            <td>{{ $teacher->nip }}</td>
                                            <td>{{ $teacher->name }}</td>
                                            <td>{{ $teacher->jenis_kelamin }}</td>
                                            <td>{{ $teacher->subject->name }}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    @if (auth()->user()->role == 'teacher')
                                                        @foreach ( $users as $user)
                                                            <button class="btn btn-link btn-primary btn-lg" data-bs-toggle="modal"
                                                                data-bs-target="#editUserModal{{ $user->id }}">
                                                                <i class="fa fa-user"></i>
                                                            </button>
                                                            @include('users.edit', [
                                                                'user' => $user,
                                                                'role' => $currentUserRole,
                                                            ])
                                                        @endforeach
                                                    @endif
                                                    <button class="btn btn-link btn-primary btn-lg" data-bs-toggle="modal"
                                                        data-bs-target="#editTeacherModal{{ $teacher->id }}">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    @if (auth()->user()->role == 'admin')
                                                        <form action="{{ route('teachers.destroy', $teacher->id) }}"
                                                            method="POST" class="delete-form"
                                                            data-name="{{ $teacher->name }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" data-bs-toggle="tooltip" title="Hapus"
                                                                class="btn btn-link btn-danger delete-btn">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @include('teachers.edit', [
                                            'teacher' => $teacher,
                                            'users' => $users,
                                            'subjects' => $subjects,
                                        ])
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada data.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @include('teachers.create', ['users' => $users, 'subjects' => $subjects])
            </div>
        </div>
    </div>
    </div>
@endsection

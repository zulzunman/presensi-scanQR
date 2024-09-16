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
                                <h4 class="card-title">Daftar Mata Pelajaran</h4>
                                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                    data-bs-target="#createSubjectModal">
                                    <i class="fa fa-plus"></i>
                                    Tambah Data
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="user-table" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th style="width: 10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subjects as $subject)
                                            <tr>
                                                <td>{{ $subject->name }}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <button class="btn btn-link btn-primary btn-lg"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#viewSubjectModal{{ $subject->id }}">
                                                            <i class="fas fa-list"></i>
                                                        </button>
                                                        <button class="btn btn-link btn-primary btn-lg"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editSubjectModal{{ $subject->id }}">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <form action="{{ route('subjects.destroy', $subject->id) }}"
                                                            method="POST" class="delete-form"
                                                            data-name="{{ $subject->name }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" data-bs-toggle="tooltip" title="Remove"
                                                                class="btn btn-link btn-danger delete-btn">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @include('subjects.show', ['subject' => $subject])
                                            @include('subjects.edit', ['subject' => $subject])
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @include('subjects.create')
                </div>
            </div>
        </div>
    </div>
@endsection

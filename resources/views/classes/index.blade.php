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
                                <h4 class="card-title">List Class</h4>
                                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                    data-bs-target="#createClassModal">
                                    <i class="fa fa-plus"></i>
                                    Add Class
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="user-table" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($classes as $class)
                                            <tr>
                                                <td>{{ $class->name }}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <button class="btn btn-link btn-primary btn-lg"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#viewClassModal{{ $class->id }}">
                                                            <i class="fas fa-list"></i>
                                                        </button>
                                                        <button class="btn btn-link btn-primary btn-lg"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editClassModal{{ $class->id }}">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <form action="{{ route('classes.destroy', $class->id) }}"
                                                            method="POST" class="delete-form"
                                                            data-name="{{ $class->name }}">
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
                                            @include('classes.show', ['class' => $class])
                                            @include('classes.edit', ['class' => $class])
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @include('classes.create')
                </div>
            </div>
        </div>
    </div>
@endsection

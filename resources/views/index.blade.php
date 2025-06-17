@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="container d-flex justify-content-center " style="min-height: 100vh;">
        <div class="page-inner w-100">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-body">
                                <div class="table-responsive text-center">
                                    <h6 class="fw-bold mb-0">Selamat Datang {{ ucfirst($role) }}!</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

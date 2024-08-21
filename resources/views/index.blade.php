@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 80vh;">
        <div class="page-inner w-100">
            <div class="row">
                <div class="col-md-10 mx-auto"> <!-- Mengubah dari 12 menjadi 10 untuk sedikit margin di kiri dan kanan -->
                    <div class="card w-100">
                        <div class="card-header">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <h4 class="text-center fw-bold">Welcome {{ ucfirst($role) }}!</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

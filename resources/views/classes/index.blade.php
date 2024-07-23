<!-- resources/views/classes/index.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Class Management - Kaiadmin Bootstrap 5 Admin Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('style/assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{ asset('style/assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('style/assets/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('style/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('style/assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('style/assets/css/kaiadmin.min.css') }}" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('style/assets/css/demo.css') }}" />
</head>

<body>
    <div class="wrapper">
        <div class="main-panel">
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
                                        <table id="add-row" class="display table table-striped table-hover">
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
                                                                <form
                                                                    action="{{ route('classes.destroy', $class->id) }}"
                                                                    method="POST" style="display:inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        onclick="return confirm('Are you sure delete this class?')"
                                                                        data-bs-toggle="tooltip" title="Remove"
                                                                        class="btn btn-link btn-danger">
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
        </div>
    </div>

    <!-- JS Files -->
    <script src="{{ asset('style/assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/kaiadmin.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/setting-demo2.js') }}"></script>

    <!-- Notifikasi penghapusan -->
    <script>
        @if (session('success'))
            alert('{{ session('success') }}');
        @endif
    </script>
</body>

</html>

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
    <link rel="stylesheet" href="{{ asset('style/assets/css/demo.css') }}" />

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

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
                                    @if (session('success'))
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                Swal.fire({
                                                    title: 'Success!',
                                                    text: '{{ session('success') }}',
                                                    icon: 'success',
                                                    confirmButtonText: 'OK'
                                                });
                                            });
                                        </script>
                                    @endif
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">List Users</h4>
                                        <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                            data-bs-target="#createUserModal">
                                            <i class="fa fa-plus"></i>
                                            Add Users
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Username</th>
                                                    <th>Role</th>
                                                    <th style="width: 10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td>{{ $user->username }}</td>
                                                        <td>{{ $user->role }}</td>
                                                        <td>
                                                            <div class="form-button-action">
                                                                <button class="btn btn-link btn-primary btn-lg"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#viewUserModal{{ $user->id }}">
                                                                    <i class="fas fa-list"></i>
                                                                </button>
                                                                <button class="btn btn-link btn-primary btn-lg"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#editUserModal{{ $user->id }}">
                                                                    <i class="fa fa-edit"></i>
                                                                </button>
                                                                <form action="{{ route('users.destroy', $user->id) }}"
                                                                    method="POST" class="delete-form"
                                                                    data-name="{{ $user->name }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" data-bs-toggle="tooltip"
                                                                        title="Remove"
                                                                        class="btn btn-link btn-danger delete-btn">
                                                                        <i class="fa fa-times"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @include('users.show', ['user' => $user])
                                                    @include('users.edit', [
                                                        'user' => $user,
                                                        'role' => $currentUserRole,
                                                    ])
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @include('users.create', [
                                'user' => $user,
                                'role' => $currentUserRole,
                            ])
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

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if (session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif

        document.addEventListener('DOMContentLoaded', function() {
            // Konfirmasi penghapusan
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const form = button.closest('.delete-form');
                    const subjectName = form.getAttribute('data-name');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: `Do you want to delete the subject : ${userName}?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
</body>

</html>

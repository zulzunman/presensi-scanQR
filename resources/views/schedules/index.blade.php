<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Schedule Management</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('style/assets/img/favicon.ico') }}" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{ asset('style/assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
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
                                        <h4 class="card-title">Schedule List</h4>
                                        <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                            data-bs-target="#createScheduleModal">
                                            <i class="fa fa-plus"></i>
                                            Add Schedule
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Day</th>
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                    <th>Subject</th>
                                                    <th>Class</th>
                                                    @if (auth()->user()->role == 'admin')
                                                        <th>Actions</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($schedules as $schedule)
                                                    <tr>
                                                        <td>{{ $schedule->day }}</td>
                                                        <td>{{ $schedule->start_time }}</td>
                                                        <td>{{ $schedule->end_time }}</td>
                                                        <td>{{ $schedule->subject->name }}</td>
                                                        <td>{{ $schedule->class->name }}</td>
                                                        @if (auth()->user()->role == 'admin')
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <button class="btn btn-link btn-primary btn-lg"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#editScheduleModal{{ $schedule->id }}">
                                                                        <i class="fa fa-edit"></i>
                                                                    </button>
                                                                    <form
                                                                        action="{{ route('schedules.destroy', $schedule->id) }}"
                                                                        method="POST" class="delete-form"
                                                                        data-name="{{ $schedule->name }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="button" data-bs-toggle="tooltip"
                                                                            title="Remove"
                                                                            class="btn btn-link btn-danger delete-btn">
                                                                            <i class="fa fa-times"></i>
                                                                        </button>
                                                                </div>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                    @include('schedules.edit', [
                                                        'schedule' => $schedule,
                                                        'subjects' => $subjects,
                                                        'classes' => $classes,
                                                    ])
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @include('schedules.create', ['subjects' => $subjects, 'classes' => $classes])
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
                    const className = form.getAttribute('data-name');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: `Do you want to delete the schedule : ${className}?`,
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


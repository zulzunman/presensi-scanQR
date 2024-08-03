@extends('layouts.app')
@section('script1')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var teachers = @json($teachers->pluck('id'));

            function updateQrCode(id) {
                fetch(`/generate-qr/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById(`qr-code-${id}`).src = data.file_path + '?t=' + new Date()
                            .getTime();
                    });
            }

            teachers.forEach(function(id) {
                setInterval(function() {
                    updateQrCode(id);
                }, 10000); // 10 detik
            });
        });
    </script>
@endsection

@section('sidebar')
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ asset('style/assets/img/profile.jpg') }}" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            Hizrian
                            <span class="user-level">Administrator</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#profile">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#edit">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#settings">
                                    <span class="link-collapse">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-secondary">
                <li class="nav-item active">
                    <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                        <span></span>
                    </a>
                </li>
                @if ($role === 'admin')
                    <li class="nav-item">
                        <a href="{{ route('teachers.index') }}">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <p>Manage Teachers</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('students.index') }}">
                            <i class="fas fa-user-graduate"></i>
                            <p>Manage Students</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}">
                            <i class="fas fa-users-cog"></i>
                            <p>Manage Users</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('subjects.index') }}">
                            <i class="fas fa-book-open"></i>
                            <p>Manage Subjects</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('schedules.index') }}">
                            <i class="fas fa-calendar-alt"></i>
                            <p>Manage Schedule</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('classes.index') }}">
                            <i class="fas fa-school"></i>
                            <p>Manage Class</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('attendances.index') }}">
                            <i class="fas fa-clipboard-list"></i>
                            <p>Manage Attendance</p>
                        </a>
                    </li>
                @elseif ($role === 'teacher')
                    <li class="nav-item">
                        <a href="{{ route('schedules.index') }}">
                            <i class="fas fa-calendar-alt"></i>
                            <p>Manage Schedule</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('teachers.index') }}">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <p>Manage Teachers</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('attendances.index') }}">
                            <i class="fas fa-clipboard-list"></i>
                            <p>Manage Attendance</p>
                        </a>
                    </li>
                @elseif ($role === 'student')
                    <li class="nav-item">
                        <a href="{{ route('students.index') }}">
                            <i class="fas fa-user-graduate"></i>
                            <p>Manage Students</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('attendances.index') }}">
                            <i class="fas fa-clipboard-list"></i>
                            <p>Manage Attendance</p>
                        </a>
                    </li>
                    <!-- tambahkan menu untuk siswa jika diperlukan -->
                @endif
                <li class="nav-item">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>

        </div>
    </div>
@endsection

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Attendance List</h4>
                            </div>
                        </div>

                        <div class="card-body">
                            <div>
                                @if (auth()->user()->role == 'student')
                                    <div class="card">
                                        <div class="card-header">
                                            Scan QR Code
                                        </div>
                                        <div class="card-body text-center">
                                            <div id="reader" style="width: 500px; height: 500px;"></div>
                                        </div>
                                    </div>
                                @elseif (auth()->user()->role == 'teacher')
                                    <div class="d-flex align-items-center ">
                                        <h4 class="card-title">Scan untuk melakukan presensi</h4>
                                    </div>
                                    @foreach ($teachers as $teacher)
                                        <div>
                                            <!-- Tombol untuk meregenerasi QR code -->
                                            <button id="regenerate-qr-button" data-id="{{ $teacher->id }}">Regenerate
                                                QR Code</button>

                                            <!-- Menampilkan QR code -->
                                            <img id="qr-code-{{ $teacher->id }}"
                                                src="{{ asset('assets/qrcodes/' . $teacher->qr_name) }}" alt="QR Code">
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="table-responsive mt-4">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>NIS</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Class</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($attendances as $attendance)
                                            <tr>
                                                <td>{{ $attendance->student->nis }}</td>
                                                <td>{{ $attendance->student->name }}</td>
                                                <td>{{ $attendance->student->jenis_kelamin }}</td>
                                                <td>{{ $attendance->student->class->name }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        // Auto click the "Regenerate QR" button every 5 seconds (5000 milliseconds)
        function autoClickButton() {
            document.getElementById('regenerate-qr-button').click();
            setTimeout(autoClickButton, 5000);
        }

        // Start the auto-click process
        autoClickButton();

        $(document).ready(function() {
            $('#regenerate-qr-button').click(function() {
                var teacherId = $(this).data('id');

                $.ajax({
                    url: '/user/' + teacherId + '/regenerate-qr-code',
                    type: 'GET',
                    success: function(response) {
                        if (response.status) {
                            // Update the QR code image src with a timestamp to avoid caching
                            $('#qr-code-' + teacherId).attr('src', response.file_path + '?t=' +
                                new Date().getTime());
                            // alert('QR Code regenerated successfully');
                        } else {
                            alert('Failed to regenerate QR code: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred: ' + xhr.responseText);
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', (event) => {
            // Auto click the "Book Now" button after 5 seconds (5000 milliseconds)
            setTimeout(function() {
                document.getElementById('bookNowButton').click();
            }, 5000);

            function onScanSuccess(decodedText, decodedResult) {

                // Send data to server
                fetch('{{ route('save.scanned.data') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            data: decodedText
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        $.ajax({
                            url: '{{ route('save.scanned.data') }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                data: data
                            },
                            success: function(response) {
                                window.location.reload()
                                alert(response.success);
                            },
                            error: function(xhr) {
                                alert('An error occurred: ' + xhr.responseText);
                            }
                        });
                        // Optionally update the view with new data
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });

                // Stop the camera scan once the QR code is scanned
                html5QrcodeScanner.clear();
            }

            function onScanError(errorMessage) {
                // Handle scan error
                console.error(`QR Code scan error: ${errorMessage}`);
                document.getElementById('result').innerText = `Error: ${errorMessage}`;
            }

            const html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", {
                    fps: 10,
                    qrbox: 250,
                    rememberLastUsedCamera: true,
                    supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA]
                });

            html5QrcodeScanner.render(onScanSuccess, onScanError);
        });

        // Mengirim data menggunakan jQuery AJAX
        $.ajax({
            url: '{{ route('save.scanned.data') }}',
            type: 'POST',
            data: JSON.stringify({
                id: yourIdValue
            }), // Gantilah `yourIdValue` dengan data yang sesuai
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status === 'success') {
                    // Jika data berhasil disimpan, refresh halaman
                    window.location.reload();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Request failed: ' + error);
            }
        });
    </script>
@endsection

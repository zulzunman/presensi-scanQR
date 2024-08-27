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
    @include('layouts.sidebar')
@endsection

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row ">
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
                                    @if ($students)
                                        <div class="card">
                                            <div class="card-header d-flex align-items-center justify-content-center">
                                                <h4 class="card-title">Scan QR Code</h4>
                                            </div>
                                            <div class="card-body text-center">
                                                <div id="reader" style="width: 100%;"></div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="d-flex align-items-center justify-content-center">
                                            <h4 class="card-title">Silakan lengkapi terlebih dahulu data profil anda</h4>
                                        </div>
                                    @endif
                                @elseif (auth()->user()->role == 'picket_teacher')
                                <!-- simpan button add disini -->
                                    <div class="d-flex justify-content-center my-3">
                                        <button class="btn btn-primary btn-round" data-bs-toggle="modal"
                                            data-bs-target="#createAttendanceModal">
                                            <i class="fa fa-plus"></i> Add Presensi
                                        </button>
                                    </div>
                                @elseif (auth()->user()->role == 'teacher')
                                    <div class="d-flex align-items-center justify-content-center">
                                        <h4 class="card-title">Scan untuk melakukan presensi</h4>
                                    </div>

                                    @foreach ($teachers as $teacher)
                                        <div class="text-center my-3"> <!-- Menggunakan text-center dan margin vertical -->
                                            <!-- Tombol untuk meregenerasi QR code -->
                                            <button id="regenerate-qr-button" data-id="{{ $teacher->id }}"
                                                class="btn btn-primary mb-2">
                                                Regenerate QR Code
                                            </button>
                                            <!-- Menampilkan QR code -->
                                            <img id="qr-code-{{ $teacher->id }}"
                                                src="{{ asset('assets/qrcodes/' . $teacher->qr_name) }}" alt="QR Code"
                                                class="img-fluid"> <!-- img-fluid untuk responsive image -->
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            @if (auth()->user()->role == 'teacher' || 'admin' || 'picket_teacher')
                                <div class="table-responsive mt-4">
                                    <table id="user-table" class="display table table-striped table-hover">
                                    @php
                                        // Mengambil semua tanggal unik dari attendances
                                        $dates = $attendances->pluck('date')->unique()->sort()->values();
                                    @endphp
                                    <thead>
                                        <tr>
                                            <th>NIS</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Class</th>
                                            <th>Subject</th>
                                            @if (auth()->user()->role == 'picket_teacher')
                                                <th>Teacher</th>
                                            @endif
                                            @foreach ($dates as $date)
                                                <th>{{ $date }}</th> <!-- Tanggal ditampilkan di header -->
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $displayedNisTeacher = [];
                                        @endphp
                                        @foreach ($attendances as $attendance)
                                            @php
                                                $nisTeacherKey = $attendance->student->nis . '-' . $attendance->teacher->id;
                                            @endphp
                                            @if (!in_array($nisTeacherKey, $displayedNisTeacher))
                                                @php
                                                    $displayedNisTeacher[] = $nisTeacherKey;
                                                    // Mengelompokkan data attendance berdasarkan nis dan teacher_id
                                                    $studentAttendances = $attendances->where('student.nis', $attendance->student->nis)
                                                                                    ->where('teacher.id', $attendance->teacher->id);
                                                @endphp
                                                <tr>
                                                    <td>{{ $attendance->student->nis }}</td>
                                                    <td>{{ $attendance->student->name }}</td>
                                                    <td>{{ $attendance->student->jenis_kelamin }}</td>
                                                    <td>{{ $attendance->student->class->name }}</td>
                                                    <td>{{ $attendance->teacher->subject->name }}</td>
                                                    @if (auth()->user()->role == 'picket_teacher')
                                                        <td>{{ $attendance->teacher->name }}</td>
                                                    @endif
                                                    @foreach ($dates as $date)
                                                        <td>
                                                            @php
                                                                $status = $studentAttendances->where('date', $date)->first();
                                                            @endphp
                                                            @if ($status)
                                                                {{ $status->status }} <!-- Status ditampilkan di bawah tanggal yang sesuai -->
                                                            @endif
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>


                                        <tfoot>
                                            <tr>
                                                <th>NIS</th>
                                                <th>Name</th>
                                                <th>Gender</th>
                                                <th>Class</th>
                                                <th>Subject</th>
                                                @if (auth()->user()->role == 'picket_teacher')
                                                <th>Teacher</th>
                                                @endif
                                            </tr>
                                        </tfoot>
                                    </table>
                                    @include('attendances.create', [
                                        'study' => $study,
                                        'teachers' => $teachers,
                                    ])
                                </div>
                            @else
                            @endif
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
    </script>
    <script>
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
                                alert('Presensi Berhasil');
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

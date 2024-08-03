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

@section('content')

    <div class="container mt-4">
        <h2>Attendance List</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div><a href="{{ route('dashboard') }}">Back to Menu</a></div>

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
                <h4>scan untuk melakukan presensi</h4><br>
                @foreach ($teachers as $teacher)
                    <div>
                        <!-- Tombol untuk meregenerasi QR code -->
                        <button id="regenerate-qr-button" data-id="{{ $teacher->id }}">Regenerate QR Code</button>

                        <!-- Menampilkan QR code -->
                        <img id="qr-code-{{ $teacher->id }}" src="{{ asset('assets/qrcodes/' . $teacher->qr_name) }}"
                            alt="QR Code">
                    </div>
                @endforeach
            @endif
        </div>
        <table class="table table-bordered mt-4">
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



@section('scripts')
    <script src="{{ asset('style/assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/script.js') }}"></script>
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

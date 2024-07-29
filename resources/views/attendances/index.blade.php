@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Attendance List</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div><a href="{{ route('dashboard') }}">Back Menu</a></div>
    <div>
        <h4>scan untuk melakukan presensi</h4><br>
        @foreach ($teachers as $teacher )
            <div>
                <img src="{{ asset('assets/qrcodes/' . $teacher->qr_name) }}" alt="QR Code">
            </div>
        @endforeach
        <div class="card">
            <div class="card-header">
                Scan QR Code
            </div>
            <div class="card-body text-center">
                <div id="reader" style="width: 500px; height: 500px;"></div>
            </div>
        </div>
    </div>
    <table class="table table-bordered">
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
@endsection

@section('scripts')
<script>
        document.addEventListener('DOMContentLoaded', (event) => {
            function onScanSuccess(decodedText, decodedResult) {

                // Send data to server
                fetch('{{ route('save.scanned.data') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ data: decodedText })
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
            url: '{{ route("save.scanned.data") }}',
            type: 'POST',
            data: JSON.stringify({ id: yourIdValue }), // Gantilah `yourIdValue` dengan data yang sesuai
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

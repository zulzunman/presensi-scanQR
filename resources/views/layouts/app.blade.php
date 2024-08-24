<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Aplikasi Presensi Online</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport">
    <link rel="icon" href="{{ asset('style/assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon">

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
    <link rel="stylesheet" href="{{ asset('style/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/css/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/css/kaiadmin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/css/demo.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('style/assets/css/style.css') }}">
</head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    // @yield('script1')
</script>
<style>
    /* Menyembunyikan elemen dari tampilan */
    #regenerate-qr-button {
        opacity: 0;
        position: absolute;
        width: 1px;
        height: 1px;
        overflow: hidden;
        border: 0;
        padding: 0;
        margin: -1px;
    }
</style>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            @yield('sidebar')
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            @include('layouts.header')
            <!-- Menu navigasi -->
            <div class="container">
                <div class="page-inner">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('style/assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/kaiadmin.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/setting-demo2.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


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

        $(document).ready(function() {
            // Konfirmasi penghapusan
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const form = button.closest('.delete-form');
                    const username = form.getAttribute('data-name');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: `Do you want to delete the user: ${username}?`,
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

        $(document).ready(function() {
            $('#user-table').DataTable({
                pageLength: 5, // Set number of rows per page
                lengthChange: false, // Disable the option to change the number of rows per page
                searching: true, // Enable the search box
                info: true, // Enable the information text
                paging: true, // Enable pagination
                ordering: false, // Disable column ordering
                language: {
                    paginate: {
                        next: 'Next', // Customize text for next button
                        previous: 'Previous' // Customize text for previous button
                    }
                },
                initComplete: function() {
                    this.api()
                        .columns()
                        .every(function() {
                            var column = this;
                            var select = $(
                                    '<select class="form-select"><option value=""></option></select>'
                                )
                                .appendTo($(column.footer()).empty())
                                .on("change", function() {
                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                    column
                                        .search(val ? "^" + val + "$" : "", true, false)
                                        .draw();
                                });

                            column
                                .data()
                                .unique()
                                .sort()
                                .each(function(d, j) {
                                    select.append(
                                        '<option value="' + d + '">' + d + "</option>"
                                    );
                                });
                        });
                },
            });
        });
    </script>
</body>
<!-- <script>
    // Tentukan lokasi yang diizinkan
    const allowedLatitude = -6.930852; // Contoh latitude dari unla
    const allowedLongitude = 107.615788; // Contoh longitude dari unla
    const allowedRadius = 0.1; // dalam derajat (~11.1 km)

    function distance(lat1, lon1, lat2, lon2) {
        const p = 0.017453292519943295; // Math.PI / 180
        const c = Math.cos;
        const a = 0.5 - c((lat2 - lat1) * p) / 2 +
            c(lat1 * p) * c(lat2 * p) *
            (1 - c((lon2 - lon1) * p)) / 2;
        return 12742 * Math.asin(Math.sqrt(a)); // 2 * R; R = 6371 km
    }

    // Periksa lokasi pengguna
    function checkLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const userLat = position.coords.latitude;
                const userLon = position.coords.longitude;

                const dist = distance(allowedLatitude, allowedLongitude, userLat, userLon);

                if (dist <= allowedRadius) {
                    // Lokasi pengguna dalam jangkauan, izinkan klik tombol otomatis
                    setTimeout(function() {
                        document.getElementById('bookNowButton').click();
                    }, 5000);
                } else {
                    // Arahkan ke link jika pengguna tidak berada dalam lokasi yang diizinkan
                    window.location.href = "https://www.google.com/";
                }
            }, function(error) {
                console.error("Error obtaining location", error);
            });
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    // Panggil fungsi untuk memeriksa lokasi pengguna
    checkLocation();
</script> -->
<script>
    // @yield('scripts')
</script>

</html>

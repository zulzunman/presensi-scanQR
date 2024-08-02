<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <title>Laravel CRUD</title>
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
    <div class="container">
        @yield('content')
    </div>
</body>
<script>
    // @yield('scripts')
</script>

</html>

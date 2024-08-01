<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <title>Laravel CRUD</title>
</head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    // @yield('script1')
</script>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
<script>
    // @yield('scripts')
</script>

</html>

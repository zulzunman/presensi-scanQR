<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('style/assets/css/login.css') }}">

</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-12 col-lg-11 col-xl-10">
                <div class="card d-flex mx-auto my-5">
                    <div class="row">
                        <div class="col-md-5 col-sm-12 col-xs-12 c1 p-5">
                            <div class="row mb-5 m-3">
                                <img src="{{ asset('style/gambar2.jpg') }}" width="70vw" height="55vh"
                                    alt="">
                            </div>
                            <img src="{{ asset('style/gambar1.jpg') }}" width="120vw" height="210vh"
                                class="mx-auto d-flex" alt="Teacher">

                            <div class="row justify-content-center">
                                <div class="w-75 mx-md-5 mx-1 mx-sm-2 mb-5 mt-4 px-sm-5 px-md-2 px-xl-1 px-2">
                                    <h1 class="wlcm">Welcome to my Aplication</h1>
                                    <span class="sp1">
                                        <span class="px-3 bg-danger rounded-pill"></span>
                                        <span class="ml-2 px-1 rounded-circle"></span>
                                        <span class="ml-2 px-1 rounded-circle"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-12 col-xs-12 c2 px-5 pt-5">
                            <form method="POST" action="{{ url('/login') }}" class="px-5 pb-5">
                                @csrf
                                <div class="d-flex">
                                    <h3 class="font-weight-bold">Log in</h3>
                                </div>
                                <div>
                                    <label for="username">Username</label>
                                    <input id="username" type="text" name="username" value="{{ old('username') }}"
                                        required autofocus>
                                </div>
                                <div>
                                    <label for="password">Password</label>
                                    <input id="password" type="password" name="password" required>
                                </div>
                                <div>
                                    <button type="submit" class="text-white text-weight-bold bt">Login</button>
                                </div>
                                @error('username')
                                    <div>{{ $message }}</div>
                                @enderror
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                    window.location.href = "{{route('error')}}";
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
</html>

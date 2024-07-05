
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <h1>Welcome {{ ucfirst($role) }}!</h1>

        <!-- Menu navigasi -->
        <ul>
            @if ($role === 'admin' || $role ==='teacher')
                <li><a href="{{ route('teachers.index') }}">Manage Teachers</a></li>
                <li><a href="{{ route('users.index') }}">Manage Users</a></li>
                <li><a href="{{ route('classes.index') }}">Manage Class</a></li>
                <!-- tambahkan menu untuk guru jika diperlukan -->
            @elseif ($role === 'student')
                <!-- tambahkan menu untuk siswa jika diperlukan -->
            @endif
        </ul>

        <!-- Logout link dan form -->
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
            Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

</body>
</html>

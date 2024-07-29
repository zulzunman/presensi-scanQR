<!DOCTYPE html>
<html lang="en">


<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kaiadmin - Bootstrap 5 Admin Dashboard</title>
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
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    {{-- <a href="index.html" class="logo">
                        <img src="{{ asset('assets/img/kaiadmin/logo_light.svg') }}" alt="navbar brand"
                            class="navbar-brand" height="20">
                    </a> --}}
                    <div class="nav-toggle">
                        <h1>Welcome {{ ucfirst($role) }}!</h1>
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
                <!-- End Logo Header -->
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        @if ($role === 'admin' || $role === 'teacher')
                            <li class="nav-item active">
                                <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                                    <i class="fas fa-home"></i>
                                    <p>Dashboard</p>
                                    <span></span>
                                </a>
                            </li>
                            @if ($role === 'admin')
                                <li class="nav-item">
                                    <a href="{{ route('teachers.index') }}">
                                        <i class="far fa-chart-bar"></i>
                                        <p>Manage Teachers</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('students.index') }}">
                                        <i class="far fa-chart-bar"></i>
                                        <p>Manage Students</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}">
                                        <i class="far fa-chart-bar"></i>
                                        <p>Manage Users</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('subjects.index') }}">
                                        <i class="far fa-chart-bar"></i>
                                        <p>Manage Subject</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('schedules.index') }}">
                                        <i class="far fa-chart-bar"></i>
                                        <p>Manage Schedule</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('classes.index') }}">
                                        <i class="far fa-chart-bar"></i>
                                        <p>Manage Class</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('attendances.index') }}">
                                        <i class="far fa-chart-bar"></i>
                                        <p>Manage Attendance</p>
                                    </a>
                                </li>
                            @elseif ($role === 'teacher')
                                <li class="nav-item">
                                    <a href="{{ route('schedules.index') }}">
                                        <i class="far fa-chart-bar"></i>
                                        <p>Manage Schedule</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('teachers.index') }}">
                                        <i class="far fa-chart-bar"></i>
                                        <p>Manage Teachers</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('attendances.index') }}">
                                        <i class="far fa-chart-bar"></i>
                                        <p>Manage Attendance</p>
                                    </a>
                                </li>
                            @endif
                        @elseif ($role === 'student')
                            <li class="nav-item">
                                <a href="{{ route('students.index') }}">
                                    <i class="far fa-chart-bar"></i>
                                    <p>Manage Students</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('attendances.index') }}">
                                    <i class="far fa-chart-bar"></i>
                                    <p>Manage Attendance</p>
                                </a>
                            </li>
                            <!-- tambahkan menu untuk siswa jika diperlukan -->
                        @endif
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </div>
            </div>

        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <!-- Navbar Header -->
                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">
                        <nav
                            class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="submit" class="btn btn-search pe-1">
                                        <i class="fa fa-search search-icon"></i>
                                    </button>
                                </div>
                                <input type="text" placeholder="Search ..." class="form-control">
                            </div>
                        </nav>
                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            <li class="nav-item topbar-icond-flex d-lg-none">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#"
                                    role="button" aria-expanded="false" aria-haspopup="true">
                                    <i class="fa fa-search"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-search animated fadeIn">
                                    <form class="navbar-left navbar-form nav-search">
                                        <div class="input-group">
                                            <input type="text" placeholder="Search ..." class="form-control">
                                        </div>
                                    </form>
                                </ul>
                            </li>
                            <li class="nav-item topbar-icon dropdown hidden-caret">
                                <a class="nav-link dropdown-toggle" href="#" id="messageDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fa fa-envelope"></i>
                                </a>
                            </li>

                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                                    aria-expanded="false">
                                    {{-- <div class="avatar-sm">
                                        <img src="{{ asset('assets/img/profile.jpg') }}" alt="..."
                                            class="avatar-img rounded-circle">
                                    </div> --}}
                                    <span class="profile-username">
                                        <span class="op-7">Hi,</span>
                                        <span class="fw-bold">Hizrian</span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                {{-- <div class="avatar-lg">
                                                    <img src="{{ asset('assets/img/profile.jpg') }}"
                                                        alt="image profile" class="avatar-img rounded">
                                                </div> --}}
                                                <div class="u-text">
                                                    <h4>Hizrian</h4>
                                                    <p class="text-muted">hello@example.com</p>
                                                    <a href="profile.html"
                                                        class="btn btn-xs btn-secondary btn-sm">View
                                                        Profile</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">My Profile</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Account Setting</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Logout</a>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>
            <!-- Menu navigasi -->
            <div class="container">
                <div class="page-inner">
                    @yield('content')
                    <!-- Placeholder for main content -->
                </div>
            </div>
        </div>
    </div>
</body>

</html>

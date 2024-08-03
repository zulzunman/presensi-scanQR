@section('sidebar')
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

@endsection

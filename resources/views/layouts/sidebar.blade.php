<!-- resources/views/layouts/sidebar.blade.php -->

<div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
        <div class="user">
            <div class="avatar-sm float-left mr-2">
                <img src="{{ asset('style/assets/img/profile.jpg') }}" alt="..." class="avatar-img rounded-circle">
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                    <span>
                        Hizrian
                        <span class="user-level">Administrator</span>
                        <span class="caret"></span>
                    </span>
                </a>
                <div class="clearfix"></div>
                <div class="collapse in" id="collapseExample">
                    <ul class="nav">
                        <li>
                            <a href="#profile">
                                <span class="link-collapse">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="#edit">
                                <span class="link-collapse">Edit Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="#settings">
                                <span class="link-collapse">Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav nav-secondary">
            <li class="nav-item active">
                <a data-bs-toggle="collapse" href="{{ route('dashboard') }}" class="collapsed" aria-expanded="false">
                    <i class="fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                    <span></span>
                </a>
            </li>
            @if (auth()->user()->role == 'admin')
                <li class="nav-item">
                    <a href="{{ route('teachers.index') }}">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <p>Manage Teachers</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('students.index') }}">
                        <i class="fas fa-user-graduate"></i>
                        <p>Manage Students</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}">
                        <i class="fas fa-users-cog"></i>
                        <p>Manage Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('subjects.index') }}">
                        <i class="fas fa-book-open"></i>
                        <p>Manage Subjects</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('schedules.index') }}">
                        <i class="fas fa-calendar-alt"></i>
                        <p>Manage Schedule</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('classes.index') }}">
                        <i class="fas fa-school"></i>
                        <p>Manage Class</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('attendances.index') }}">
                        <i class="fas fa-clipboard-list"></i>
                        <p>Manage Attendance</p>
                    </a>
                </li>
            @elseif (auth()->user()->role == 'teacher')
                <li class="nav-item">
                    <a href="{{ route('schedules.index') }}">
                        <i class="fas fa-calendar-alt"></i>
                        <p>Manage Schedule</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('teachers.index') }}">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <p>Profil Teachers</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('attendances.index') }}">
                        <i class="fas fa-clipboard-list"></i>
                        <p>Manage Attendance</p>
                    </a>
                </li>
            @elseif (auth()->user()->role == 'student')
                <li class="nav-item">
                    <a href="{{ route('students.index') }}">
                        <i class="fas fa-user-graduate"></i>
                        <p>Manage Students</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('attendances.index') }}">
                        <i class="fas fa-clipboard-list"></i>
                        <p>Manage Attendance</p>
                    </a>
                </li>
                <!-- tambahkan menu untuk siswa jika diperlukan -->
            @endif
            <li class="nav-item">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <p>Logout</p>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>

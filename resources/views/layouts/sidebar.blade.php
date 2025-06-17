<!-- resources/views/layouts/sidebar.blade.php -->

<div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
        <ul class="nav nav-secondary">
            <!-- Dashboard Item -->
            <li class="nav-item">
                <a href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            @if (auth()->user()->role == 'admin')
                <!-- Admin Features -->
                <li class="nav-item">
                    <a href="{{ route('teachers.index') }}">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <p>Kelola Guru</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('students.index') }}">
                        <i class="fas fa-user-graduate"></i>
                        <p>Kelola Siswa</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}">
                        <i class="fas fa-users-cog"></i>
                        <p>Kelola Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('subjects.index') }}">
                        <i class="fas fa-book-open"></i>
                        <p>Kelola Mata Pelajaran</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('schedules.index') }}">
                        <i class="fas fa-calendar-alt"></i>
                        <p>Kelola Jadwal</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('classes.index') }}">
                        <i class="fas fa-school"></i>
                        <p>Kelola Kelas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('attendances.index') }}">
                        <i class="fas fa-clipboard-list"></i>
                        <p>Kelola Kehadiran</p>
                    </a>
                </li>
            @elseif (auth()->user()->role == 'teacher')
                <!-- Teacher Features -->
                <li class="nav-item">
                    <a href="{{ route('schedules.index') }}">
                        <i class="fas fa-calendar-alt"></i>
                        <p>Kelola Jadwal</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('teachers.index') }}">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('attendances.index') }}">
                        <i class="fas fa-clipboard-list"></i>
                        <p>Kelola Kehadiran</p>
                    </a>
                </li>
            @elseif (auth()->user()->role == 'student')
                <!-- Student Features -->
                <li class="nav-item">
                    <a href="{{ route('students.index') }}">
                        <i class="fas fa-user-graduate"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('attendances.index') }}">
                        <i class="fas fa-clipboard-list"></i>
                        <p>Kelola Kehadiran</p>
                    </a>
                </li>
                <!-- Tambahkan menu untuk siswa jika diperlukan -->
            @elseif (auth()->user()->role == 'picket_teacher')
                <!-- Student Features -->
                <li class="nav-item">
                    <a href="{{ route('attendances.index') }}">
                        <i class="fas fa-clipboard-list"></i>
                        <p>Kelola Kehadiran</p>
                    </a>
                </li>
                <!-- Tambahkan menu untuk siswa jika diperlukan -->
            @endif
            <!-- Logout Item -->
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

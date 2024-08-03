@extends('layouts.app')
@section('sidebar')
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
                    <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                        <span></span>
                    </a>
                </li>
                @if ($role === 'admin')
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
                @elseif ($role === 'teacher')
                    <li class="nav-item">
                        <a href="{{ route('schedules.index') }}">
                            <i class="fas fa-calendar-alt"></i>
                            <p>Manage Schedule</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('teachers.index') }}">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <p>Manage Teachers</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('attendances.index') }}">
                            <i class="fas fa-clipboard-list"></i>
                            <p>Manage Attendance</p>
                        </a>
                    </li>
                @elseif ($role === 'student')
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
@endsection

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            @if (session('success'))
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        Swal.fire({
                                            title: 'Success!',
                                            text: '{{ session('success') }}',
                                            icon: 'success',
                                            confirmButtonText: 'OK'
                                        });
                                    });
                                </script>
                            @endif
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Schedule List</h4>
                                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                    data-bs-target="#createScheduleModal">
                                    <i class="fa fa-plus"></i>
                                    Add Schedule
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Day</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Subject</th>
                                            <th>Class</th>
                                            @if (auth()->user()->role == 'admin')
                                                <th>Actions</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $sortedSchedules = $schedules->sortBy(function ($schedule) {
                                                return $schedule->day . $schedule->start_time;
                                            });
                                            $hariSebelumnya = null;
                                        @endphp
                                        @foreach ($sortedSchedules as $schedule)
                                            <tr>
                                                @if ($schedule->day != $hariSebelumnya)
                                                    <td>{{ $schedule->day }}</td>
                                                    @php
                                                        $hariSebelumnya = $schedule->day;
                                                    @endphp
                                                @else
                                                    <td></td>
                                                @endif
                                                <td>{{ $schedule->start_time }}</td>
                                                <td>{{ $schedule->end_time }}</td>
                                                <td>{{ $schedule->subject->name }}</td>
                                                <td>{{ $schedule->class->name }}</td>
                                                @if (auth()->user()->role == 'admin')
                                                    <td>
                                                        <div class="form-button-action">
                                                            <button class="btn btn-link btn-primary btn-lg"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editScheduleModal{{ $schedule->id }}">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <form action="{{ route('schedules.destroy', $schedule->id) }}"
                                                                method="POST" class="delete-form"
                                                                data-name="{{ $schedule->name }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" data-bs-toggle="tooltip"
                                                                    title="Remove"
                                                                    class="btn btn-link btn-danger delete-btn">
                                                                    <i class="fa fa-times"></i>
                                                                </button>
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                            @include('schedules.edit', [
                                                'schedule' => $schedule,
                                                'subjects' => $subjects,
                                                'classes' => $classes,
                                            ])
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @include('schedules.create', ['subjects' => $subjects, 'classes' => $classes])
                </div>
            </div>
        </div>
    </div>
@endsection

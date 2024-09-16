@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="card-title">Daftar Jadwal</h4>
                                @if (auth()->user()->role == 'admin')
                                    <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                        data-bs-target="#createScheduleModal">
                                        <i class="fa fa-plus"></i>
                                        Tambah Jadwal
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="d-flex justify-content-end mb-3">
                                    <div class="d-flex align-items-center me-3">
                                        <label for="sort-by-class" class="form-label me-2">Urutkan dengan kelas:</label>
                                        <select id="sort-by-class" class="form-select" onchange="filterSchedulesByClass()">
                                            <option value="all">Semua Kelas</option>
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->name }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <table id="user-table" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Hari</th>
                                            <th>Jam Mulai</th>
                                            <th>Jam Berakhir</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Guru</th>
                                            <th>Kelas</th>
                                            @if (auth()->user()->role == 'admin')
                                                <th>Aksi</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody id="schedule-body">
                                        @foreach ($schedules as $schedule)
                                            <tr data-class="{{ $schedule->class->name }}">
                                                <td>{{ $schedule->day }}</td>
                                                <td>{{ $schedule->start_time }}</td>
                                                <td>{{ $schedule->end_time }}</td>
                                                <td>{{ $schedule->subject->name }}</td>
                                                <td>{{ $schedule->teacher->name }}</td>
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
                                                            </form>
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
                    @include('schedules.create', ['subjects' => $subjects, 'classes' => $classes, 'teachers' => $teachers])
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function filterSchedulesByClass() {
            var selectedClass = document.getElementById('sort-by-class').value.trim();
            var tableBody = document.getElementById('schedule-body');
            var rows = Array.from(tableBody.getElementsByTagName('tr'));

            console.log("Selected Class: ", selectedClass); // Debugging line
            console.log("Total Rows: ", rows.length); // Debugging line

            rows.forEach(function(row) {
                var rowClass = row.getAttribute('data-class').trim();
                console.log("Row Class: ", rowClass); // Debugging line

                if (selectedClass === 'all' || rowClass === selectedClass) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }

                console.log("Display Style for Row: ", row.style.display); // Debugging line
            });
        }

        // Ensure the function is called when the page loads if needed
        document.addEventListener('DOMContentLoaded', function() {
            filterSchedulesByClass(); // Optional: Call to filter initially if desired
        });
    </script>
@endsection

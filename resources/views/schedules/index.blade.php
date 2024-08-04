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
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Schedule List</h4>
                                @if (auth()->user()->role == 'admin')
                                    <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                        data-bs-target="#createScheduleModal">
                                        <i class="fa fa-plus"></i>
                                        Add Schedule
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="user-table" class="display table table-striped table-hover">
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
                    @include('schedules.create', ['subjects' => $subjects, 'classes' => $classes])
                </div>
            </div>
        </div>
    </div>
@endsection

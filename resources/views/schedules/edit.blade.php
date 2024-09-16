<div class="modal fade" id="editScheduleModal{{ $schedule->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editScheduleModalLabel{{ $schedule->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editScheduleModalLabel{{ $schedule->id }}">Edit Jadwal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('schedules.update', $schedule->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="subject_id{{ $schedule->id }}">Mata Pelajaran</label>
                        <select class="form-control" id="subject_id{{ $schedule->id }}" name="subject_id" required>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}"
                                    {{ $schedule->subject_id == $subject->id ? 'selected' : '' }}>{{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="teacher_id{{ $schedule->id }}">Guru</label>
                        <select class="form-control" id="teacher_id{{ $schedule->id }}" name="teacher_id" required>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}"
                                    {{ $schedule->teacher_id == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="class_id{{ $schedule->id }}">Kelas</label>
                        <select class="form-control" id="class_id{{ $schedule->id }}" name="class_id" required>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}"
                                    {{ $schedule->class_id == $class->id ? 'selected' : '' }}>{{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="day{{ $schedule->id }}">Hari</label>
                        <select class="form-control" id="day{{ $schedule->id }}" name="day" required>
                            <option value="Monday" {{ $schedule->day == 'Monday' ? 'selected' : '' }}>Senin</option>
                            <option value="Tuesday" {{ $schedule->day == 'Tuesday' ? 'selected' : '' }}>Selasa
                            </option>
                            <option value="Wednesday" {{ $schedule->day == 'Wednesday' ? 'selected' : '' }}>Rabu
                            </option>
                            <option value="Thursday" {{ $schedule->day == 'Thursday' ? 'selected' : '' }}>Kamis
                            </option>
                            <option value="Friday" {{ $schedule->day == 'Friday' ? 'selected' : '' }}>Jumat</option>
                            <option value="Saturday" {{ $schedule->day == 'Saturday' ? 'selected' : '' }}>Sabtu
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start_time{{ $schedule->id }}">Jam Mulai</label>
                        <input type="time" class="form-control" id="start_time{{ $schedule->id }}" name="start_time"
                            value="{{ $schedule->start_time }}" required>
                    </div>
                    <div class="form-group">
                        <label for="end_time{{ $schedule->id }}">Jam Berakhir</label>
                        <input type="time" class="form-control" id="end_time{{ $schedule->id }}" name="end_time"
                            value="{{ $schedule->end_time }}" required>
                    </div>
                    <div class="form-group d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary ms-2">Perbaharui Jadwal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


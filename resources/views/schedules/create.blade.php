<div class="modal fade" id="createScheduleModal" tabindex="-1" role="dialog" aria-labelledby="createScheduleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createScheduleModalLabel">Buat Jadwal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('schedules.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="subject_id">Mata Pelajaran</label>
                        <select class="form-control" id="subject_id" name="subject_id" required>
                            <option value="" disabled selected>Pilih Mata Pelajaran</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="teacher_id">Guru</label>
                        <select class="form-control" id="teacher_id" name="teacher_id" required>
                            <option value="" disabled selected>Pilih Guru</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="class_id">Kelas</label>
                        <select class="form-control" id="class_id" name="class_id" required>
                            <option value="" disabled selected>Pilih Kelas</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="day">Hari</label>
                        <select class="form-control" id="day" name="day" required>
                            <option value="" disabled selected>Pilih Hari</option>
                            <option value="Monday">Senin</option>
                            <option value="Tuesday">Selasa</option>
                            <option value="Wednesday">Rabu</option>
                            <option value="Thursday">Kamis</option>
                            <option value="Friday">Jumat</option>
                            <option value="Saturday">Sabtu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start_time">Jam Mulai</label>
                        <input type="time" class="form-control" id="start_time" name="start_time"
                            value="{{ old('start_time') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="end_time">Jam Berakhir</label>
                        <input type="time" class="form-control" id="end_time" name="end_time"
                            value="{{ old('end_time') }}" required>
                    </div>
                    <div class="form-group d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary ms-2">Tambah Jadwal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

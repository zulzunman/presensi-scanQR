<div class="modal fade" id="createAttendanceModal" tabindex="-1" role="dialog" aria-labelledby="createAttendanceModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createAttendanceModal">Create Attendance</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('attendance.add') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="student_id">Student :</label>
                        <select class="form-control" id="student_id" name="student_id" required>
                            <option value="" disabled selected>Select Student</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="teacher_id">Teacher :</label>
                        <select name="teacher_id" id="teacher_id" class="form-control">
                            <option value="" disabled selected>Select Teacher</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Status :</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                            <option value="" disabled selected>Select Status</option>
                            <option value="Izin">Izin</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Tidak Ada Keterangan">Tidak Ada Keterangan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="attendance_date">Date :</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="attendance_time">Time :</label>
                        <input type="time" class="form-control" id="time" name="time" required>
                    </div>
                    <div class="form-group d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary ms-2">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

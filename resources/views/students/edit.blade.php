<div class="modal fade" id="editStudentModal{{ $student->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editStudentModalLabel{{ $student->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStudentModalLabel{{ $student->id }}">Edit Student</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('students.update', $student->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nis">NIS:</label>
                        <input type="text" name="nis" id="nis" class="form-control"
                            value="{{ $student->nis }}">
                    </div>

                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ $student->name }}">
                    </div>

                    <div class="form-group">
                        <label for="jenis_kelamin">Gender:</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                            <option value="Laki - Laki"
                                {{ $student->jenis_kelamin == 'Laki - Laki' ? 'selected' : '' }}>Laki - Laki</option>
                            <option value="Perempuan" {{ $student->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="class_id">Class:</label>
                        <select name="class_id" id="class_id" class="form-control">
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}"
                                    {{ $student->class_id == $class->id ? 'selected' : '' }}>{{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="user_id">Account:</label>
                        <select name="user_id" id="user_id" class="form-control">
                            @foreach ($users as $account)
                                <option value="{{ $account->id }}"
                                    {{ $student->user_id == $account->id ? 'selected' : '' }}>{{ $account->username }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary ms-2">Update Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

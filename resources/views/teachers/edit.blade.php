<!-- Edit Teacher Modal -->
<div class="modal fade" id="editTeacherModal{{ $teacher->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editTeacherModalLabel{{ $teacher->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTeacherModalLabel{{ $teacher->id }}">Edit Guru</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('teachers.update', $teacher->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nip">NIP:</label>
                        <input type="text" name="nip" id="nip" class="form-control"
                            value="{{ $teacher->nip }}">
                    </div>

                    <div class="form-group">
                        <label for="user_id">Akun:</label>
                        <select name="user_id" id="user_id" class="form-control">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ $user->id == $teacher->user_id ? 'selected' : '' }}>{{ $user->username }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Nama Lengkap:</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ $teacher->name }}">
                    </div>

                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin:</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                            <option value="Laki - Laki"
                                {{ $teacher->jenis_kelamin == 'Laki - Laki' ? 'selected' : '' }}>Laki - Laki</option>
                            <option value="Perempuan" {{ $teacher->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="subject_id">Mata Pelajaran:</label>
                        <select name="subject_id" id="subject_id" class="form-control">
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}"
                                    {{ $subject->id == $teacher->subject_id ? 'selected' : '' }}>{{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary ms-2">Perbaharui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

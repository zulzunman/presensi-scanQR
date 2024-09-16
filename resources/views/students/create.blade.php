<!-- Create Student Modal -->
<div class="modal fade" id="createStudentModal" tabindex="-1" role="dialog" aria-labelledby="createStudentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createStudentModalLabel">Buat Data Siswa</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('students.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nis">NIS:</label>
                        <input type="text" name="nis" id="nis" class="form-control"
                            value="{{ old('nis') }}">
                    </div>

                    @if (auth()->user()->role == 'admin')
                        <div class="form-group">
                            <label for="user_id">Akun:</label>
                            <select name="user_id" id="user_id" class="form-control">
                                <option value="" disabled selected>Pilih Akun</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                                @endforeach
                            </select>
                        </div>
                    @elseif (auth()->user()->role == 'student')
                        <div class="form-group">
                            <input type="hidden" name="user_id" id="user_id" class="form-control" value="{{ $userData->id }}">
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="name">Nama Lengkap:</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin:</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <option value="L">Laki - Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="class_id">Kelas:</label>
                        <select name="class_id" id="class_id" class="form-control">
                            <option value="" disabled selected>Pilih Kelas</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary ms-2">Buat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

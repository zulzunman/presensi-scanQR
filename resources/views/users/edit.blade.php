<div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editUserModal{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModal{{ $user->id }}">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="username">Username :</label>
                        <input type="text" id="username" name="username" class="form-control"
                            value="{{ $user->username }}" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password (biarkan kosong untuk menyimpan kata sandi saat ini) :</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="role">Hak Akses :</label>
                        <select id="role" name="role" class="form-select" required>
                            @if ($role === 'admin')
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="teacher" {{ $user->role == 'teacher' ? 'selected' : '' }}>Guru
                                </option>
                                <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>Siswa
                                </option>
                            @elseif ($role === 'teacher')
                                <option value="teacher" {{ $user->role == 'teacher' ? 'selected' : '' }}>Guru
                                </option>
                            @elseif ($role === 'student')
                                <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>Siswa
                                </option>
                            @endif
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

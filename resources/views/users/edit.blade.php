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
                        <label for="password">Password (leave blank to keep current password) :</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="role">Role :</label>
                        <select id="role" name="role" class="form-select" required>
                            @if ($role === 'admin')
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>

                                <option value="teacher" {{ $user->role == 'teacher' ? 'selected' : '' }}>Teacher
                                </option>
                                <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>Student
                                </option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary ms-2">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

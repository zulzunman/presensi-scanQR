<!-- resources/views/classes/create.blade.php -->
<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createClassModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">Create Users</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createUserForm" method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username :</label>
                        <input type="text" id="username" name="name" class="form-control" placeholder="Username"
                            required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="password">Password :</label>
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Password" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="role">Role :</label>
                        <select id="role" name="role" class="form-control" required>
                            <option value="" disabled selected>Select role</option>
                            @if ($role === 'admin')
                                <option value="admin">Admin</option>
                                <option value="teacher">Teacher</option>
                                <option value="student">Student</option>
                                <!-- tambahkan menu lainnya untuk admin -->
                            @elseif ($role === 'teacher')
                                <option value="teacher">Teacher</option>
                                <option value="student">Student</option>
                                <!-- tambahkan menu untuk guru jika diperlukan -->
                            @endif
                        </select>
                    </div>

                    <div class="form-group d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary ms-2">Add Users</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

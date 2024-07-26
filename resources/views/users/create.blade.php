<!-- resources/views/classes/create.blade.php -->
<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createClassModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">Create Subject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Username :</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="name">Password :</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Password">
                    </div>
                    <div>
                        <div class="form-group">
                            <label for="role">Role :</label>
                            <select id="role" name="role" class="form-control" required>
                                @if ($role === 'admin')
                                    <option>Select</option>
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

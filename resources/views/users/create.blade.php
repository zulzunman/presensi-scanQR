<!-- resources/views/users/create.blade.php -->
<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel"
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
                        <label for="usernameCreate">Username :</label>
                        <input type="text" id="usernameCreate" name="username" class="form-control"
                            placeholder="Username" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="passwordCreate">Password :</label>
                        <input type="password" id="passwordCreate" name="password" class="form-control"
                            placeholder="Password" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="roleCreate">Role :</label>
                        <select id="roleCreate" name="role" class="form-control" required>
                            <option value="" disabled selected>Select role</option>
                            <option value="admin">Admin</option>
                            <option value="teacher">Teacher</option>
                            <option value="picket_teacher">Picket Teacher</option>
                            <option value="student">Student</option>
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

<!-- Create Teacher Modal -->
<div class="modal fade" id="createTeacherModal" tabindex="-1" role="dialog" aria-labelledby="createTeacherModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTeacherModalLabel">Create Teacher</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('teachers.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nip">NIP:</label>
                        <input type="text" name="nip" id="nip" class="form-control"
                            value="{{ old('nip') }}">
                    </div>

                    @if (auth()->user()->role == 'admin')
                        <div class="form-group">
                            <label for="user_id">Account:</label>
                            <select name="user_id" id="user_id" class="form-control">
                                <option value="" disabled selected>Select Account</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                                @endforeach
                            </select>
                        </div>
                    @elseif (auth()->user()->role == 'teacher')
                        <div class="form-group">
                            <input type="hidden" name="user_id" id="user_id" class="form-control" value="{{ $user->id }}">
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="jenis_kelamin">Gender:</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                            <option value="" disabled selected>Select Gender</option>
                            <option value="Laki - Laki">Laki - Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="subject_id">Subject:</label>
                        <select name="subject_id" id="subject_id" class="form-control">
                            <option value="" disabled selected>Select Subject</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
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

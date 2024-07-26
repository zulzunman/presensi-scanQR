<!-- resources/views/classes/create.blade.php -->
<div class="modal fade" id="createSubjectModal" tabindex="-1" role="dialog" aria-labelledby="createClassModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createSubjectModalLabel">Create Subject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('subjects.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name :</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary ms-2">Add Subject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- resources/views/classes/edit.blade.php -->
<div class="modal fade" id="editSubjectModal{{ $subject->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editSubjectModal{{ $subject->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSubjectModal{{ $subject->id }}">Edit Subject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('subjects.update', $subject->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" class="form-control"
                            value="{{ $subject->name }}" required>
                    </div>
                    <div class="form-group d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary ms-2">Update Subject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- resources/views/classes/edit.blade.php -->
<div class="modal fade" id="editClassModal{{ $class->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editClassModalLabel{{ $class->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editClassModalLabel{{ $class->id }}">Edit Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('classes.update', $class->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nama Kelas :</label>
                        <input type="text" id="name" name="name" class="form-control"
                            value="{{ $class->name }}" required>
                    </div>
                    <div class="form-group d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary ms-2">Perbaharui Kelas</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

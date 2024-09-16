<!-- resources/views/classes/show.blade.php -->
<div class="modal fade" id="viewClassModal{{ $class->id }}" tabindex="-1" role="dialog"
    aria-labelledby="viewClassModalLabel{{ $class->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewClassModalLabel{{ $class->id }}">Rincian Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nama Kelas :</strong> {{ $class->name }}</p>
            </div>
        </div>
    </div>
</div>

<!-- resources/views/classes/show.blade.php -->
<div class="modal fade" id="viewSubjectModal{{ $subject->id }}" tabindex="-1" role="dialog"
    aria-labelledby="viewSubjectModalLabel{{ $subject->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewSubjectModalLabel{{ $subject->id }}">Rincian Mata Pelajaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nama :</strong> {{ $subject->name }}</p>
            </div>
        </div>
    </div>
</div>

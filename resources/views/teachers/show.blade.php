<!-- Show Teacher Modal -->
<div class="modal fade" id="showTeacherModal{{ $teacher->id }}" tabindex="-1" role="dialog"
    aria-labelledby="showTeacherModalLabel{{ $teacher->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showTeacherModalLabel{{ $teacher->id }}">Rincian Guru</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Nama Lengkap:</strong> {{ $teacher->name }}</p>
                <p><strong>NIP:</strong> {{ $teacher->nip }}</p>
                <p><strong>Akun:</strong> {{ $teacher->user->username }}</p>
                <p><strong>Jenis Kelamin:</strong> {{ $teacher->jenis_kelamin }}</p>
                <p><strong>Mata Pelajaran:</strong> {{ $teacher->subject->name }}</p>
            </div>
        </div>
    </div>
</div>

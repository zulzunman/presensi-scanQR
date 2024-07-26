<!-- resources/views/classes/show.blade.php -->
<div class="modal fade" id="viewUserModal{{ $user->id }}" tabindex="-1" role="dialog"
    aria-labelledby="viewUserModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewUserModalLabel{{ $user->id }}">Subject User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Username :</strong> {{ $user->username }}</p>
                <p><strong>Role :</strong> {{ $user->role }}</p>
            </div>
        </div>
    </div>
</div>

@extends('layouts.admin')

@section('admincontent')
<div class="container">
    <h2 class="mb-4">Bloggers</h2>

    <table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @if($user->is_active)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-danger">Suspended</span>
                @endif
            </td>
            <td class="d-flex gap-2">

                <!-- VIEW BUTTON -->
                <button
                    class="btn btn-sm btn-info"
                    data-bs-toggle="modal"
                    data-bs-target="#viewUserModal"
                    data-name="{{ $user->name }}"
                    data-email="{{ $user->email }}"
                    data-phone="{{ $user->phone }}"
                    data-role="{{ $user->role }}"
                    data-status="{{ $user->is_active ? 'Active' : 'Suspended' }}"
                    data-created="{{ $user->created_at->format('d M Y') }}"
                >
                    View
                </button>

                <!-- SUSPEND / ACTIVATE -->
                <form method="POST" action="{{ route('admin.users.toggle', $user) }}">
                    @csrf
                    <button class="btn btn-sm {{ $user->is_active ? 'btn-warning' : 'btn-success' }}">
                        {{ $user->is_active ? 'Suspend' : 'Activate' }}
                    </button>
                </form>

                <!-- DELETE -->
                <form method="POST" action="{{ route('admin.users.destroy', $user) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete user?')">
                        Delete
                    </button>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- VIEW USER MODAL -->
<div class="modal fade" id="viewUserModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">User Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p><strong>Full Name:</strong> <span id="modalName"></span></p>
                <p><strong>Email:</strong> <span id="modalEmail"></span></p>
                <p><strong>Phone:</strong> <span id="modalPhone"></span></p>
                <p><strong>Role:</strong> <span id="modalRole"></span></p>
                <p><strong>Status:</strong> <span id="modalStatus"></span></p>
                <p><strong>Joined:</strong> <span id="modalCreated"></span></p>
            </div>

        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('viewUserModal');

    modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;

        document.getElementById('modalName').textContent   = button.dataset.name;
        document.getElementById('modalEmail').textContent  = button.dataset.email;
        document.getElementById('modalPhone').textContent  = button.dataset.phone ?? 'N/A';
        document.getElementById('modalRole').textContent   = button.dataset.role;
        document.getElementById('modalStatus').textContent = button.dataset.status;
        document.getElementById('modalCreated').textContent = button.dataset.created;
    });
});
</script>
@endsection
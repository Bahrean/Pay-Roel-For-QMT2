@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content" style="padding: 25px 15px;">
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-sm border-0" style="background-color: #001B07; border-radius: 12px;">
                    <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center py-3">
                        <h5 class="mb-0 text-white">
                            <i class="fas fa-users-cog me-2"></i> All Registered Farmers
                        </h5>
                        <div>
                            <a href="{{ route('firebase.users.sync') }}" class="btn btn-primary btn-sm rounded-pill">
                                <i class="fas fa-sync-alt me-1"></i> Sync from Firebase
                            </a>
                            <button class="btn btn-info btn-sm rounded-pill ms-2" data-bs-toggle="modal" data-bs-target="#helpModal">
                                <i class="fas fa-question-circle me-1"></i> Help
                            </button>
                        </div>
                    </div>

                    <div class="card-body px-0">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show mx-3 rounded" role="alert">
                                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show mx-3 rounded" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="px-3 mb-3 d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                          
                            </div>
                            <div class="text-white small">
                                Showing <span class="fw-bold">{{ $users->count() }}</span> user(s)
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover mb-0" id="usersTable">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="ps-4">ID</th>
                                        <th>Firebase UID</th>
                                        <th>Email</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Last Activity</th>
                                        <th class="text-end pe-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr class="align-middle">
                                            <td class="ps-4">{{ $user->id }}</td>
                                            <td>
                                                <span class="d-inline-block text-truncate" style="max-width: 120px;" data-bs-toggle="tooltip" title="{{ $user->firebase_uid }}">
                                                    {{ $user->firebase_uid }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="mailto:{{ $user->email }}" class="text-primary">
                                                    {{ $user->email }}
                                                </a>
                                            </td>
                                            <td>{{ $user->display_name ?? '-' }}</td>
                                            <td>
                                                @if($user->email_verified)
                                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill">
                                                        <i class="fas fa-check-circle me-1"></i> Verified
                                                    </span>
                                                @else
                                                    <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill">
                                                        <i class="fas fa-exclamation-circle me-1"></i> Unverified
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($user->last_sign_in_at)
                                                    <span data-bs-toggle="tooltip" title="{{ $user->last_sign_in_at->format('g:i A, M d, Y') }}">
                                                        {{ $user->last_sign_in_at->diffForHumans() }}
                                                    </span>
                                                @else
                                                    Never signed in
                                                @endif
                                            </td>
                                            <td class="text-end pe-4">
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="userActions{{ $user->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userActions{{ $user->id }}">
                                                        <li>
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#userDetailsModal{{ $user->id }}">
                                                                <i class="fas fa-eye me-2"></i> View Details
                                                            </a>
                                                        </li>
                                                        <!-- <li>
                                                            <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteUserModal{{ $user->id }}">
                                                                <i class="fas fa-trash-alt me-2"></i> Delete
                                                            </a>
                                                        </li> -->
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- User Details Modal -->
                                        <div class="modal fade" id="userDetailsModal{{ $user->id }}" tabindex="-1" aria-labelledby="userDetailsModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content" style="background-color: #001B07;">
                                                    <div class="modal-header border-0">
                                                        <h5 class="modal-title text-white" id="userDetailsModalLabel">User Details</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <div class="card bg-dark border-0 h-100">
                                                                    <div class="card-body">
                                                                        <h6 class="text-info mb-3"><i class="fas fa-id-card me-2"></i>Basic Information</h6>
                                                                        <div class="mb-2">
                                                                            <small class="text-muted">Firebase UID:</small>
                                                                            <p class="text-break">{{ $user->firebase_uid }}</p>
                                                                        </div>
                                                                        <div class="mb-2">
                                                                            <small class="text-muted">Email:</small>
                                                                            <p>{{ $user->email }}</p>
                                                                        </div>
                                                                        <div class="mb-2">
                                                                            <small class="text-muted">Display Name:</small>
                                                                            <p>{{ $user->display_name ?? 'Not provided' }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <div class="card bg-dark border-0 h-100">
                                                                    <div class="card-body">
                                                                        <h6 class="text-info mb-3"><i class="fas fa-history me-2"></i>Activity</h6>
                                                                        <div class="mb-2">
                                                                            <small class="text-muted">Email Verified:</small>
                                                                            <p>
                                                                                @if($user->email_verified)
                                                                                    <span class="badge bg-success rounded-pill">Yes</span>
                                                                                @else
                                                                                    <span class="badge bg-warning rounded-pill">No</span>
                                                                                @endif
                                                                            </p>
                                                                        </div>
                                                                        <div class="mb-2">
                                                                            <small class="text-muted">Last Sign In:</small>
                                                                            <p>
                                                                                @if($user->last_sign_in_at)
                                                                                    {{ $user->last_sign_in_at->format('M d, Y \a\t g:i A') }}
                                                                                    <br>
                                                                                    <small>({{ $user->last_sign_in_at->diffForHumans() }})</small>
                                                                                @else
                                                                                    Never signed in
                                                                                @endif
                                                                            </p>
                                                                        </div>
                                                                        <div class="mb-2">
                                                                            <small class="text-muted">Synced At:</small>
                                                                            <p>
                                                                                {{ $user->updated_at->format('M d, Y \a\t g:i A') }}
                                                                                <br>
                                                                                <small>({{ $user->updated_at->diffForHumans() }})</small>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer border-0">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Delete User Modal -->
                                        <!-- <div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content" style="background-color: #001B07;">
                                                    <div class="modal-header border-0">
                                                        <h5 class="modal-title text-white" id="deleteUserModalLabel">Confirm Deletion</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to delete this user?</p>
                                                        <p class="fw-bold">{{ $user->email }}</p>
                                                        <p class="small text-muted">This action will remove the user from your database but not from Firebase.</p>
                                                    </div>
                                                    <div class="modal-footer border-0">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <form action="#" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete User</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4">
                                                <div class="d-flex flex-column align-items-center justify-content-center">
                                                    <i class="fas fa-users-slash fs-1 text-muted mb-2"></i>
                                                    <h5 class="text-muted">No users found</h5>
                                                    <p class="text-muted small">Try syncing users from Firebase</p>
                                                    <a href="{{ route('firebase.users.sync') }}" class="btn btn-sm btn-primary mt-2">
                                                        <i class="fas fa-sync-alt me-1"></i> Sync Now
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

             
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Help Modal -->
<div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="helpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #001B07;">
            <div class="modal-header border-0">
                <h5 class="modal-title text-white" id="helpModalLabel"><i class="fas fa-question-circle me-2"></i>Help</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 class="text-info mb-3">About this page</h6>
                <p>This page displays Farmers registered in your Firebase authentication system.</p>
                
                <h6 class="text-info mt-4 mb-3">Sync Functionality</h6>
                <p>Click the "Sync from Firebase" button to fetch the latest farmers data from Firebase.</p>
                <p class="small text-muted">Note: This may take a few moments depending on how many farmers you have.</p>
                
                <h6 class="text-info mt-4 mb-3">Farmer Status</h6>
                <p><span class="badge bg-success bg-opacity-10 text-success rounded-pill">Verified</span> - Email address has been confirmed</p>
                <p><span class="badge bg-warning bg-opacity-10 text-warning rounded-pill">Unverified</span> - Email address not confirmed</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Initialize tooltips
    $(function () {
        $('[data-bs-toggle="tooltip"]').tooltip();
    });

    // Search functionality
    $(document).ready(function() {
        $("#searchInput").on("keyup", function() {
            const value = $(this).val().toLowerCase();
            $("#usersTable tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
@endpush

@endsection
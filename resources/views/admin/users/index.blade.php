@extends('layouts.mainAdmin')

@section('title', 'Users Management - Admin Dashboard')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            <i class="bi bi-people me-2"></i>Users Management
        </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <small class="text-muted">Total: {{ $users->total() }} users</small>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">All Users</h6>
                    <div class="d-flex gap-2">
                        <input type="text" class="form-control form-control-sm" placeholder="Search users..."
                            id="searchUsers">
                        <button class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if ($users->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Avatar</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Gender</th>
                                        <th>Joined</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}
                                            </td>
                                            <td>
                                                @if ($user->avatar)
                                                    <img src="{{ asset('storage/' . $user->avatar) }}"
                                                        alt="{{ $user->name }}" class="rounded-circle" width="40"
                                                        height="40">
                                                @else
                                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                                        style="width: 40px; height: 40px;">
                                                        <i class="bi bi-person text-white"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="fw-bold">{{ $user->name }}</div>
                                                @if ($user->address)
                                                    <small class="text-muted">{{ Str::limit($user->address, 30) }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark">{{ $user->username }}</span>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone ?? '-' }}</td>
                                            <td>
                                                @if ($user->gender)
                                                    <span
                                                        class="badge {{ $user->gender == 'M' ? 'bg-primary' : 'bg-pink' }}">
                                                        {{ $user->gender == 'M' ? 'Male' : 'Female' }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <small class="text-muted">{{ $user->created_at->format('M d, Y') }}</small>
                                            </td>
                                            <td>
                                                <span class="badge bg-success">Active</span>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-sm btn-outline-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#userModal{{ $user->id }}">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-outline-info">
                                                        <i class="bi bi-envelope"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- User Detail Modal -->
                                        <div class="modal fade" id="userModal{{ $user->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">
                                                            <i class="bi bi-person-circle me-2"></i>{{ $user->name }}
                                                        </h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-4 text-center">
                                                                @if ($user->avatar)
                                                                    <img src="{{ asset('storage/' . $user->avatar) }}"
                                                                        alt="{{ $user->name }}"
                                                                        class="rounded-circle mb-3" width="120"
                                                                        height="120">
                                                                @else
                                                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                                                                        style="width: 120px; height: 120px;">
                                                                        <i class="bi bi-person text-white"
                                                                            style="font-size: 3rem;"></i>
                                                                    </div>
                                                                @endif
                                                                <h5>{{ $user->name }}</h5>
                                                                <p class="text-muted">{{ $user->username }}</p>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <table class="table table-borderless">
                                                                    <tr>
                                                                        <td><strong>Email:</strong></td>
                                                                        <td>{{ $user->email }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Phone:</strong></td>
                                                                        <td>{{ $user->phone ?? 'Not provided' }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Gender:</strong></td>
                                                                        <td>{{ $user->gender == 'M' ? 'Male' : ($user->gender == 'F' ? 'Female' : 'Not specified') }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Date of Birth:</strong></td>
                                                                        <td>{{ $user->dob ? $user->dob->format('M d, Y') : 'Not provided' }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Address:</strong></td>
                                                                        <td>{{ $user->address ?? 'Not provided' }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Joined:</strong></td>
                                                                        <td>{{ $user->created_at->format('M d, Y H:i') }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Total Orders:</strong></td>
                                                                        <td>{{ $user->orders()->count() }}</td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $users->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-people text-muted mb-3" style="font-size: 4rem;"></i>
                            <h5 class="text-muted">No Users Found</h5>
                            <p class="text-muted">No users have registered yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .bg-pink {
                background-color: #e91e63 !important;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.getElementById('searchUsers').addEventListener('keyup', function() {
                // Simple client-side search (you can enhance this with server-side search)
                const searchTerm = this.value.toLowerCase();
                const tableRows = document.querySelectorAll('tbody tr');

                tableRows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchTerm) ? '' : 'none';
                });
            });
        </script>
    @endpush
@endsection

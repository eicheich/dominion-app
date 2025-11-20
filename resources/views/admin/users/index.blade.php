@extends('layouts.mainAdmin')

@section('title', 'Users Management - Admin Dashboard')

@section('content')
    <!-- Page Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4 mb-0">
            <i class="bi bi-people me-2"></i>Users Management
        </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary">
                <i class="bi bi-person-plus me-1"></i>Add User
            </a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-light py-2">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h6 class="mb-0">
                                <i class="bi bi-table me-2"></i>All Users
                                <span class="badge bg-primary ms-2">{{ $users->total() }} total</span>
                            </h6>
                        </div>
                        <div class="col-md-6">
                            <div class="row g-2">
                                <div class="col">
                                    <input type="text" class="form-control form-control-sm" placeholder="Search..."
                                        id="searchUsers">
                                </div>
                                <div class="col-auto">
                                    <select class="form-select form-select-sm" id="genderFilter" style="width: 100px;">
                                        <option value="">All</option>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if ($users->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 5%;">#</th>
                                        <th style="width: 8%;">Avatar</th>
                                        <th style="width: 15%;">Name</th>
                                        <th style="width: 12%;">Email</th>
                                        <th style="width: 10%;">Phone</th>
                                        <th style="width: 8%;">Gender</th>
                                        <th style="width: 12%;">Joined</th>
                                        <th style="width: 30%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="usersTableBody">
                                    @foreach ($users as $user)
                                        <tr class="user-row" data-name="{{ strtolower($user->name) }}"
                                            data-username="{{ strtolower($user->username) }}"
                                            data-email="{{ strtolower($user->email) }}"
                                            data-gender="{{ $user->gender ?? '' }}">
                                            <td class="small">
                                                {{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}
                                            </td>
                                            <td>
                                                @if ($user->avatar)
                                                    <img src="{{ asset('storage/' . $user->avatar) }}"
                                                        alt="{{ $user->name }}" class="rounded-circle" width="32"
                                                        height="32">
                                                @else
                                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                                        style="width: 32px; height: 32px;">
                                                        <i class="bi bi-person text-white" style="font-size: 0.75rem;"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="fw-bold small">{{ $user->name }}</div>
                                                <small class="text-muted">{{ $user->username }}</small>
                                            </td>
                                            <td class="small">{{ $user->email }}</td>
                                            <td class="small">{{ $user->phone ?? '-' }}</td>
                                            <td>
                                                @if ($user->gender)
                                                    <span
                                                        class="badge badge-sm {{ $user->gender == 'M' ? 'bg-primary' : 'bg-danger' }}"
                                                        style="font-size: 0.65rem;">
                                                        {{ $user->gender == 'M' ? 'M' : 'F' }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td class="small text-muted">{{ $user->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin.users.show', $user->id) }}"
                                                    class="btn btn-xs btn-outline-primary" title="View">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                    class="btn btn-xs btn-outline-warning" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                                    class="d-inline" onsubmit="return confirm('Delete this user?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-xs btn-outline-danger"
                                                        title="Delete">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Empty State for Filtered Results -->
                        <div id="emptyState" class="text-center py-5" style="display: none;">
                            <div class="mb-3">
                                <i class="bi bi-search display-1 text-muted"></i>
                            </div>
                            <h5 class="text-muted">No Users Found</h5>
                            <p class="text-muted">Try adjusting your search or filter criteria.</p>
                            <button type="button" class="btn btn-outline-primary" onclick="clearFilters()">
                                <i class="bi bi-arrow-clockwise me-1"></i>Clear Filters
                            </button>
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

    <script>
        // Enhanced Search and Filter Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchUsers');
            const genderFilter = document.getElementById('genderFilter');
            const usersTableBody = document.getElementById('usersTableBody');
            const usersCount = document.getElementById('usersCount');

            function filterUsers() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedGender = genderFilter.value;
                const userRows = document.querySelectorAll('.user-row');
                const emptyState = document.getElementById('emptyState');
                const tableContainer = document.querySelector('.table-responsive');

                let visibleCount = 0;

                userRows.forEach(row => {
                    const name = row.dataset.name || '';
                    const username = row.dataset.username || '';
                    const email = row.dataset.email || '';
                    const gender = row.dataset.gender || '';

                    let showRow = true;

                    // Search filter
                    if (searchTerm && !name.includes(searchTerm) && !username.includes(searchTerm) && !email
                        .includes(searchTerm)) {
                        showRow = false;
                    }

                    // Gender filter
                    if (selectedGender && gender !== selectedGender) {
                        showRow = false;
                    }

                    if (showRow) {
                        row.style.display = 'table-row';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                // Update count
                usersCount.textContent = `${visibleCount} users`;

                // Show/hide empty state
                if (visibleCount === 0 && (searchTerm || selectedGender)) {
                    tableContainer.style.display = 'none';
                    emptyState.style.display = 'block';
                } else {
                    tableContainer.style.display = 'block';
                    emptyState.style.display = 'none';
                }
            }

            // Event listeners
            searchInput.addEventListener('input', filterUsers);
            genderFilter.addEventListener('change', filterUsers);

            // Clear filters function
            window.clearFilters = function() {
                searchInput.value = '';
                genderFilter.value = '';
                filterUsers();
            };

            // Refresh page function
            window.refreshPage = function() {
                location.reload();
            };
        });
    </script>

    @push('styles')
        <style>
            /* Statistics Cards */
            .border-left-primary {
                border-left: 0.25rem solid #4e73df !important;
            }

            .border-left-success {
                border-left: 0.25rem solid #1cc88a !important;
            }

            .border-left-warning {
                border-left: 0.25rem solid #f6c23e !important;
            }

            .border-left-info {
                border-left: 0.25rem solid #36b9cc !important;
            }

            .text-xs {
                font-size: 0.7rem;
            }

            .font-weight-bold {
                font-weight: 700 !important;
            }

            .text-gray-800 {
                color: #5a5c69 !important;
            }

            /* Extra small button */
            .btn-xs {
                padding: 0.2rem 0.4rem;
                font-size: 0.75rem;
            }

            /* Compact badge */
            .badge-sm {
                padding: 0.25rem 0.4rem;
                font-size: 0.65rem;
            }

            /* Table Enhancements */
            .table {
                font-size: 0.9rem;
                margin-bottom: 0;
            }

            .table th {
                border-top: none;
                font-weight: 600;
                font-size: 0.8rem;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                background-color: #f8f9fa !important;
                padding: 0.5rem 0.75rem;
            }

            .table td {
                vertical-align: middle;
                border-top: 1px solid #e3e6f0;
                padding: 0.5rem 0.75rem;
            }

            .table-hover tbody tr:hover {
                background-color: rgba(0, 123, 255, 0.03);
            }

            /* Card Enhancements */
            .card {
                box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
                border: 1px solid #e3e6f0;
            }

            .card-header {
                border-bottom: 1px solid #e3e6f0;
            }

            /* Form Controls */
            .form-control,
            .form-select {
                border: 1px solid #d1d3e2;
                border-radius: 0.35rem;
                font-size: 0.9rem;
            }

            .form-control:focus,
            .form-select:focus {
                border-color: #bac8f3;
                box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
            }

            /* Badge Enhancements */
            .badge {
                font-size: 0.7rem;
                padding: 0.35em 0.65em;
            }

            .small {
                font-size: 0.85rem;
            }
        </style>
    @endpush
@endsection

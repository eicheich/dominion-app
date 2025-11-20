@extends('layouts.mainAdmin')

@section('title', 'User Details - Admin Dashboard')

@section('content')
    <!-- Page Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
        <div>
            <h1 class="h2 mb-0">
                <i class="bi bi-person me-2 text-primary"></i>User Details
            </h1>
            <p class="text-muted mb-0">{{ $user->name }}'s profile information</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i>Back to Users
                </a>
                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">
                    <i class="bi bi-pencil me-1"></i>Edit User
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- User Profile Card -->
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="bi bi-person-circle me-2"></i>Profile
                    </h5>
                </div>
                <div class="card-body text-center">
                    <!-- Avatar -->
                    <div class="mb-3">
                        @if ($user->avatar && file_exists(public_path('storage/' . $user->avatar)))
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}"
                                class="rounded-circle border border-3 border-primary"
                                style="width: 120px; height: 120px; object-fit: cover;">
                        @else
                            <div class="bg-primary rounded-circle mx-auto d-flex align-items-center justify-content-center border border-3 border-light"
                                style="width: 120px; height: 120px;">
                                <i class="bi bi-person text-white fs-1"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Basic Info -->
                    <h4 class="mb-1">{{ $user->name }}</h4>
                    <p class="text-muted mb-2">{{ '@' . $user->username }}</p>

                    <!-- Status Badge -->
                    <span class="badge bg-success mb-3">
                        <i class="bi bi-check-circle me-1"></i>Active
                    </span>

                    <!-- Quick Stats -->
                    <div class="row text-center mt-3">
                        <div class="col-6">
                            <div class="fw-bold text-primary fs-4">{{ $user->orders->count() }}</div>
                            <small class="text-muted">Total Orders</small>
                        </div>
                        <div class="col-6">
                            <div class="fw-bold text-success fs-4">Rp
                                ${{ number_format($user->orders->sum('total')) }}</div>
                            <small class="text-muted">Total Spent</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Information -->
        <div class="col-md-8">
            <!-- Personal Information -->
            <div class="card shadow mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="bi bi-info-circle me-2"></i>Personal Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-bold">Full Name:</td>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Username:</td>
                                    <td>{{ $user->username }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Email:</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Phone:</td>
                                    <td>{{ $user->phone ?? 'Not provided' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-bold">Gender:</td>
                                    <td>
                                        @if ($user->gender)
                                            <span class="badge {{ $user->gender == 'M' ? 'bg-primary' : 'bg-pink' }}">
                                                {{ $user->gender == 'M' ? 'Male' : 'Female' }}
                                            </span>
                                        @else
                                            <span class="text-muted">Not specified</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Joined:</td>
                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Last Updated:</td>
                                    <td>{{ $user->updated_at->format('M d, Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Member For:</td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if ($user->address)
                        <div class="mt-3">
                            <h6 class="fw-bold">Address:</h6>
                            <p class="text-muted">{{ $user->address }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Order History -->
            <div class="card shadow">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-cart me-2"></i>Order History
                        <span class="badge bg-primary ms-2">{{ $user->orders->count() }} orders</span>
                    </h5>
                </div>
                <div class="card-body">
                    @if ($user->orders->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Order #</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->orders->take(10) as $order)
                                        <tr>
                                            <td>
                                                <span
                                                    class="fw-bold text-primary">#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if ($order->product->image && file_exists(public_path('storage/images/products/' . $order->product->image)))
                                                        <img src="{{ asset('storage/images/products/' . $order->product->image) }}"
                                                            alt="{{ $order->product->name }}" class="rounded me-2"
                                                            style="width: 30px; height: 30px; object-fit: cover;">
                                                    @endif
                                                    <div>
                                                        <div class="fw-medium">{{ $order->product->name }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $order->quantity }}</td>
                                            <td>
                                                @switch($order->status)
                                                    @case('pending')
                                                        <span class="badge bg-warning">Pending</span>
                                                    @break

                                                    @case('processing')
                                                        <span class="badge bg-info">Processing</span>
                                                    @break

                                                    @case('shipped')
                                                        <span class="badge bg-primary">Shipped</span>
                                                    @break

                                                    @case('completed')
                                                        <span class="badge bg-success">Completed</span>
                                                    @break

                                                    @case('cancelled')
                                                        <span class="badge bg-danger">Cancelled</span>
                                                    @break

                                                    @default
                                                        <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                                @endswitch
                                            </td>
                                            <td class="fw-bold text-success">Rp
                                                ${{ number_format($order->total) }}</td>
                                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <a href="{{ route('orders.show', $order->id) }}"
                                                    class="btn btn-sm btn-outline-info" title="View Order">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if ($user->orders->count() > 10)
                            <div class="text-center mt-3">
                                <p class="text-muted">Showing latest 10 orders out of {{ $user->orders->count() }} total
                                    orders.</p>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-cart-x text-muted mb-3" style="font-size: 3rem;"></i>
                            <h6 class="text-muted">No Orders Yet</h6>
                            <p class="text-muted">This user hasn't placed any orders yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .bg-pink {
            background-color: #e91e63 !important;
        }

        .card {
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            border: 1px solid #e3e6f0;
        }

        .card-header {
            border-bottom: 1px solid #e3e6f0;
            background-color: #f8f9fa !important;
        }

        .table th {
            border-top: none;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .table td {
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.05);
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
        }
    </style>
@endpush

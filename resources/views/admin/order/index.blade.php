@extends('layouts.mainAdmin')

@section('title', 'Orders Management - Dominion Sports Store')

@section('content')
    <!-- Page Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4 mb-0">
            <i class="bi bi-cart-check me-2"></i>Orders Management
        </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-outline-primary" onclick="refreshPage()">
                <i class="bi bi-arrow-clockwise me-1"></i>Refresh
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Orders</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                {{ \App\Models\Order::count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-cart text-primary fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Completed</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                {{ \App\Models\Order::where('status', 'completed')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-check-circle text-success fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                {{ \App\Models\Order::where('status', 'pending')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-clock text-warning fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Revenue</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                ${{ number_format(\App\Models\Order::sum('total')) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-currency-dollar text-info fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="card mb-3">
        <div class="card-body">
            <div class="row g-2">
                <div class="col-md-6">
                    <input type="text" class="form-control form-control-sm" id="searchOrders"
                        placeholder="Search orders...">
                </div>
                <div class="col-md-3">
                    <select class="form-select form-select-sm" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="shipped">Shipped</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-sm btn-outline-secondary w-100" onclick="clearFilters()">
                        <i class="bi bi-x-circle me-1"></i>Clear
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="card">
        <div class="card-header bg-light py-2">
            <h6 class="mb-0">
                <i class="bi bi-table me-2"></i>Orders
                <span class="badge bg-primary ms-2">{{ $orders->count() }} total</span>
            </h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive" id="ordersTable">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 15%;">Order Number</th>
                            <th style="width: 15%;">Customer</th>
                            <th style="width: 15%;">Product</th>
                            <th style="width: 10%;">Qty</th>
                            <th style="width: 10%;">Total</th>
                            <th style="width: 12%;">Status</th>
                            <th style="width: 18%;">Actions</th>
                        </tr>
                    </thead>
                    <th class="px-4 py-3">Total</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Actions</th>
                    </tr>
                    </thead>
                    <tbody id="ordersTableBody">
                        @foreach ($orders as $order)
                            <tr class="order-row" data-customer="{{ strtolower($order->user->name) }}"
                                data-product="{{ strtolower($order->product->name) }}" data-status="{{ $order->status }}"
                                data-total="{{ $order->total }}" data-date="{{ $order->created_at->format('Y-m-d') }}">
                                <td class="px-4 py-3">
                                    <span
                                        class="fw-bold text-primary">#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        @if ($order->product->image && file_exists(public_path('storage/images/products/' . $order->product->image)))
                                            <img src="{{ asset('storage/images/products/' . $order->product->image) }}"
                                                alt="{{ $order->product->name }}" class="rounded me-3"
                                                style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center"
                                                style="width: 50px; height: 50px;">
                                                <i class="bi bi-image text-muted"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="fw-medium">{{ $order->product->name }}</div>
                                            <small
                                                class="text-muted">{{ $order->product->category->name ?? 'No Category' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary rounded-circle me-2 d-flex align-items-center justify-content-center"
                                            style="width: 32px; height: 32px;">
                                            <span
                                                class="text-white small fw-bold">{{ substr($order->user->name, 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <div class="fw-medium">{{ $order->user->name }}</div>
                                            <small class="text-muted">{{ $order->user->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="badge bg-light text-dark fs-6">{{ $order->quantity }} items</span>
                                </td>
                                <td class="px-4 py-3">
                                    @switch($order->status)
                                        @case('pending')
                                            <span class="badge bg-warning">
                                                <i class="bi bi-clock me-1"></i>Pending
                                            </span>
                                        @break

                                        @case('processing')
                                            <span class="badge bg-info">
                                                <i class="bi bi-gear me-1"></i>Processing
                                            </span>
                                        @break

                                        @case('shipped')
                                            <span class="badge bg-primary">
                                                <i class="bi bi-truck me-1"></i>Shipped
                                            </span>
                                        @break

                                        @case('completed')
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle me-1"></i>Completed
                                            </span>
                                        @break

                                        @case('cancelled')
                                            <span class="badge bg-danger">
                                                <i class="bi bi-x-circle me-1"></i>Cancelled
                                            </span>
                                        @break

                                        @default
                                            <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                    @endswitch
                                </td>
                                <td class="px-4 py-3">
                                    <div class="fw-bold text-success">${{ number_format($order->total) }}
                                    </div>
                                    <small class="text-muted">@ Rp
                                        {{ number_format($order->total / $order->quantity, 0, ',', '.') }} each</small>
                                </td>
                                <td class="px-4 py-3">
                                    <div>{{ $order->created_at->format('M d, Y') }}</div>
                                    <small class="text-muted">{{ $order->created_at->format('H:i') }}</small>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('orders.show', $order->id) }}"
                                            class="btn btn-sm btn-outline-info" title="View Details">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        @if ($order->status !== 'completed' && $order->status !== 'cancelled')
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-primary dropdown-toggle"
                                                    type="button" data-bs-toggle="dropdown" title="Update Status">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="updateStatus({{ $order->id }}, 'processing')">
                                                            <i class="bi bi-gear me-2"></i>Mark as Processing
                                                        </a></li>
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="updateStatus({{ $order->id }}, 'shipped')">
                                                            <i class="bi bi-truck me-2"></i>Mark as Shipped
                                                        </a></li>
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="updateStatus({{ $order->id }}, 'completed')">
                                                            <i class="bi bi-check-circle me-2"></i>Mark as Completed
                                                        </a></li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li><a class="dropdown-item text-danger" href="#"
                                                            onclick="updateStatus({{ $order->id }}, 'cancelled')">
                                                            <i class="bi bi-x-circle me-2"></i>Cancel Order
                                                        </a></li>
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Empty State -->
    <div id="emptyState" class="text-center py-5" style="display: none;">
        <div class="mb-3">
            <i class="bi bi-search display-1 text-muted"></i>
        </div>
        <h5 class="text-muted">No Orders Found</h5>
        <p class="text-muted">Try adjusting your search or filter criteria.</p>
        <button type="button" class="btn btn-outline-primary" onclick="clearFilters()">
            <i class="bi bi-arrow-clockwise me-1"></i>Clear Filters
        </button>
    </div>
    <script>
        // Search and Filter Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchOrders');
            const statusFilter = document.getElementById('statusFilter');
            const sortOrder = document.getElementById('sortOrder');
            const ordersTableBody = document.getElementById('ordersTableBody');
            const ordersCount = document.getElementById('ordersCount');
            const emptyState = document.getElementById('emptyState');
            const ordersTable = document.getElementById('ordersTable');

            function filterOrders() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedStatus = statusFilter.value;
                const orderRows = document.querySelectorAll('.order-row');

                let visibleCount = 0;
                let visibleRows = [];

                orderRows.forEach(row => {
                    const customer = row.dataset.customer || '';
                    const product = row.dataset.product || '';
                    const status = row.dataset.status || '';

                    let showRow = true;

                    // Search filter
                    if (searchTerm && !customer.includes(searchTerm) && !product.includes(searchTerm)) {
                        showRow = false;
                    }

                    // Status filter
                    if (selectedStatus && status !== selectedStatus) {
                        showRow = false;
                    }

                    if (showRow) {
                        visibleRows.push(row);
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                // Sort visible rows
                const sortValue = sortOrder.value;
                visibleRows.sort((a, b) => {
                    switch (sortValue) {
                        case 'oldest':
                            return new Date(a.dataset.date) - new Date(b.dataset.date);
                        case 'amount-high':
                            return parseInt(b.dataset.total) - parseInt(a.dataset.total);
                        case 'amount-low':
                            return parseInt(a.dataset.total) - parseInt(b.dataset.total);
                        default: // newest
                            return new Date(b.dataset.date) - new Date(a.dataset.date);
                    }
                });

                // Hide all rows first
                orderRows.forEach(row => row.style.display = 'none');

                // Show and reorder visible rows
                visibleRows.forEach(row => {
                    row.style.display = 'table-row';
                });

                // Update count
                ordersCount.textContent = `${visibleCount} orders`;

                // Show/hide empty state
                if (visibleCount === 0) {
                    ordersTable.parentElement.style.display = 'none';
                    emptyState.style.display = 'block';
                } else {
                    ordersTable.parentElement.style.display = 'block';
                    emptyState.style.display = 'none';
                }
            }

            // Event listeners
            searchInput.addEventListener('input', filterOrders);
            statusFilter.addEventListener('change', filterOrders);
            sortOrder.addEventListener('change', filterOrders);

            // Clear filters function (global scope)
            window.clearFilters = function() {
                searchInput.value = '';
                statusFilter.value = '';
                sortOrder.value = 'newest';
                filterOrders();
            };

            // Refresh page function
            window.refreshPage = function() {
                location.reload();
            };

            // Update status function
            window.updateStatus = function(orderId, newStatus) {
                if (confirm(`Are you sure you want to update this order status to "${newStatus}"?`)) {
                    // Here you would typically send an AJAX request to update the status
                    // For now, we'll just show an alert
                    alert(
                        `Order #${orderId} status updated to "${newStatus}". Page will refresh to show changes.`
                    );
                    // location.reload(); // Uncomment when you implement the backend update
                }
            };
        });
    </script>
@endsection

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

        /* Table Styles */
        .table th {
            border-top: none;
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table td {
            vertical-align: middle;
            border-top: 1px solid #e3e6f0;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.05);
        }

        /* Card Enhancements */
        .card {
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            border: 1px solid #e3e6f0;
        }

        .card-header {
            border-bottom: 1px solid #e3e6f0;
        }

        /* Button Enhancements */
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        .dropdown-menu {
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            border: 1px solid #e3e6f0;
        }

        /* Animation */
        .card:hover {
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }

        /* Status Badge Styling */
        .badge {
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
        }

        /* Search and Filter Card */
        .form-label {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .form-control,
        .form-select {
            border: 1px solid #d1d3e2;
            border-radius: 0.35rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #bac8f3;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }
    </style>
@endpush

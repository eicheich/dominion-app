@extends('layouts.mainAdmin')

@section('title', 'Deliveries Management - Admin Dashboard')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4 mb-0">
            <i class="bi bi-truck me-2"></i>Deliveries Management
        </h1>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Payment Confirmed</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                {{ $deliveries->filter(function ($d) {return $d->order->status == 'payment confirmed';})->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-credit-card text-info fs-2"></i>
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
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Shipped</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                {{ $deliveries->filter(function ($d) {return $d->order->status == 'shipped';})->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-box-seam text-warning fs-2"></i>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Delivered</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                {{ $deliveries->filter(function ($d) {return $d->order->status == 'delivered';})->count() }}
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
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Orders</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">{{ $deliveries->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-clipboard-data text-primary fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Deliveries Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-2 d-flex justify-content-between align-items-center">
            <h6 class="m-0">
                <i class="bi bi-list-ul me-2"></i>All Deliveries
                <span class="badge bg-primary ms-2">{{ $deliveries->count() }} total</span>
            </h6>
            <div class="d-flex gap-2">
                <select class="form-select form-select-sm" id="statusFilter" style="width: 150px;">
                    <option value="">All Status</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="shipped">Shipped</option>
                    <option value="delivered">Delivered</option>
                </select>
                <input type="text" class="form-control form-control-sm" placeholder="Search..." style="width: 180px;"
                    id="searchDeliveries">
            </div>
        </div>
        <div class="card-body">
            @if ($deliveries->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 12%;">Order #</th>
                                <th style="width: 15%;">Customer</th>
                                <th style="width: 18%;">Product</th>
                                <th style="width: 10%;">Total</th>
                                <th style="width: 12%;">Date</th>
                                <th style="width: 12%;">Status</th>
                                <th style="width: 16%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deliveries as $index => $delivery)
                                <tr>
                                    <td class="small">{{ $index + 1 }}</td>
                                    <td class="small">
                                        <span class="badge bg-primary">#{{ $delivery->order->order_number }}</span>
                                    </td>
                                    <td class="small">
                                        <div class="fw-bold">{{ $delivery->order->user->name }}</div>
                                        <small class="text-muted">{{ $delivery->order->user->email }}</small>
                                    </td>
                                    <td class="small">
                                        <div class="fw-bold">{{ $delivery->order->product->name }}</div>
                                        <small class="text-muted">Qty: {{ $delivery->order->quantity }}</small>
                                    </td>
                                    <td class="small text-success fw-bold">${{ number_format($delivery->order->total) }}
                                    </td>
                                    <td class="small text-muted">{{ $delivery->order->created_at->format('M d, Y') }}</td>
                                    <td>
                                        @if ($delivery->order->status == 'confirmed')
                                            <span class="badge bg-warning">Confirmed</span>
                                        @elseif ($delivery->order->status == 'shipped')
                                            <span class="badge bg-info">Shipped</span>
                                        @elseif ($delivery->order->status == 'delivered')
                                            <span class="badge bg-success">Delivered</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($delivery->order->status) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 align-items-center flex-wrap">
                                            <!-- Status Action -->
                                            @if ($delivery->order->status == 'payment confirmed')
                                                <form action="{{ route('delivery.update.status', $delivery->id) }}"
                                                    method="POST" class="d-inline m-0"
                                                    onsubmit="return confirm('Mark this order as shipped?');">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" name="status" value="shipped">
                                                    <button type="submit"
                                                        class="btn btn-sm btn-warning d-flex align-items-center"
                                                        title="Mark as Shipped" style="white-space: nowrap;">
                                                        <i class="bi bi-box-seam"></i>
                                                        <span class="d-none d-lg-inline ms-1">Ship</span>
                                                    </button>
                                                </form>
                                            @elseif ($delivery->order->status == 'shipped')
                                                <form action="{{ route('delivery.update.status', $delivery->id) }}"
                                                    method="POST" class="d-inline m-0"
                                                    onsubmit="return confirm('Mark this order as delivered?');">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" name="status" value="delivered">
                                                    <button type="submit"
                                                        class="btn btn-sm btn-success d-flex align-items-center"
                                                        title="Mark as Delivered" style="white-space: nowrap;">
                                                        <i class="bi bi-check-circle"></i>
                                                        <span class="d-none d-lg-inline ms-1">Deliver</span>
                                                    </button>
                                                </form>
                                            @else
                                                <button type="button"
                                                    class="btn btn-sm btn-secondary d-flex align-items-center" disabled
                                                    style="white-space: nowrap;">
                                                    <i class="bi bi-check-all"></i>
                                                    <span class="d-none d-lg-inline ms-1">
                                                        @if ($delivery->order->status == 'delivered')
                                                            Done
                                                        @else
                                                            {{ ucfirst($delivery->order->status) }}
                                                        @endif
                                                    </span>
                                                </button>
                                            @endif

                                            <!-- View Button -->
                                            <a href="{{ route('admin.deliveries.show', $delivery->id) }}"
                                                class="btn btn-sm btn-outline-primary d-flex align-items-center"
                                                title="View Details" style="white-space: nowrap;">
                                                <i class="bi bi-eye"></i>
                                                <span class="d-none d-lg-inline ms-1">View</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="bi bi-inbox display-1 text-muted"></i>
                    </div>
                    <h5 class="text-muted">No Deliveries Found</h5>
                    <p class="text-muted">There are no delivery records to display.</p>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .border-left-primary {
            border-left: 0.25rem solid #4e73df !important;
        }

        .border-left-success {
            border-left: 0.25rem solid #1cc88a !important;
        }

        .border-left-info {
            border-left: 0.25rem solid #36b9cc !important;
        }

        .border-left-warning {
            border-left: 0.25rem solid #f6c23e !important;
        }

        .table th {
            border: none;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            color: #6c757d;
        }

        .table td {
            border-top: 1px solid #e3e6f0;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }

        .avatar-sm {
            flex-shrink: 0;
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.35rem 0.5rem;
        }

        .btn {
            transition: all 0.3s ease;
        }

        .btn:hover:not(:disabled) {
            transform: translateY(-1px);
        }

        /* Actions column improvements */
        .table td:last-child {
            min-width: 140px;
        }

        .btn-sm {
            font-size: 0.8rem;
            padding: 0.35rem 0.6rem;
        }

        /* Responsive button text */
        @media (max-width: 992px) {
            .table td:last-child {
                min-width: 100px;
            }

            .btn-sm {
                padding: 0.3rem 0.5rem;
                font-size: 0.75rem;
            }
        }

        @media (max-width: 768px) {
            .table td:last-child {
                min-width: auto;
            }

            .d-flex.gap-2 {
                gap: 0.4rem !important;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Search functionality
        document.getElementById('searchDeliveries').addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const tableRows = document.querySelectorAll('.table tbody tr');

            tableRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });

        // Status filter
        document.getElementById('statusFilter').addEventListener('change', function() {
            const filterValue = this.value.toLowerCase();
            const tableRows = document.querySelectorAll('.table tbody tr');

            tableRows.forEach(row => {
                if (filterValue === '') {
                    row.style.display = '';
                } else {
                    const statusCell = row.querySelector('td:nth-child(7)');
                    const statusText = statusCell.textContent.toLowerCase();
                    row.style.display = statusText.includes(filterValue) ? '' : 'none';
                }
            });
        });
    </script>
@endpush

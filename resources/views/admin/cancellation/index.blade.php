@extends('layouts.mainAdmin')

@section('title', 'Cancellations - Admin Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('layouts.dashboard')

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">
                        <i class="bi bi-x-circle me-2"></i>Order Cancellations
                    </h1>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Order ID</th>
                                <th>User</th>
                                <th>Reason</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cancellations ?? [] as $cancellation)
                                <tr>
                                    <td>{{ $cancellation->id }}</td>
                                    <td>{{ $cancellation->order_id }}</td>
                                    <td>{{ $cancellation->order->user->name ?? 'N/A' }}</td>
                                    <td>{{ $cancellation->reason ?? 'No reason provided' }}</td>
                                    <td>{{ $cancellation->created_at->format('M d, Y H:i') }}</td>
                                    <td>
                                        <span class="badge bg-warning">Cancelled</span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View Details</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="bi bi-inbox display-4"></i>
                                            <p class="mt-2">No cancellations found</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .table th,
        .table td {
            vertical-align: middle;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        .badge {
            font-size: 0.75rem;
        }
    </style>
@endpush

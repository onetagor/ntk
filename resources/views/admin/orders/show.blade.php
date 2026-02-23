@extends('layouts.app')

@section('title', 'Order Details - ' . $order->order_number)

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Order Details</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Orders</a></li>
                    <li class="breadcrumb-item active">{{ $order->order_number }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            {{-- Order Information --}}
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Order Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Order Number:</strong><br>
                                <h4 class="text-primary">{{ $order->order_number }}</h4>
                            </div>
                            <div class="col-md-6 text-end">
                                <strong>Order Date:</strong><br>
                                {{ $order->created_at->format('M d, Y h:i A') }}
                            </div>
                        </div>

                        <hr>

                        {{-- Package Details --}}
                        <h5 class="mb-3">Package Details</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Package</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            @if($order->package)
                                                <strong>{{ $order->package->name }}</strong><br>
                                                @if($order->package->duration)
                                                <small class="text-muted">Duration: {{ $order->package->duration }}</small>
                                                @endif
                                            @else
                                                <span class="text-muted">Package not available</span>
                                            @endif
                                        </td>
                                        <td><strong>${{ number_format($order->package_price, 2) }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        @if($order->service_details)
                        <div class="alert alert-info">
                            <strong>Service Details:</strong><br>
                            {{ $order->service_details }}
                        </div>
                        @endif

                        <hr>

                        {{-- Customer Information --}}
                        <h5 class="mb-3">Customer Information</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Name:</strong> {{ $order->customer_name }}</p>
                                <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                                <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Address:</strong><br>{{ $order->customer_address }}</p>
                                @if($order->city || $order->postal_code)
                                <p>
                                    @if($order->city){{ $order->city }}@endif
                                    @if($order->city && $order->postal_code), @endif
                                    @if($order->postal_code){{ $order->postal_code }}@endif
                                </p>
                                @endif
                            </div>
                        </div>

                        <hr>

                        {{-- Service Schedule --}}
                        <h5 class="mb-3">Service Schedule</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Preferred Date:</strong> 
                                    @if($order->preferred_date)
                                        {{ $order->preferred_date->format('M d, Y') }}
                                    @else
                                        <span class="text-muted">Not specified</span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Preferred Time:</strong> 
                                    @if($order->preferred_time)
                                        {{ $order->preferred_time }}
                                    @else
                                        <span class="text-muted">Not specified</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        @if($order->special_instructions)
                        <div class="alert alert-warning">
                            <strong>Special Instructions:</strong><br>
                            {{ $order->special_instructions }}
                        </div>
                        @endif

                        @if($order->admin_notes)
                        <hr>
                        <h5 class="mb-3">Admin Notes</h5>
                        <div class="alert alert-secondary">
                            {{ $order->admin_notes }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Status and Payment Information --}}
            <div class="col-md-4">
                {{-- Status Card --}}
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Status</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Order Status:</strong><br>
                            <span class="badge badge-lg mt-2 text-white" style="background-color: {{ $order->statusBadge['color'] }}; font-size: 1rem; padding: 0.5rem 1rem;">
                                {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                            </span>
                        </div>

                        <div class="mb-3">
                            <strong>Payment Status:</strong><br>
                            @if($order->payment_status == 'paid')
                                <span class="badge bg-success badge-lg mt-2" style="font-size: 1rem; padding: 0.5rem 1rem;">Paid</span>
                            @elseif($order->payment_status == 'refunded')
                                <span class="badge bg-warning badge-lg mt-2" style="font-size: 1rem; padding: 0.5rem 1rem;">Refunded</span>
                            @else
                                <span class="badge bg-secondary badge-lg mt-2" style="font-size: 1rem; padding: 0.5rem 1rem;">Unpaid</span>
                            @endif
                        </div>

                        @if($order->payment_method)
                        <div class="mb-3">
                            <strong>Payment Method:</strong><br>
                            {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}
                        </div>
                        @endif

                        @if($order->confirmed_at)
                        <div class="mb-3">
                            <strong>Confirmed At:</strong><br>
                            {{ $order->confirmed_at->format('M d, Y h:i A') }}
                        </div>
                        @endif

                        @if($order->completed_at)
                        <div class="mb-3">
                            <strong>Completed At:</strong><br>
                            {{ $order->completed_at->format('M d, Y h:i A') }}
                        </div>
                        @endif

                        <hr>

                        {{-- Quick Status Update --}}
                        <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label for="status" class="form-label"><strong>Update Status:</strong></label>
                                <select name="status" id="status" class="form-select">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="in_progress" {{ $order->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>

                            @if($order->payment_status != 'paid')
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="collect_payment" id="collect_payment" value="1" onchange="togglePaymentMethod()" style="width: 1.25rem; height: 1.25rem; cursor: pointer;">
                                    <label class="form-check-label" for="collect_payment">
                                        <strong>Collect Payment</strong>
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3" id="payment_method_group" style="display: none;">
                                <label for="payment_method_quick" class="form-label">Payment Method</label>
                                <select name="payment_method" id="payment_method_quick" class="form-select">
                                    <option value="cash">Cash</option>
                                    <option value="card">Card</option>
                                    <option value="bank_transfer">Bank Transfer</option>
                                    <option value="online">Online Payment</option>
                                </select>
                            </div>
                            @endif

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-check-circle"></i> Update Status
                            </button>
                        </form>

                        <script>
                        function togglePaymentMethod() {
                            const checkbox = document.getElementById('collect_payment');
                            const paymentGroup = document.getElementById('payment_method_group');
                            paymentGroup.style.display = checkbox.checked ? 'block' : 'none';
                        }
                        </script>
                    </div>
                </div>

                {{-- Actions Card --}}
                <div class="card mt-3">
                    <div class="card-header">
                        <h3 class="card-title">Actions</h3>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-warning w-100 mb-2">
                            <i class="bi bi-pencil"></i> Edit Order
                        </a>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary w-100 mb-2">
                            <i class="bi bi-arrow-left"></i> Back to Orders
                        </a>
                        <form action="{{ route('admin.orders.destroy', $order) }}" 
                              method="POST" 
                              onsubmit="return confirm('Are you sure you want to delete this order?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="bi bi-trash"></i> Delete Order
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

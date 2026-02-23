@extends('layouts.app')

@section('title', 'Edit Order - ' . $order->order_number)

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Order</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Orders</a></li>
                    <li class="breadcrumb-item active">Edit</li>
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

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Order - {{ $order->order_number }}</h3>
            </div>
            <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row">
                        {{-- Left Column --}}
                        <div class="col-md-6">
                            <h5 class="mb-3">Customer Information</h5>
                            
                            <div class="mb-3">
                                <label for="customer_name" class="form-label">Customer Name <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('customer_name') is-invalid @enderror" 
                                       id="customer_name" 
                                       name="customer_name" 
                                       value="{{ old('customer_name', $order->customer_name) }}" 
                                       required>
                                @error('customer_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="customer_email" class="form-label">Customer Email <span class="text-danger">*</span></label>
                                <input type="email" 
                                       class="form-control @error('customer_email') is-invalid @enderror" 
                                       id="customer_email" 
                                       name="customer_email" 
                                       value="{{ old('customer_email', $order->customer_email) }}" 
                                       required>
                                @error('customer_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="customer_phone" class="form-label">Customer Phone <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('customer_phone') is-invalid @enderror" 
                                       id="customer_phone" 
                                       name="customer_phone" 
                                       value="{{ old('customer_phone', $order->customer_phone) }}" 
                                       required>
                                @error('customer_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="customer_address" class="form-label">Service Address <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('customer_address') is-invalid @enderror" 
                                          id="customer_address" 
                                          name="customer_address" 
                                          rows="3" 
                                          required>{{ old('customer_address', $order->customer_address) }}</textarea>
                                @error('customer_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="city" 
                                           name="city" 
                                           value="{{ old('city', $order->city) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="postal_code" class="form-label">Postal Code</label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="postal_code" 
                                           name="postal_code" 
                                           value="{{ old('postal_code', $order->postal_code) }}">
                                </div>
                            </div>

                            <h5 class="mb-3 mt-4">Service Schedule</h5>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="preferred_date" class="form-label">Preferred Date</label>
                                    <input type="date" 
                                           class="form-control" 
                                           id="preferred_date" 
                                           name="preferred_date" 
                                           value="{{ old('preferred_date', $order->preferred_date ? $order->preferred_date->format('Y-m-d') : '') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="preferred_time" class="form-label">Preferred Time</label>
                                    <input type="time" 
                                           class="form-control" 
                                           id="preferred_time" 
                                           name="preferred_time" 
                                           value="{{ old('preferred_time', $order->preferred_time) }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="special_instructions" class="form-label">Special Instructions</label>
                                <textarea class="form-control" 
                                          id="special_instructions" 
                                          name="special_instructions" 
                                          rows="3">{{ old('special_instructions', $order->special_instructions) }}</textarea>
                            </div>
                        </div>

                        {{-- Right Column --}}
                        <div class="col-md-6">
                            <h5 class="mb-3">Order Status & Payment</h5>

                            <div class="mb-3">
                                <label for="status" class="form-label">Order Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" 
                                        id="status" 
                                        name="status" 
                                        required>
                                    <option value="pending" {{ old('status', $order->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ old('status', $order->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="in_progress" {{ old('status', $order->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed" {{ old('status', $order->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ old('status', $order->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="payment_status" class="form-label">Payment Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('payment_status') is-invalid @enderror" 
                                        id="payment_status" 
                                        name="payment_status" 
                                        required>
                                    <option value="unpaid" {{ old('payment_status', $order->payment_status) == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                    <option value="paid" {{ old('payment_status', $order->payment_status) == 'paid' ? 'selected' : '' }}>Paid</option>
                                    <option value="refunded" {{ old('payment_status', $order->payment_status) == 'refunded' ? 'selected' : '' }}>Refunded</option>
                                </select>
                                @error('payment_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if($order->payment_status != 'paid')
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" id="mark_as_paid" onchange="markAsPaid()">
                                    <label class="form-check-label text-success" for="mark_as_paid">
                                        <strong>Mark as Paid (Quick)</strong>
                                    </label>
                                </div>
                                @endif
                            </div>

                            <script>
                            function markAsPaid() {
                                const checkbox = document.getElementById('mark_as_paid');
                                const paymentStatus = document.getElementById('payment_status');
                                const paymentMethod = document.getElementById('payment_method');
                                
                                if (checkbox.checked) {
                                    paymentStatus.value = 'paid';
                                    if (paymentMethod.value === '') {
                                        paymentMethod.value = 'cash';
                                    }
                                }
                            }
                            </script>

                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Payment Method</label>
                                <select class="form-select" id="payment_method" name="payment_method">
                                    <option value="">Not Specified</option>
                                    <option value="cash" {{ old('payment_method', $order->payment_method) == 'cash' ? 'selected' : '' }}>Cash</option>
                                    <option value="card" {{ old('payment_method', $order->payment_method) == 'card' ? 'selected' : '' }}>Card</option>
                                    <option value="bank_transfer" {{ old('payment_method', $order->payment_method) == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                    <option value="online" {{ old('payment_method', $order->payment_method) == 'online' ? 'selected' : '' }}>Online Payment</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="admin_notes" class="form-label">Admin Notes</label>
                                <textarea class="form-control" 
                                          id="admin_notes" 
                                          name="admin_notes" 
                                          rows="6" 
                                          placeholder="Internal notes about this order...">{{ old('admin_notes', $order->admin_notes) }}</textarea>
                                <small class="form-text text-muted">These notes are only visible to admin staff</small>
                            </div>

                            <div class="alert alert-info">
                                <strong>Order Information:</strong><br>
                                <p class="mb-1"><strong>Order Number:</strong> {{ $order->order_number }}</p>
                                <p class="mb-1"><strong>Package:</strong> {{ $order->package ? $order->package->name : 'N/A' }}</p>
                                <p class="mb-1"><strong>Package Price:</strong> ${{ number_format($order->package_price, 2) }}</p>
                                <p class="mb-0"><strong>Order Date:</strong> {{ $order->created_at->format('M d, Y h:i A') }}</p>
                            </div>

                            @if($order->confirmed_at)
                            <div class="alert alert-success">
                                <i class="bi bi-check-circle"></i> <strong>Confirmed At:</strong> {{ $order->confirmed_at->format('M d, Y h:i A') }}
                            </div>
                            @endif

                            @if($order->completed_at)
                            <div class="alert alert-success">
                                <i class="bi bi-check-circle"></i> <strong>Completed At:</strong> {{ $order->completed_at->format('M d, Y h:i A') }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update Order
                    </button>
                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

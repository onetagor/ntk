<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('package')->latest();

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter by payment status
        if ($request->has('payment_status') && $request->payment_status != '') {
            $query->where('payment_status', $request->payment_status);
        }

        // Search by order number, customer name, email, or phone
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%");
            });
        }

        $orders = $query->paginate(20);
        
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('package');
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:50',
            'customer_address' => 'required|string',
            'city' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'preferred_date' => 'nullable|date',
            'preferred_time' => 'nullable|string',
            'special_instructions' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,in_progress,completed,cancelled',
            'payment_status' => 'required|in:unpaid,paid,refunded',
            'payment_method' => 'nullable|string|max:100',
            'admin_notes' => 'nullable|string',
        ]);

        $order->update($validated);

        // Update timestamps based on status
        if ($validated['status'] == 'confirmed' && !$order->confirmed_at) {
            $order->update(['confirmed_at' => now()]);
        }

        if ($validated['status'] == 'completed' && !$order->completed_at) {
            $order->update(['completed_at' => now()]);
        }

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Order updated successfully!');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        
        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully!');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,in_progress,completed,cancelled',
            'collect_payment' => 'nullable|boolean',
            'payment_method' => 'nullable|in:cash,card,bank_transfer,online',
        ]);

        $order->update(['status' => $validated['status']]);

        if ($validated['status'] == 'confirmed' && !$order->confirmed_at) {
            $order->update(['confirmed_at' => now()]);
        }

        if ($validated['status'] == 'completed' && !$order->completed_at) {
            $order->update(['completed_at' => now()]);
        }

        // Handle payment collection
        if ($request->has('collect_payment') && $request->collect_payment) {
            $order->update([
                'payment_status' => 'paid',
                'payment_method' => $validated['payment_method'] ?? 'cash',
            ]);
        }

        $message = 'Order status updated successfully!';
        if ($request->collect_payment) {
            $message = 'Order status and payment updated successfully!';
        }

        return back()->with('success', $message);
    }
}


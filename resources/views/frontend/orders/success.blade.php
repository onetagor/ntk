@extends('frontend.layout.app')

@section('title', 'Order Confirmed')

@section('content')
<section class="py-20 bg-gray-50">
    <div class="max-w-3xl mx-auto px-4">
        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
            {{-- Success Icon --}}
            <div class="mb-6">
                <div class="mx-auto w-20 h-20 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
            </div>

            <h1 class="text-3xl font-bold text-gray-800 mb-4">Order Confirmed!</h1>
            <p class="text-xl text-gray-600 mb-8">Thank you for choosing our services</p>

            {{-- Order Number --}}
            <div class="bg-green-50 border-2 border-green-500 rounded-lg p-6 mb-8">
                <p class="text-gray-600 mb-2">Your Order Number</p>
                <h2 class="text-3xl font-bold text-green-600">{{ $order->order_number }}</h2>
            </div>

            {{-- Order Details --}}
            <div class="text-left bg-gray-50 rounded-lg p-6 mb-8">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Order Details</h3>
                
                <div class="space-y-3">
                    <div class="flex justify-between border-b border-gray-200 pb-2">
                        <span class="text-gray-600">Package:</span>
                        <span class="font-semibold text-gray-800">{{ $order->package->name }}</span>
                    </div>

                    <div class="flex justify-between border-b border-gray-200 pb-2">
                        <span class="text-gray-600">Price:</span>
                        <span class="font-semibold text-gray-800">${{ number_format($order->package_price, 2) }}</span>
                    </div>

                    <div class="flex justify-between border-b border-gray-200 pb-2">
                        <span class="text-gray-600">Customer Name:</span>
                        <span class="font-semibold text-gray-800">{{ $order->customer_name }}</span>
                    </div>

                    <div class="flex justify-between border-b border-gray-200 pb-2">
                        <span class="text-gray-600">Email:</span>
                        <span class="font-semibold text-gray-800">{{ $order->customer_email }}</span>
                    </div>

                    <div class="flex justify-between border-b border-gray-200 pb-2">
                        <span class="text-gray-600">Phone:</span>
                        <span class="font-semibold text-gray-800">{{ $order->customer_phone }}</span>
                    </div>

                    @if($order->preferred_date)
                    <div class="flex justify-between border-b border-gray-200 pb-2">
                        <span class="text-gray-600">Preferred Date:</span>
                        <span class="font-semibold text-gray-800">{{ $order->preferred_date->format('M d, Y') }}</span>
                    </div>
                    @endif

                    @if($order->preferred_time)
                    <div class="flex justify-between border-b border-gray-200 pb-2">
                        <span class="text-gray-600">Preferred Time:</span>
                        <span class="font-semibold text-gray-800">{{ $order->preferred_time }}</span>
                    </div>
                    @endif

                    <div class="flex justify-between border-b border-gray-200 pb-2">
                        <span class="text-gray-600">Status:</span>
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold text-white" style="background-color: {{ $order->statusBadge['color'] }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <div class="flex justify-between border-b border-gray-200 pb-2">
                        <span class="text-gray-600">Payment Status:</span>
                        @if($order->payment_status == 'paid')
                            <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-green-500 text-white">
                                Paid
                            </span>
                        @elseif($order->payment_status == 'refunded')
                            <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-yellow-500 text-white">
                                Refunded
                            </span>
                        @else
                            <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-gray-500 text-white">
                                Unpaid
                            </span>
                        @endif
                    </div>

                    @if($order->payment_method)
                    <div class="flex justify-between">
                        <span class="text-gray-600">Payment Method:</span>
                        <span class="font-semibold text-gray-800">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</span>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Payment Notice --}}
            @if($order->payment_status == 'unpaid')
            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-6 mb-8 text-left">
                <h3 class="text-lg font-bold text-yellow-800 mb-3">
                    ⚠️ Payment Required
                </h3>
                <p class="text-yellow-700 mb-3">
                    Your order has been placed successfully, but payment is still pending. 
                    Please note that your order will be confirmed once payment is received.
                </p>
                <div class="bg-white rounded-lg p-4 text-gray-800">
                    <p class="font-semibold mb-2">Total Amount: <span class="text-2xl text-green-600">${{ number_format($order->package_price, 2) }}</span></p>
                    <p class="text-sm text-gray-600">Our team will contact you shortly regarding payment arrangements.</p>
                </div>
            </div>
            @elseif($order->payment_status == 'paid')
            <div class="bg-green-50 border-l-4 border-green-500 p-6 mb-8 text-left">
                <h3 class="text-lg font-bold text-green-800 mb-3">
                    ✓ Payment Confirmed
                </h3>
                <p class="text-green-700">
                    Thank you! Your payment of <strong>${{ number_format($order->package_price, 2) }}</strong> has been received successfully via 
                    <strong>{{ ucfirst(str_replace('_', ' ', $order->payment_method ?? 'N/A')) }}</strong>.
                </p>
            </div>
            @endif

            {{-- Next Steps --}}
            <div class="bg-blue-50 border-l-4 border-blue-500 p-6 mb-8 text-left">
                <h3 class="text-lg font-bold text-blue-800 mb-3">What happens next?</h3>
                <ul class="space-y-2 text-blue-700">
                    <li class="flex items-start">
                        <span class="mr-2">1.</span>
                        <span>Our team will review your order and contact you within 24 hours</span>
                    </li>
                    @if($order->payment_status == 'unpaid')
                    <li class="flex items-start">
                        <span class="mr-2">2.</span>
                        <span>We'll discuss payment options and process your payment</span>
                    </li>
                    <li class="flex items-start">
                        <span class="mr-2">3.</span>
                        <span>Once payment is confirmed, we'll schedule your service</span>
                    </li>
                    @else
                    <li class="flex items-start">
                        <span class="mr-2">2.</span>
                        <span>We'll confirm your preferred date and time for the service</span>
                    </li>
                    @endif
                    <li class="flex items-start">
                        <span class="mr-2">{{ $order->payment_status == 'unpaid' ? '4' : '3' }}.</span>
                        <span>You'll receive a confirmation email with all the details</span>
                    </li>
                    <li class="flex items-start">
                        <span class="mr-2">{{ $order->payment_status == 'unpaid' ? '5' : '4' }}.</span>
                        <span>Our professional team will arrive at the scheduled time</span>
                    </li>
                </ul>
            </div>

            {{-- Contact Information --}}
            <div class="bg-gray-100 rounded-lg p-6 mb-8 text-left">
                <h3 class="text-lg font-bold text-gray-800 mb-3">Need help?</h3>
                <p class="text-gray-600 mb-3">If you have any questions about your order, please don't hesitate to contact us:</p>
                <div class="space-y-2 text-gray-700">
                    <p><span class="font-semibold">Email:</span> support@ntkcleaningservice.com</p>
                    <p><span class="font-semibold">Phone:</span> +1 (555) 123-4567</p>
                    <p><span class="font-semibold">Order Reference:</span> {{ $order->order_number }}</p>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex gap-4 justify-center">
                <a href="/" 
                   class="bg-green-500 text-white px-8 py-3 rounded-full font-semibold hover:bg-green-600 transition duration-300">
                    Back to Home
                </a>
                <a href="/#packages" 
                   class="bg-gray-200 text-gray-700 px-8 py-3 rounded-full font-semibold hover:bg-gray-300 transition duration-300">
                    View Other Packages
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

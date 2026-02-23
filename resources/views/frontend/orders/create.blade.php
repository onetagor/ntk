@extends('frontend.layout.app')

@section('title', 'Place Order - ' . $package->name)

@section('content')
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Place Your Order</h1>
            
            {{-- Package Details --}}
            <div class="bg-green-50 border-2 border-green-500 rounded-lg p-6 mb-8">
                <h2 class="text-xl font-bold text-green-700 mb-2">Selected Package</h2>
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $package->name }}</h3>
                        @if($package->duration)
                        <p class="text-gray-600">Duration: {{ $package->duration }}</p>
                        @endif
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-bold text-green-600">${{ number_format($package->price, 2) }}</p>
                    </div>
                </div>
                @if($package->features)
                <ul class="mt-4 space-y-2 text-gray-700">
                    @foreach($package->features as $feature)
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        {{ $feature }}
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>

            {{-- Order Form --}}
            <form action="{{ route('order.store') }}" method="POST">
                @csrf
                <input type="hidden" name="package_id" value="{{ $package->id }}">

                <h3 class="text-xl font-bold text-gray-800 mb-4">Customer Information</h3>
                
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="customer_name" class="block text-gray-700 font-semibold mb-2">Full Name *</label>
                        <input type="text" 
                               id="customer_name" 
                               name="customer_name" 
                               value="{{ old('customer_name') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('customer_name') border-red-500 @enderror" 
                               required>
                        @error('customer_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="customer_phone" class="block text-gray-700 font-semibold mb-2">Phone Number *</label>
                        <input type="tel" 
                               id="customer_phone" 
                               name="customer_phone"
                               value="{{ old('customer_phone') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('customer_phone') border-red-500 @enderror" 
                               required>
                        @error('customer_phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label for="customer_email" class="block text-gray-700 font-semibold mb-2">Email Address *</label>
                    <input type="email" 
                           id="customer_email" 
                           name="customer_email"
                           value="{{ old('customer_email') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('customer_email') border-red-500 @enderror" 
                           required>
                    @error('customer_email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="customer_address" class="block text-gray-700 font-semibold mb-2">Service Address *</label>
                    <textarea id="customer_address" 
                              name="customer_address" 
                              rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('customer_address') border-red-500 @enderror" 
                              required>{{ old('customer_address') }}</textarea>
                    @error('customer_address')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="city" class="block text-gray-700 font-semibold mb-2">City</label>
                        <input type="text" 
                               id="city" 
                               name="city"
                               value="{{ old('city') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="postal_code" class="block text-gray-700 font-semibold mb-2">Postal Code</label>
                        <input type="text" 
                               id="postal_code" 
                               name="postal_code"
                               value="{{ old('postal_code') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>
                </div>

                <h3 class="text-xl font-bold text-gray-800 mb-4 mt-8">Service Schedule</h3>

                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="preferred_date" class="block text-gray-700 font-semibold mb-2">Preferred Date</label>
                        <input type="date" 
                               id="preferred_date" 
                               name="preferred_date"
                               value="{{ old('preferred_date') }}"
                               min="{{ date('Y-m-d') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="preferred_time" class="block text-gray-700 font-semibold mb-2">Preferred Time</label>
                        <input type="time" 
                               id="preferred_time" 
                               name="preferred_time"
                               value="{{ old('preferred_time') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>
                </div>

                <div class="mb-6">
                    <label for="special_instructions" class="block text-gray-700 font-semibold mb-2">Special Instructions</label>
                    <textarea id="special_instructions" 
                              name="special_instructions" 
                              rows="4"
                              placeholder="Any special requirements or instructions for our team..."
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">{{ old('special_instructions') }}</textarea>
                </div>

                <div class="flex gap-4">
                    <button type="submit" 
                            class="flex-1 bg-green-500 text-white px-8 py-4 rounded-full font-semibold hover:bg-green-600 transition duration-300 shadow-lg">
                        Confirm Order
                    </button>
                    <a href="/#packages" 
                       class="flex-1 bg-gray-200 text-gray-700 px-8 py-4 rounded-full font-semibold hover:bg-gray-300 transition duration-300 text-center">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

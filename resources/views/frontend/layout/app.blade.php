<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('frontend.layout.meta')
    @include('frontend.layout.css')
    @stack('custome-css')
</head>
<body class="text-gray-700 font-sans">

    {{-- Top Info Bar (Hidden on Mobile) --}}
    <div class="hidden md:block bg-blue-600 text-white text-sm">
        <div class="max-w-7xl mx-auto px-4 py-2 flex justify-between flex-wrap gap-2">
            <span>{{ $siteSetting->working_hours ?? '10:00am - 10:00pm Mon - Sun' }}</span>
            <div class="space-x-4">
                <span>{{ $siteSetting->phone ?? '(406) 555-0550' }}</span>
                <span>{{ $siteSetting->email ?? 'support@ntkpro.com' }}</span>
            </div>
        </div>
    </div>

    {{-- Header include --}}
    @include('frontend.layout.header')
    {{-- End of header include --}}

    {{-- Main Content --}}
    @yield('content')
    {{-- End of main content --}}

    {{-- Footer section --}}
    @include('frontend.layout.footer')
    {{-- End of footer section --}}

    {{-- Scroll to top button --}}
    <button id="scrollToTop" class="fixed bottom-6 right-6 w-12 h-12 bg-green-500 text-white rounded-full shadow-lg hover:bg-green-600 transition duration-300 hidden">
        <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </button>

    {{-- JS Scripts --}}
    @include('frontend.layout.js')
    @stack('custome-js')
</body>
</html>

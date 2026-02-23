{{-- HEADER --}}
<header class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 py-5 flex justify-between items-center">
        {{-- Logo --}}
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/img/ntk-logo.jpg') }}" alt="Cleanifer Logo" class="h-10">
        </a>
        
        {{-- Desktop Navigation --}}
        <nav class="hidden md:flex space-x-6 font-medium uppercase text-sm">
            <a href="#home" class="hover:text-green-500 transition duration-300">Home</a>
            <a href="#about" class="hover:text-green-500 transition duration-300">About</a>
            <a href="#services" class="hover:text-green-500 transition duration-300">Services</a>
            
            <a href="#packages" class="hover:text-green-500 transition duration-300">Gallery</a>
            <a href="#blog" class="hover:text-green-500 transition duration-300">Blog</a>
            
            <a href="#testimonial" class="hover:text-green-500 transition duration-300">Testimonial</a>
            <a href="#newsletter" class="hover:text-green-500 transition duration-300">Contact</a>
        </nav>
        
        {{-- Mobile Menu Button (Optional - Add if needed) --}}
        {{-- <button class="md:hidden">
            <i class="fas fa-bars text-2xl"></i>
        </button> --}}
    </div>
</header>
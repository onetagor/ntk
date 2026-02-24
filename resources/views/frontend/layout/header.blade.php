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
        
        {{-- Mobile Menu Button --}}
        <button id="mobileMenuBtn" class="md:hidden text-gray-700 hover:text-green-500 transition duration-300">
            <i class="fas fa-bars text-2xl"></i>
        </button>
    </div>
    
    {{-- Mobile Navigation Menu --}}
    <nav id="mobileMenu" class="hidden md:hidden bg-white border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 py-4 flex flex-col space-y-4 font-medium uppercase text-sm">
            <a href="#home" class="hover:text-green-500 transition duration-300 py-2">Home</a>
            <a href="#about" class="hover:text-green-500 transition duration-300 py-2">About</a>
            <a href="#services" class="hover:text-green-500 transition duration-300 py-2">Services</a>
            <a href="#packages" class="hover:text-green-500 transition duration-300 py-2">Gallery</a>
            <a href="#blog" class="hover:text-green-500 transition duration-300 py-2">Blog</a>
            <a href="#testimonial" class="hover:text-green-500 transition duration-300 py-2">Testimonial</a>
            <a href="#newsletter" class="hover:text-green-500 transition duration-300 py-2">Contact</a>
        </div>
    </nav>
</header>

{{-- Mobile Menu Toggle Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        
        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
                
                // Toggle icon between bars and times
                const icon = this.querySelector('i');
                if (icon.classList.contains('fa-bars')) {
                    icon.classList.remove('fa-bars');
                    icon.classList.add('fa-times');
                } else {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            });
            
            // Close mobile menu when clicking on a link
            const mobileLinks = mobileMenu.querySelectorAll('a');
            mobileLinks.forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenu.classList.add('hidden');
                    const icon = mobileMenuBtn.querySelector('i');
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                });
            });
        }
    });
</script>
{{-- HEADER --}}
<header class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 py-5 flex justify-between items-center">
        {{-- Logo --}}
        <a href="{{ route('home') }}">
            <img src="{{ $siteSetting && $siteSetting->site_logo ? asset('storage/' . $siteSetting->site_logo) : asset('assets/img/ntk-logo.png') }}" alt="{{ siteSetting('site_name', 'NTK Pro-Services') }}" class="h-20">
        </a>
        
        {{-- Desktop Navigation --}}
        <nav class="hidden md:flex space-x-6 font-medium uppercase text-sm">
            <a href="{{ route('home') }}#home" class="nav-link hover:text-green-500 transition duration-300" data-section="home">Home</a>
            <a href="{{ route('home') }}#about" class="nav-link hover:text-green-500 transition duration-300" data-section="about">About</a>
            <a href="{{ route('home') }}#services" class="nav-link hover:text-green-500 transition duration-300" data-section="services">Services</a>
            <a href="{{ route('home') }}#packages" class="nav-link hover:text-green-500 transition duration-300" data-section="packages">Gallery</a>
            <a href="{{ route('home') }}#blog" class="nav-link hover:text-green-500 transition duration-300" data-section="blog">Blog</a>
            <a href="{{ route('home') }}#testimonial" class="nav-link hover:text-green-500 transition duration-300" data-section="testimonial">Testimonial</a>
            <a href="{{ route('home') }}#newsletter" class="nav-link hover:text-green-500 transition duration-300" data-section="newsletter">Contact</a>
        </nav>
        
        {{-- Mobile Menu Button --}}
        <button id="mobileMenuBtn" class="md:hidden text-gray-700 hover:text-green-500 transition duration-300">
            <i class="fas fa-bars text-2xl"></i>
        </button>
    </div>
    
    {{-- Mobile Navigation Menu --}}
    <nav id="mobileMenu" class="hidden md:hidden bg-white border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 py-4 flex flex-col space-y-4 font-medium uppercase text-sm">
            <a href="{{ route('home') }}#home" class="nav-link hover:text-green-500 transition duration-300 py-2" data-section="home">Home</a>
            <a href="{{ route('home') }}#about" class="nav-link hover:text-green-500 transition duration-300 py-2" data-section="about">About</a>
            <a href="{{ route('home') }}#services" class="nav-link hover:text-green-500 transition duration-300 py-2" data-section="services">Services</a>
            <a href="{{ route('home') }}#packages" class="nav-link hover:text-green-500 transition duration-300 py-2" data-section="packages">Gallery</a>
            <a href="{{ route('home') }}#blog" class="nav-link hover:text-green-500 transition duration-300 py-2" data-section="blog">Blog</a>
            <a href="{{ route('home') }}#testimonial" class="nav-link hover:text-green-500 transition duration-300 py-2" data-section="testimonial">Testimonial</a>
            <a href="{{ route('home') }}#newsletter" class="nav-link hover:text-green-500 transition duration-300 py-2" data-section="newsletter">Contact</a>
        </div>
    </nav>
</header>

<style>
    .nav-link.active {
        color: #22c55e !important;
        font-weight: 600;
        position: relative;
    }
    
    .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        right: 0;
        height: 2px;
        background-color: #22c55e;
    }
    
    @media (max-width: 768px) {
        .nav-link.active::after {
            display: none;
        }
    }
</style>

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

        // Active navigation on scroll
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link');

        function setActiveNav() {
            let currentSection = '';
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                const scrollPosition = window.scrollY + 200; // Offset for better UX
                
                if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                    currentSection = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('data-section') === currentSection) {
                    link.classList.add('active');
                }
            });

            // Set home as active if at top of page
            if (window.scrollY < 100) {
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('data-section') === 'home') {
                        link.classList.add('active');
                    }
                });
            }
        }

        // Call on scroll
        window.addEventListener('scroll', setActiveNav);
        
        // Call on page load
        setActiveNav();

        // Handle hash navigation
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const section = this.getAttribute('data-section');
                const targetSection = document.getElementById(section);
                
                if (targetSection) {
                    e.preventDefault();
                    const offsetTop = targetSection.offsetTop - 100;
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });
    });
</script>
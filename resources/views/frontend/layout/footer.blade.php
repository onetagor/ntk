{{-- NEWSLETTER SECTION --}}
<section id="newsletter" class="py-20 text-center relative" style="background-image: url('{{ asset('assets/img/newsletter_bg.jpg') }}'); background-size: cover; background-position: center;">
    <div class="absolute inset-0 bg-white bg-opacity-90"></div>
    <div class="relative max-w-4xl mx-auto px-4">
        
        <h3 class="text-sm font-semibold text-green-500 mb-2 tracking-widest">OUR NEWSLETTER</h3>
        <div>
            <img src="{{ asset('assets/img/title-bottom.png') }}" alt="Cleanifer Logo" class="mx-auto mb-4">
        </div>
        <div class="flex items-center justify-center mb-8">
            <img src="{{ asset('assets/img/title_left.png') }}" alt="Title Left" class="mr-4">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800">DONT MISS OUR DAILY UPDATE</h1>
        </div>

        <div class="max-w-md mx-auto">
            <form action="{{ route('newsletter.subscribe') }}" method="POST">
                @csrf
                <div class="flex flex-col sm:flex-row gap-4 items-center">
                    <input 
                        type="email" 
                        name="email"
                        placeholder="Your Email Address Here"
                        class="flex-1 px-6 py-4 text-gray-700 border border-gray-300 rounded-full focus:outline-none focus:border-green-500 w-full"
                        required
                    >
                    <button type="submit" class="bg-green-500 text-white px-8 py-4 rounded-full font-semibold hover:bg-green-600 transition duration-300 whitespace-nowrap">
                        Subscribe
                    </button>
                </div>
            </form>
        </div>

    </div>
</section>

{{-- FOOTER --}}
<footer class="pt-12 text-center text-white relative" style="background-image: url('{{ asset('assets/img/footer_bg.jpg') }}'); background-size: cover; background-position: center;">
    <div class="absolute inset-0 bg-opacity-60"></div>
    <div class="relative max-w-4xl mx-auto px-4">
        
        {{-- Logo --}}
        <div class="mb-8">
            <img src="{{ asset('assets/img/ntk-logo.jpg') }}" alt="Cleanifer Logo" class="h-16 mx-auto">
        </div>

        {{-- Navigation Menu --}}
        <div class="mb-8">
            <div class="flex flex-wrap justify-center gap-6 text-sm font-medium tracking-wider">
                <a href="#home" class="hover:text-green-500 transition duration-300">HOME</a>
                <a href="#services" class="hover:text-green-500 transition duration-300">SERVICES</a>
                <a href="#about" class="hover:text-green-500 transition duration-300">ABOUT</a>
                <a href="#blog" class="hover:text-green-500 transition duration-300">BLOG</a>
                <a href="#packages" class="hover:text-green-500 transition duration-300">GALLERY</a>
                <a href="#testimonial" class="hover:text-green-500 transition duration-300">FAQ</a>
                <a href="#newsletter" class="hover:text-green-500 transition duration-300">CONTACT</a>
            </div>
        </div>

        {{-- Look For Us --}}
        <div class="mb-6">
            <p class="text-lg font-medium mb-4">Look For Us</p>
            <div class="flex justify-center space-x-4">
                @if($siteSetting && $siteSetting->facebook_url)
                <a href="{{ $siteSetting->facebook_url }}" target="_blank" class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center hover:bg-green-600 transition duration-300">
                    <i class="fab fa-facebook-f"></i>
                </a>
                @endif
                @if($siteSetting && $siteSetting->linkedin_url)
                <a href="{{ $siteSetting->linkedin_url }}" target="_blank" class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center hover:bg-green-600 transition duration-300">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                @endif
                @if($siteSetting && $siteSetting->youtube_url)
                <a href="{{ $siteSetting->youtube_url }}" target="_blank" class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center hover:bg-green-600 transition duration-300">
                    <i class="fab fa-youtube"></i>
                </a>
                @endif
                @if($siteSetting && $siteSetting->twitter_url)
                <a href="{{ $siteSetting->twitter_url }}" target="_blank" class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center hover:bg-green-600 transition duration-300">
                    <i class="fab fa-twitter"></i>
                </a>
                @endif
            </div>
        </div>
    </div>
    
    {{-- Copyright --}}
    <div class="border-t bg-black bg-opacity-20">
        <div class="text-white max-w-7xl mx-auto px-4 py-4 flex flex-col sm:flex-row justify-between items-center text-sm">
            <p>
                {{ $siteSetting->footer_text ?? 'COPYRIGHT © ' . date('Y') . '. ALL RIGHTS RESERVED O-TECHBD' }}
            </p>
            <div class="flex space-x-4 mt-2 sm:mt-0 text-white">
                <a href="#" class="hover:text-green-500 transition duration-300">Terms & Condition</a>
                <span>|</span>
                <a href="#" class="hover:text-green-500 transition duration-300">Privacy Policy</a>
            </div>
        </div>
    </div>
</footer>
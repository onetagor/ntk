@extends('frontend.layout.app')

@section('title', 'Home - Cleanifer | Professional Cleaning Services')

@section('content')

{{-- HERO SLIDER --}}
<section id="home" class="bg-blue-600 text-white relative" style="background-image: url('{{ asset('assets/img/home_hero_bg.jpg') }}'); background-size: cover; background-position: center;">
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="relative max-w-7xl mx-auto px-4 py-40">
        <div class="slider">
            <div class="slides" id="heroSlides">
                @forelse($sliders as $slider)
                <div class="slide text-center">
                    <h2 class="text-4xl md:text-5xl font-bold mb-6">{{ $slider->title }}</h2>
                    <p class="max-w-3xl mx-auto leading-relaxed">
                        {!! nl2br(e($slider->description)) !!}
                    </p>
                    @if($slider->button_text_1 || $slider->button_text_2)
                    <div class="mt-6 space-x-4">
                        @if($slider->button_text_1)
                        <a href="{{ $slider->button_link_1 ?? '#' }}" class="inline-block bg-white text-blue-600 font-semibold px-6 py-3 rounded-lg hover:bg-gray-100 transition">{{ $slider->button_text_1 }}</a>
                        @endif
                        @if($slider->button_text_2)
                        <a href="{{ $slider->button_link_2 ?? '#' }}" class="inline-block bg-blue-500 text-white font-semibold px-6 py-3 rounded-lg hover:bg-blue-700 transition">{{ $slider->button_text_2 }}</a>
                        @endif
                    </div>
                    @endif
                </div>
                @empty
                <div class="slide text-center">
                    <h2 class="text-4xl md:text-5xl font-bold mb-6">Welcome to Cleanifer</h2>
                    <p class="max-w-3xl mx-auto leading-relaxed">
                        Professional Cleaning Services
                    </p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

{{-- ABOUT US --}}
<section id="about" class="py-20">
    <div class="max-w-7xl mx-auto px-4 text-center mb-12">
        <h3 class="text-sm font-semibold text-green-500 mb-2">ABOUT US</h3>
        <div>
            <img src="{{ asset('assets/img/title-bottom.png') }}" alt="Cleanifer Logo" class="mx-auto mb-4">
        </div>
        <div class="flex items-center justify-center mb-4">
            <img src="{{ asset('assets/img/title_left.png') }}" alt="Title Left" class="mr-4">
            <h1 class="text-3xl font-bold">WE CAN MAKE YOUR PLACE SPARK</h1>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4">
        {{-- Main description --}}
        <div class="text-center leading-relaxed mb-12">
            {{ $siteSetting->about_description ?? 'Cleanifer is more than just a cleaning service. We are a company dedicated to giving our customers back the time they deserve to enjoy the things they love. We put our hard and soul effort into restoring balance to your life by taking care of your home.' }}
        </div>
        
        {{-- Image and Experience/Specials section --}}
        <div class="flex flex-col md:flex-row items-start gap-8">
            <div class="md:w-1/2">
                <img src="{{ asset('assets/img/services_1.jpg') }}" alt="About Us" class="w-full rounded-lg">
            </div>
            <div class="md:w-1/2 space-y-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">More Than 5 Years Of Experience</h2>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Every corner, every inch of your beloved place will be good as new with our expert and experienced house cleaning service. We can cleanse your bathroom, revitalize your kitchen, and renovate your bedroom to make sure your well-deserved clean home. Not only that, we ensure deep cleaning and sanitization to clean off any dust, germs, bacteria. Cleanifer makes your home clean with a healthy outcome.
                    </p>
                </div>

                <div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Our Specials</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-center">
                            <img src="{{ asset('assets/img/specials_icon.png') }}" class="p-2" alt=""> 
                            Weekly, Bi-Weekly And Monthly Cleanings
                        </li>
                        <li class="flex items-center">
                            <img src="{{ asset('assets/img/specials_icon.png') }}" class="p-2" alt=""> 
                            Move-In And Move-Out Cleaning
                        </li>
                        <li class="flex items-center"> 
                            <img src="{{ asset('assets/img/specials_icon.png') }}" class="p-2" alt=""> 
                            Specific Room Cleaning
                        </li>
                        <li class="flex items-center">
                            <img src="{{ asset('assets/img/specials_icon.png') }}" class="p-2" alt=""> 
                            Holiday Cleaning
                        </li>
                        <li class="flex items-center">
                            <img src="{{ asset('assets/img/specials_icon.png') }}" class="p-2" alt=""> 
                            Maid Services
                        </li>
                    </ul>
                    <a href="#services" class="inline-block mt-4 bg-green-500 text-white px-6 py-2 rounded-full hover:bg-green-600 transition duration-300">Read More</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- OUR SERVICES --}}
<section id="services" class="py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h3 class="text-sm font-semibold text-green-500 mb-2 tracking-widest">OUR SERVICES</h3>
        <div>
            <img src="{{ asset('assets/img/title-bottom.png') }}" alt="Cleanifer Logo" class="mx-auto mb-4">
        </div>
        <div class="flex items-center justify-center mb-6">
            <img src="{{ asset('assets/img/title_left.png') }}" alt="Title Left" class="mr-4">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800">WORK THAT PRODUCE FOR OUR CLIENT</h1>
        </div>

        {{-- Service Description --}}
        <div class="max-w-4xl mx-auto text-center leading-relaxed mb-12 text-gray-600">
            <p>Starting from deep cleaning to sanitizing, disinfection, sofa, chair, carpet, vertical blind, inside and outside glass, window, toilet, water tank, reservoir, septic tank</p>
        </div>

        {{-- Services Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto mb-10 items-center">
            @php
                $serviceArray = $services->toArray();
                $serviceCount = count($serviceArray);
            @endphp

            @forelse($services as $index => $service)
                @if($serviceCount > 4 && $index == 1)
                    {{-- Home Cleaning or First Service --}}
                    <div class="text-center p-6">
                        <div class="rounded-lg flex items-center justify-center mx-auto mb-4">
                            @if($service->icon)
                                <img src="{{ Storage::url($service->icon) }}" alt="{{ $service->title }}">
                            @else
                                <img src="{{ asset('assets/img/home_service_1.png') }}" alt="{{ $service->title }}">
                            @endif
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $service->title }}</h3>
                        <p class="text-gray-600">{{ $service->description }}</p>
                    </div>

                    {{-- Central Cleaning Image --}}
                    <div class="text-center md:row-span-2 flex items-center justify-center">
                        <img src="{{ asset('assets/img/home_services_brush.png') }}" alt="Central Cleaning Service" class="object-cover rounded-full">
                    </div>
                @elseif($serviceCount <= 4 && $index == 0)
                    {{-- First Service --}}
                    <div class="text-center p-6">
                        <div class="rounded-lg flex items-center justify-center mx-auto mb-4">
                            @if($service->icon)
                                <img src="{{ Storage::url($service->icon) }}" alt="{{ $service->title }}">
                            @else
                                <img src="{{ asset('assets/img/home_service_' . ($index + 1) . '.png') }}" alt="{{ $service->title }}">
                            @endif
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $service->title }}</h3>
                        <p class="text-gray-600">{{ $service->description }}</p>
                    </div>

                    {{-- Central Cleaning Image - Only show once --}}
                    <div class="text-center md:row-span-2 flex items-center justify-center">
                        <img src="{{ asset('assets/img/home_services_brush.png') }}" alt="Central Cleaning Service" class="object-cover rounded-full">
                    </div>
                @else
                    {{-- Other Services --}}
                    <div class="text-center p-6">
                        <div class="rounded-lg flex items-center justify-center mx-auto mb-4">
                            @if($service->icon)
                                <img src="{{ Storage::url($service->icon) }}" alt="{{ $service->title }}">
                            @else
                                <img src="{{ asset('assets/img/home_service_' . min($index + 1, 4) . '.png') }}" alt="{{ $service->title }}">
                            @endif
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $service->title }}</h3>
                        <p class="text-gray-600">{{ $service->description }}</p>
                    </div>
                @endif
            @empty
                <div class="col-span-3 text-center text-gray-500">No services available</div>
            @endforelse
        </div>

        {{-- View More Button --}}
        <div class="text-center">
            <a href="#packages" class="inline-block bg-green-500 text-white px-8 py-3 rounded-full font-semibold hover:bg-green-600 transition duration-300">View More</a>
        </div>
    </div>
</section>

{{-- BOOKING OFFER --}}
<section class="text-white py-14 text-center relative" style="background-image: url('{{ asset('assets/img/home_offer_bg.jpg') }}'); background-size: cover; background-position: center;">
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="relative">
        <h2 class="text-2xl md:text-3xl font-bold">
            BOOKING A PACKAGE AND GET A 50% OFF ON FIRST ORDER
        </h2>
    </div>
</section>

{{-- OUR PACKAGES --}}
<section id="packages" class="py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h3 class="text-sm font-semibold text-green-500 mb-2 tracking-widest">OUR PACKAGES</h3>
        <div>
            <img src="{{ asset('assets/img/title-bottom.png') }}" alt="Cleanifer Logo" class="mx-auto mb-4">
        </div>
        <div class="flex items-center justify-center mb-6">
            <img src="{{ asset('assets/img/title_left.png') }}" alt="Title Left" class="mr-4">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800">WORK THAT PRODUCE FOR OUR CLIENT</h1>
        </div>

        {{-- Package Description --}}
        <div class="max-w-4xl mx-auto text-center leading-relaxed mb-12 text-gray-600">
            <p>Starting from deep cleaning to sanitizing, disinfection, sofa, chair, carpet, vertical blind, inside and outside glass, window, toilet, water tank, reservoir, septic tank</p>
        </div>

        {{-- Pricing Cards --}}
        <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
            
            @forelse($packages as $package)
            <div class="bg-white border-2 border-gray-200 p-8 text-center rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                <h4 class="text-sm font-semibold text-green-500 mb-2 tracking-widest">{{ strtoupper($package->name) }}</h4>
                <div class="mb-6">
                    @if($package->badge)
                    <p class="text-sm text-gray-600 mb-2">{{ strtoupper($package->badge) }}</p>
                    @endif
                    <p class="text-4xl font-bold text-green-500">${{ number_format($package->price, 0) }}</p>
                </div>
                <ul class="space-y-3 mb-8 text-gray-700">
                    @if(is_array($package->features))
                        @foreach($package->features as $feature)
                            <li>{{ $feature }}</li>
                        @endforeach
                    @endif
                </ul>
                <a href="{{ route('order.create', $package->id) }}" class="block w-full bg-white border-2 border-green-500 text-green-500 px-6 py-3 rounded-full font-semibold hover:bg-green-500 hover:text-white transition duration-300 text-center">Order Now</a>
            </div>
            @empty
            <div class="col-span-3 text-center text-gray-500">No packages available</div>
            @endforelse

        </div>
    </div>
</section>

{{-- STATS --}}
<section class="py-16 relative" style="background-image: url('{{ asset('assets/img/home_counter_bg.jpg') }}'); background-size: cover; background-position: center;">
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="relative max-w-7xl mx-auto px-4 grid md:grid-cols-4 text-center gap-6 text-white">
        @forelse($statistics as $index => $statistic)
        <div class="text-center">
            @if($statistic->icon)
                <img src="{{ Storage::url($statistic->icon) }}" alt="{{ $statistic->title }}" class="mx-auto mb-2 w-12 h-12">
            @else
                <img src="{{ asset('assets/img/counter_icon_' . ($index + 1) . '.png') }}" alt="{{ $statistic->title }}" class="mx-auto mb-2 w-12 h-12">
            @endif
            <h3 class="text-3xl font-bold">{{ $statistic->value }}</h3>
            <p>{{ strtoupper($statistic->title) }}</p>
        </div>
        @empty
        <div class="col-span-4 text-center">No statistics available</div>
        @endforelse
    </div>
</section>

{{-- BLOG --}}
<section id="blog" class="py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h3 class="text-sm font-semibold text-green-500 mb-2 tracking-widest">OUR BLOG</h3>
        <div>
            <img src="{{ asset('assets/img/title-bottom.png') }}" alt="Cleanifer Logo" class="mx-auto mb-4">
        </div>
        <div class="flex items-center justify-center mb-6">
            <img src="{{ asset('assets/img/title_left.png') }}" alt="Title Left" class="mr-4">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800">CLEANIFER UPDATES</h1>
        </div>

        <p class="max-w-4xl mx-auto leading-relaxed mb-12 text-gray-600">
            Cleanifer is more than just a cleaning service. We are a company dedicated to giving our customers back the time they deserve to enjoy the things they love. We put our hard and soul effort into restoring balance to your life by taking care of your home.
        </p>

        <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto mb-10">
            @forelse($blogs as $blog)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                @if($blog->image)
                    <img src="{{ Storage::url($blog->image) }}" alt="{{ $blog->title }}" class="w-full h-48 object-cover">
                @else
                    <img src="{{ asset('assets/img/blog_img_1.jpg') }}" alt="{{ $blog->title }}" class="w-full h-48 object-cover">
                @endif
                <div class="p-6">
                    <p class="text-sm text-gray-500 mb-3">
                        @if($blog->category)
                            <span class="text-green-500 font-semibold">{{ $blog->category }}</span> | 
                        @endif
                        {{ $blog->created_at->format('d M Y') }}
                        @if($blog->author)
                            | by {{ $blog->author }}
                        @endif
                    </p>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">
                        {{ strtoupper($blog->title) }}
                    </h3>
                    <p class="text-gray-600 mb-4">
                        {{ $blog->short_description ?? Str::limit(strip_tags($blog->description), 150) }}
                    </p>
                    <a href="#" class="inline-block bg-green-500 text-white px-6 py-2 rounded-full font-semibold hover:bg-green-600 transition duration-300">Know More</a>
                </div>
            </div>
            @empty
            <div class="col-span-2 text-center text-gray-500">No blog posts available</div>
            @endforelse
        </div>

        {{-- View More Button --}}
        <div class="text-center">
            <a href="#" class="inline-block bg-green-500 text-white px-8 py-3 rounded-full font-semibold hover:bg-green-600 transition duration-300">View More</a>
        </div>
    </div>
</section>

{{-- TESTIMONIAL --}}
<section id="testimonial" class="py-20 text-center text-white relative" style="background-image: url('{{ asset('assets/img/home_testimonial_bg.jpg') }}'); background-size: cover; background-position: center;">
    <div class="absolute inset-0 bg-black bg-opacity-60"></div>
    <div class="relative max-w-4xl mx-auto px-4">
        
        <h3 class="text-sm font-semibold text-green-500 mb-2 tracking-widest">TESTIMONIAL</h3>
        <div>
            <img src="{{ asset('assets/img/title-bottom.png') }}" alt="Cleanifer Logo" class="mx-auto mb-4">
        </div>
        <div class="flex items-center justify-center mb-8">
            <img src="{{ asset('assets/img/title_left.png') }}" alt="Title Left" class="mr-4">
            <h1 class="text-3xl md:text-4xl font-bold">WHAT PEOPLE SAY</h1>
        </div>

        <div class="mb-12">
            <p class="text-lg leading-relaxed max-w-3xl mx-auto">
                Service features tended no do thoughts me on dissuade scarcely own are pretty spring suffer old denote his proposal speedily amr striking am now.
            </p>
        </div>

        {{-- Testimonial Slider --}}
        <div class="testimonial-slider">
            <div class="testimonial-slides" id="testimonialSlides">
                
                @forelse($testimonials as $index => $testimonial)
                <div class="testimonial-slide">
                    @if($testimonial->image)
                        <img src="{{ Storage::url($testimonial->image) }}" alt="{{ $testimonial->name }}" class="w-24 h-24 rounded-full mx-auto mb-6 border-4 border-green-500">
                    @else
                        <img src="{{ asset('assets/img/client_' . (($index % 2) + 2) . '.jpg') }}" alt="{{ $testimonial->name }}" class="w-24 h-24 rounded-full mx-auto mb-6 border-4 border-green-500">
                    @endif
                    <h4 class="text-xl font-bold mb-2">{{ $testimonial->name }}</h4>
                    @if($testimonial->position)
                        <p class="text-sm text-green-400 mb-4">{{ $testimonial->position }}</p>
                    @endif
                    <p class="text-lg leading-relaxed max-w-3xl mx-auto mb-4">
                        {{ $testimonial->comment }}
                    </p>
                </div>
                @empty
                <div class="testimonial-slide">
                    <p class="text-lg">No testimonials available</p>
                </div>
                @endforelse

            </div>
        </div>

        {{-- Navigation dots --}}
        @if($testimonials->count() > 0)
        <div class="flex justify-center space-x-2 mt-8">
            @foreach($testimonials as $index => $testimonial)
                <button class="testimonial-dot {{ $index == 0 ? 'active' : '' }} w-3 h-3 rounded-full {{ $index == 0 ? 'bg-green-500' : 'bg-gray-400' }}" data-slide="{{ $index }}"></button>
            @endforeach
        </div>
        @endif

    </div>
</section>

@endsection

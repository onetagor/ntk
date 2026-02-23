// Custom JavaScript for Cleanifer

document.addEventListener('DOMContentLoaded', function() {
    
    // ========== HERO SLIDER ==========
    const heroSlides = document.getElementById('heroSlides');
    if (heroSlides) {
        let heroIndex = 0;
        const heroTotal = heroSlides.children.length;

        function nextHeroSlide() {
            heroIndex = (heroIndex + 1) % heroTotal;
            heroSlides.style.transform = `translateX(-${heroIndex * 100}%)`;
        }

        // Auto-slide every 5 seconds
        setInterval(nextHeroSlide, 5000);
    }

    // ========== TESTIMONIAL SLIDER ==========
    const testimonialSlides = document.getElementById('testimonialSlides');
    const testimonialDots = document.querySelectorAll('.testimonial-dot');
    
    if (testimonialSlides && testimonialDots.length > 0) {
        let testimonialIndex = 0;
        const testimonialTotal = testimonialSlides.children.length;

        function showTestimonial(slideIndex) {
            testimonialIndex = slideIndex;
            testimonialSlides.style.transform = `translateX(-${testimonialIndex * 100}%)`;
            
            // Update dots
            testimonialDots.forEach((dot, index) => {
                if (index === slideIndex) {
                    dot.classList.add('active');
                    dot.classList.remove('bg-gray-400');
                    dot.classList.add('bg-green-500');
                } else {
                    dot.classList.remove('active');
                    dot.classList.remove('bg-green-500');
                    dot.classList.add('bg-gray-400');
                }
            });
        }

        function nextTestimonial() {
            testimonialIndex = (testimonialIndex + 1) % testimonialTotal;
            showTestimonial(testimonialIndex);
        }

        // Add click events to dots
        testimonialDots.forEach((dot, index) => {
            dot.addEventListener('click', () => showTestimonial(index));
        });

        // Auto-slide testimonials every 6 seconds
        setInterval(nextTestimonial, 6000);
    }

    // ========== SCROLL TO TOP BUTTON ==========
    const scrollToTopBtn = document.getElementById('scrollToTop');
    
    if (scrollToTopBtn) {
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollToTopBtn.classList.remove('hidden');
            } else {
                scrollToTopBtn.classList.add('hidden');
            }
        });
        
        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // ========== SMOOTH SCROLL FOR NAVIGATION LINKS ==========
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // ========== ACTIVE NAVIGATION LINK ON SCROLL ==========
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('header nav a[href^="#"]');

    function activateNavLink() {
        let scrollPosition = window.scrollY + 100;

        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            const sectionId = section.getAttribute('id');

            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                navLinks.forEach(link => {
                    link.classList.remove('text-green-500');
                    if (link.getAttribute('href') === `#${sectionId}`) {
                        link.classList.add('text-green-500');
                    }
                });
            }
        });
    }

    window.addEventListener('scroll', activateNavLink);

    // ========== NEWSLETTER FORM SUBMISSION ==========
    const newsletterForm = document.querySelector('form[action*="newsletter"]');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            // Add any custom form validation or AJAX submission here
            // For now, it will submit normally to the Laravel route
        });
    }

});

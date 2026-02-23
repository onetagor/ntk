<?php

namespace Database\Seeders;

use App\Models\Slider;
use App\Models\Service;
use App\Models\Package;
use App\Models\Statistic;
use App\Models\Blog;
use App\Models\Testimonial;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class CMSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Site Settings
        SiteSetting::create([
            'site_name' => 'Cleanifer',
            'phone' => '(406) 555-0550',
            'email' => 'support@ntkpro.com',
            'working_hours' => '10:00am - 10:00pm Mon - Sun',
            'facebook_url' => '#',
            'twitter_url' => '#',
            'linkedin_url' => '#',
            'youtube_url' => '#',
            'about_description' => 'Cleanifer is more than just a cleaning service. We are a company dedicated to giving our customers back the time they deserve to enjoy the things they love. We put our hard and soul effort into restoring balance to your life by taking care of your home.',
            'footer_text' => 'COPYRIGHT © ' . date('Y') . '. ALL RIGHTS RESERVED O-TECHBD',
        ]);

        // Sliders
        Slider::create([
            'title' => 'WE CAN MAKE YOUR PLACE SPARK',
            'description' => 'Cleanifer is more than just a cleaning service. We are a company dedicated to giving our customers back the time they deserve to enjoy the things they love.',
            'button_text_1' => 'Learn More',
            'button_link_1' => '#about',
            'button_text_2' => 'Contact us',
            'button_link_2' => '#newsletter',
            'order' => 1,
            'status' => 1,
        ]);

        Slider::create([
            'title' => 'CLEAN HOMES, HAPPY LIVES',
            'description' => 'With 5+ years of experience, we bring trust, care, and sparkle to every corner of your home or office.',
            'button_text_1' => 'Learn More',
            'button_link_1' => '#about',
            'button_text_2' => 'Contact us',
            'button_link_2' => '#newsletter',
            'order' => 2,
            'status' => 1,
        ]);

        Slider::create([
            'title' => 'YOUR TIME IS PRECIOUS',
            'description' => 'Let us handle the cleaning while you focus on what truly matters. Book today and get 50% off on your first order!',
            'button_text_1' => 'Learn More',
            'button_link_1' => '#about',
            'button_text_2' => 'Contact us',
            'button_link_2' => '#newsletter',
            'order' => 3,
            'status' => 1,
        ]);

        // Services
        Service::create([
            'title' => 'Home Cleaning',
            'description' => 'Cleanifer grants spotless, clean homes with its residentials cleaning services.',
            'order' => 1,
            'status' => 1,
        ]);

        Service::create([
            'title' => 'One Time Clean',
            'description' => 'Cleanifer makes one-time jobs simple and easy.',
            'order' => 2,
            'status' => 1,
        ]);

        Service::create([
            'title' => 'Office Cleaning',
            'description' => 'Let Cleanifer expert cleaners sparkle your workplace.',
            'order' => 3,
            'status' => 1,
        ]);

        Service::create([
            'title' => 'Move-In/ Move-Out',
            'description' => 'Moving? Let Cleanifer do the cleaning for you!',
            'order' => 4,
            'status' => 1,
        ]);

        // Packages
        Package::create([
            'name' => 'BASIC',
            'price' => 149,
            'features' => [
                'Two Trained Cleaner',
                'Maintenance Cleaning',
                'Liability Insurance',
                'Planned Holiday Cover',
                'Feedback Centre Access'
            ],
            'badge' => 'STARTING',
            'order' => 1,
            'status' => 1,
        ]);

        Package::create([
            'name' => 'STANDARD',
            'price' => 299,
            'features' => [
                'Experienced & Trained Cleaner',
                'Maintenance Cleaning',
                'Insured Liability & Damage',
                'Planned Holiday Cover',
                'You Choose Cleaning Days'
            ],
            'badge' => 'STARTING',
            'order' => 2,
            'status' => 1,
        ]);

        Package::create([
            'name' => 'PREMIUM',
            'price' => 499,
            'features' => [
                'Experienced & Trained Cleaner',
                'Maintenance Cleaning',
                'Insured Liability & Damage',
                'Planned Holiday Cover',
                'You Choose Cleaning Day'
            ],
            'badge' => 'STARTING',
            'order' => 3,
            'status' => 1,
        ]);

        // Statistics
        Statistic::create([
            'title' => 'CUSTOMERS',
            'value' => '500+',
            'order' => 1,
            'status' => 1,
        ]);

        Statistic::create([
            'title' => 'PROJECTS',
            'value' => '1500+',
            'order' => 2,
            'status' => 1,
        ]);

        Statistic::create([
            'title' => 'STAFF',
            'value' => '120+',
            'order' => 3,
            'status' => 1,
        ]);

        Statistic::create([
            'title' => 'GUARANTEE',
            'value' => '100%',
            'order' => 4,
            'status' => 1,
        ]);

        // Blogs
        Blog::create([
            'title' => 'TIPS TO SANITIZE YOUR HOME DURING COVID 19',
            'slug' => 'tips-to-sanitize-your-home-during-covid-19',
            'short_description' => 'After A As Are Doloryu Sit Amet Consectetur Adipisg Elited Hsellus Id Lectus Quisas There Hasellus Id Euismod...',
            'description' => 'After A As Are Doloryu Sit Amet Consectetur Adipisg Elited Hsellus Id Lectus Quisas There Hasellus Id Euismod. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque id lectus quis elit euismod.',
            'category' => 'Cleaning',
            'author' => 'Mathew Parker',
            'status' => 1,
        ]);

        Blog::create([
            'title' => '100 WAY TO SANITIZE YOUR OFFICE DURING COVID 19',
            'slug' => '100-way-to-sanitize-your-office-during-covid-19',
            'short_description' => 'After A As Are Doloryu Sit Amet Consectetur Adipisg Elited Hsellus Id Lectus Quisas There Hasellus Id Euismod...',
            'description' => 'After A As Are Doloryu Sit Amet Consectetur Adipisg Elited Hsellus Id Lectus Quisas There Hasellus Id Euismod. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque id lectus quis elit euismod.',
            'category' => 'Office Cleaning',
            'author' => 'Armain Tom',
            'status' => 1,
        ]);

        // Testimonials
        Testimonial::create([
            'name' => 'Leslie Tunner',
            'position' => 'Customer',
            'comment' => 'we have used cleanifer cleaning services for the past 4 years and found them to be very reliable and efficient and getting themselves available at quick notice and able to fit in with our demands. we suggest cleanifer cleaning services to all our clients.',
            'rating' => 5,
            'order' => 1,
            'status' => 'active',
        ]);

        Testimonial::create([
            'name' => 'John Smith',
            'position' => 'Business Owner',
            'comment' => 'Cleanifer is the best cleaning service in the world. They are very professional and they are very friendly. I would recommend them to anyone who needs quality cleaning services.',
            'rating' => 5,
            'order' => 2,
            'status' => 'active',
        ]);

        Testimonial::create([
            'name' => 'Sarah Johnson',
            'position' => 'Office Manager',
            'comment' => 'Amazing service! Cleanifer has transformed our office environment. Their attention to detail and consistent quality has made them our go-to cleaning service for over 3 years.',
            'rating' => 5,
            'order' => 3,
            'status' => 'active',
        ]);
    }
}

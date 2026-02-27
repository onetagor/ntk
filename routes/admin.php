<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\RoleManagementController;
use App\Http\Controllers\Admin\ContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->group(function () {

     Route::controller(AdminController::class)->group(function () {
                Route::get('login', 'adminLogin')->name('adminLogin');
                Route::get('load/forgetpass', 'loadForgetMyPass')->name('loadForgetMyPass');
                Route::post('find/user', 'findUser')->name('findUser');
                Route::post('validate/login', 'adminValidateLogin')->name('adminValidateLogin');
                Route::post('update/password', 'updatePassword')->name('updatePassword');
                Route::post('validate/otp', 'validateOtp')->name('validateOtp');


        //     Route::post('update/{survey:uuid}', 'update');
        //     Route::get('show/{survey:uuid}', 'show');
        //     Route::get('cheak/status/{survey:uuid}', 'cheakStatus');
         });
         Route::match(['get', 'post'], 'load/otp', [AdminController::class, 'otpLoad'])->name('otpLoad');

    Route::middleware(['auth:admin'])->group(function () {

        Route::controller(AdminController::class)->group(function () {
            Route::get('dashboard', 'dashboard')->name('admin.dashboard');
            Route::get('logout', 'logout')->name('admin.logout');
        });

        // CMS Routes
        // Site Settings
        Route::get('site-settings', [SiteSettingController::class, 'index'])->name('admin.site-settings.index');
        Route::post('site-settings', [SiteSettingController::class, 'update'])->name('admin.site-settings.update');

        // Sliders
        Route::resource('sliders', SliderController::class)->names([
            'index' => 'admin.sliders.index',
            'create' => 'admin.sliders.create',
            'store' => 'admin.sliders.store',
            'edit' => 'admin.sliders.edit',
            'update' => 'admin.sliders.update',
            'destroy' => 'admin.sliders.destroy',
        ]);

        // Services
        Route::resource('services', ServiceController::class)->names([
            'index' => 'admin.services.index',
            'create' => 'admin.services.create',
            'store' => 'admin.services.store',
            'edit' => 'admin.services.edit',
            'update' => 'admin.services.update',
            'destroy' => 'admin.services.destroy',
        ]);

        // Packages
        Route::resource('packages', PackageController::class)->names([
            'index' => 'admin.packages.index',
            'create' => 'admin.packages.create',
            'store' => 'admin.packages.store',
            'edit' => 'admin.packages.edit',
            'update' => 'admin.packages.update',
            'destroy' => 'admin.packages.destroy',
        ]);

        // Statistics
        Route::resource('statistics', StatisticController::class)->names([
            'index' => 'admin.statistics.index',
            'create' => 'admin.statistics.create',
            'store' => 'admin.statistics.store',
            'edit' => 'admin.statistics.edit',
            'update' => 'admin.statistics.update',
            'destroy' => 'admin.statistics.destroy',
        ]);

        // Blogs
        Route::resource('blogs', BlogController::class)->names([
            'index' => 'admin.blogs.index',
            'create' => 'admin.blogs.create',
            'store' => 'admin.blogs.store',
            'edit' => 'admin.blogs.edit',
            'update' => 'admin.blogs.update',
            'destroy' => 'admin.blogs.destroy',
        ]);

        // Testimonials
        Route::resource('testimonials', TestimonialController::class)->names([
            'index' => 'admin.testimonials.index',
            'create' => 'admin.testimonials.create',
            'store' => 'admin.testimonials.store',
            'edit' => 'admin.testimonials.edit',
            'update' => 'admin.testimonials.update',
            'destroy' => 'admin.testimonials.destroy',
        ]);

        // Newsletters
        Route::get('newsletters', [NewsletterController::class, 'index'])->name('admin.newsletters.index');
        Route::delete('newsletters/{newsletter}', [NewsletterController::class, 'destroy'])->name('admin.newsletters.destroy');
        Route::get('newsletters/export', [NewsletterController::class, 'export'])->name('admin.newsletters.export');

        // Contact Messages
        Route::get('contacts', [ContactController::class, 'index'])->name('admin.contacts.index');
        Route::get('contacts/{contact}', [ContactController::class, 'show'])->name('admin.contacts.show');
        Route::post('contacts/{contact}/reply', [ContactController::class, 'reply'])->name('admin.contacts.reply');
        Route::patch('contacts/{contact}/update-status', [ContactController::class, 'updateStatus'])->name('admin.contacts.update-status');
        Route::delete('contacts/{contact}', [ContactController::class, 'destroy'])->name('admin.contacts.destroy');
        Route::get('contacts-export', [ContactController::class, 'export'])->name('admin.contacts.export');

        // Admin Management
        Route::resource('admins', AdminManagementController::class)->except(['show'])->names([
            'index' => 'admin.admins.index',
            'create' => 'admin.admins.create',
            'store' => 'admin.admins.store',
            'edit' => 'admin.admins.edit',
            'update' => 'admin.admins.update',
            'destroy' => 'admin.admins.destroy',
        ]);
        Route::post('admins/{admin}/toggle-status', [AdminManagementController::class, 'toggleStatus'])->name('admin.admins.toggle-status');

        // Role Management
        Route::resource('roles', RoleManagementController::class)->except(['show'])->names([
            'index' => 'admin.roles.index',
            'create' => 'admin.roles.create',
            'store' => 'admin.roles.store',
            'edit' => 'admin.roles.edit',
            'update' => 'admin.roles.update',
            'destroy' => 'admin.roles.destroy',
        ]);

        // Orders Management
        Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class)->names([
            'index' => 'admin.orders.index',
            'show' => 'admin.orders.show',
            'edit' => 'admin.orders.edit',
            'update' => 'admin.orders.update',
            'destroy' => 'admin.orders.destroy',
        ]);
        Route::patch('orders/{order}/update-status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('admin.orders.update-status');

    });

});

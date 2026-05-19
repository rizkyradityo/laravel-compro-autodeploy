<?php

use App\Http\Livewire\Admin\BannerCrud;
use App\Http\Livewire\Admin\ContactMessages;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Admin\Settings as AdminSettings;
use App\Http\Livewire\Admin\DonationManagement;
use App\Http\Livewire\Admin\EventCrud;
use App\Http\Livewire\Admin\MateriCrud;
use App\Http\Livewire\Admin\MediaIndex;
use App\Http\Livewire\Admin\PageCrud;
use App\Http\Livewire\Admin\PortfolioCrud;
use App\Http\Livewire\Admin\PostCrud;
use App\Http\Livewire\Admin\RegistrationManagement;
use App\Http\Livewire\Admin\ServicesCrud;
use App\Http\Livewire\Admin\UsersManagement;
use Illuminate\Support\Facades\Route;

// All admin routes are protected by the 'auth' middleware and prefixed with 'admin'
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('', Dashboard::class)->name('dashboard');

    Route::get('pages', PageCrud::class)->name('pages');
    Route::get('services', ServicesCrud::class)->name('services');
    Route::get('portfolios', PortfolioCrud::class)->name('portfolios');
    Route::get('posts', PostCrud::class)->name('posts');
    Route::get('media', MediaIndex::class)->name('media');
    Route::get('contact-messages', ContactMessages::class)->name('contact-messages');
    Route::get('users', UsersManagement::class)->name('users');

    // New Event Management
    Route::get('events', EventCrud::class)->name('events');
    Route::get('registrations', RegistrationManagement::class)->name('registrations');
    Route::get('donations', DonationManagement::class)->name('donations');
    Route::get('banners', BannerCrud::class)->name('banners');
    Route::get('materi', MateriCrud::class)->name('materi');

    // Settings
    Route::get('settings', AdminSettings::class)->name('settings');
});
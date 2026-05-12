<?php

use App\Http\Livewire\BlogComponent as BlogView;
use App\Http\Livewire\ContactComponent as ContactView;
use App\Http\Livewire\HomeComponent as HomeView;
use App\Http\Livewire\PortfolioComponent as PortfolioView;
use App\Http\Livewire\ServicesComponent as ServicesView;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

Route::get('/', HomeView::class)->name('home');
Route::get('/about', HomeView::class)->name('about');
Route::get('/services', ServicesView::class)->name('services');
Route::get('/portfolio', PortfolioView::class)->name('portfolio');
Route::get('/blog', BlogView::class)->name('blog.index');
Route::get('/blog/{post}', BlogView::class)->where('post', '\\d+')->name('blog.show');
Route::get('/contact', ContactView::class)->name('contact');

// Catch-all slug route (optional)
Route::get('/{slug?}', function (?string $slug = null) {
    if (! $slug) {
        return redirect()->route('home');
    }

    return Livewire::render('pages.show', ['slug' => $slug]);
})->where('slug', '[A-Za-z0-9-]+');
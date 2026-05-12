<?php

use App\Http\Livewire\BlogComponent as BlogView;
use App\Http\Livewire\ContactComponent as ContactView;
use App\Http\Livewire\HomeComponent as HomeView;
use App\Http\Livewire\Login;
use App\Http\Livewire\PortfolioComponent as PortfolioView;
use App\Http\Livewire\ServicesComponent as ServicesView;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeView::class)->name('home');
Route::get('/about', HomeView::class)->name('about');
Route::get('/services', ServicesView::class)->name('services');
Route::get('/portfolio', PortfolioView::class)->name('portfolio');
Route::get('/blog', BlogView::class)->name('blog.index');
Route::get('/blog/{post}', BlogView::class)->where('post', '\\d+')->name('blog.show');
Route::get('/contact', ContactView::class)->name('contact');

Route::get('/login', Login::class)->name('login')->middleware('guest');

Route::post('/logout', function () {
    auth()->logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/');
})->name('logout')->middleware('auth');
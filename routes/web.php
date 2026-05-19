<?php

use App\Http\Livewire\BlogComponent as BlogView;
use App\Http\Livewire\ContactComponent as ContactView;
use App\Http\Livewire\DonationForm;
use App\Http\Livewire\EventLanding;
use App\Http\Livewire\EventDashboard;
use App\Http\Livewire\EventRegistrationForm;
use App\Http\Livewire\MateriList;
use App\Http\Livewire\PageShow;
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
Route::get('/donasi', DonationForm::class)->name('donation.form');
Route::get('/materi', MateriList::class)->name('materi.list');

Route::get('/events', EventLanding::class)->name('events.landing');
Route::get('/events/dashboard', EventDashboard::class)->name('events.dashboard');
Route::get('/events/register', EventRegistrationForm::class)->name('events.registration');
Route::get('/events/register/{event}', EventRegistrationForm::class)->name('events.registration.event');

Route::get('/{slug}', PageShow::class)->where('slug', 'edukasi|dokumentasi|tentang-kita')->name('page.show');

Route::get('/login', Login::class)->name('login')->middleware('guest');

Route::post('/logout', function () {
    auth()->logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/');
})->name('logout')->middleware('auth');

use App\Http\Livewire\MemberLogin;
use App\Http\Livewire\MemberRegister;
use App\Http\Livewire\MemberDashboard;
use App\Http\Livewire\MemberEditProfile;

Route::prefix('member')->name('member.')->middleware('guest')->group(function () {
    Route::get('/login', MemberLogin::class)->name('login');
    Route::get('/register', MemberRegister::class)->name('register');
});

Route::prefix('member')->name('member.')->middleware('auth')->group(function () {
    Route::get('/dashboard', MemberDashboard::class)->name('dashboard');
    Route::get('/edit-profile', MemberEditProfile::class)->name('edit-profile');
});

Route::post('/member/logout', function () {
    auth()->logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/');
})->name('member.logout')->middleware('auth');
<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\Donation;
use App\Models\User;

class HomeComponent extends Component
{
    public function render()
    {
        try {
            $homePage = \App\Models\Page::where('type', 'home')->first();

            $featuredServices = \App\Models\Service::where('published', true)
                ->orderBy('created_at', 'desc')->take(3)->get();

            $latestPortfolios = \App\Models\Portfolio::where('published', true)
                ->orderBy('created_at', 'desc')->take(6)->get();

            $latestPosts = \App\Models\Post::where('published', true)
                ->orderBy('created_at', 'desc')->take(5)->get();

            $latestEvents = Event::where('published', true)
                ->orderBy('event_date', 'desc')
                ->take(3)
                ->get();

            $totalEvents = Event::where('published', true)->count();
            $totalRegistrations = EventRegistration::count();
            $totalMembers = User::count();
            $totalDonations = Donation::where('payment_status', 'paid')->sum('amount');

            return view('livewire.home', [
                'homePage' => $homePage,
                'featuredServices' => $featuredServices,
                'latestPortfolios' => $latestPortfolios,
                'latestPosts' => $latestPosts,
                'latestEvents' => $latestEvents,
                'totalEvents' => $totalEvents,
                'totalRegistrations' => $totalRegistrations,
                'totalMembers' => $totalMembers,
                'totalDonations' => $totalDonations,
            ]);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to load home page data. Please try again.');

            return view('livewire.home', [
                'homePage' => null,
                'featuredServices' => collect(),
                'latestPortfolios' => collect(),
                'latestPosts' => collect(),
                'latestEvents' => collect(),
                'totalEvents' => 0,
                'totalRegistrations' => 0,
                'totalMembers' => 0,
                'totalDonations' => 0,
            ]);
        }
    }
}

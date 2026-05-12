<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        try {
            // Fetch the 'home' page (type = 'home') if exists
            $homePage = \App\Models\Page::where('type', 'home')->first();
            
            // Fetch featured services (e.g., published and latest 3)
            $featuredServices = \App\Models\Service::where('published', true)
                ->orderBy('created_at', 'desc')->take(3)->get();

            // Fetch latest portfolios (published) – show a few images
            $latestPortfolios = \App\Models\Portfolio::where('published', true)
                ->orderBy('created_at', 'desc')->take(6)->get();

            // Fetch latest blog posts (published) – latest 5
            $latestPosts = \App\Models\Post::where('published', true)
                ->orderBy('created_at', 'desc')->take(5)->get();

            // Return view with data
            return view('livewire.home', [
                'homePage' => $homePage,
                'featuredServices' => $featuredServices,
                'latestPortfolios' => $latestPortfolios,
                'latestPosts' => $latestPosts,
            ]);
        } catch (\Exception $e) {
            // In case of any database error, return default data
            session()->flash('error', 'Failed to load home page data. Please try again.');
            
            return view('livewire.home', [
                'homePage' => null,
                'featuredServices' => [],
                'latestPortfolios' => [],
                'latestPosts' => [],
            ]);
        }
    }
}
?>

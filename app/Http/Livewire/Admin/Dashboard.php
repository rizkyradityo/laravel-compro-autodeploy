<?php

namespace App\Http\Livewire\Admin;

use App\Models\Page;
use App\Models\Portfolio;
use App\Models\Post;
use App\Models\Service;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class Dashboard extends Component
{
    public int $totalPages = 0;
    public int $totalServices = 0;
    public int $totalPortfolios = 0;
    public int $totalPosts = 0;
    public int $totalUsers = 0;

    public function mount(): void
    {
        try {
            $this->totalPages = Page::count();
            $this->totalServices = Service::count();
            $this->totalPortfolios = Portfolio::count();
            $this->totalPosts = Post::count();
            $this->totalUsers = User::count();
        } catch (\Throwable $e) {
            session()->flash('error', 'Failed to load dashboard data. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}


<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PortfolioComponent extends Component
{
    public function render()
    {
        $portfolios = \App\Models\Portfolio::with('media')
            ->where('published', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.portfolio', [
            'portfolios' => $portfolios
        ]);
    }
}
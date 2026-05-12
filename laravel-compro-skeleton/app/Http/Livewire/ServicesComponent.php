<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ServicesComponent extends Component
{
    public function render()
    {
        $services = \App\Models\Service::where('published', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.services', [
            'services' => $services
        ]);
    }
}
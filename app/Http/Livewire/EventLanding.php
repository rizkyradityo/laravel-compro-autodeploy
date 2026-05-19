<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Event;

class EventLanding extends Component
{
    public $events;

    public function mount()
    {
        $this->events = Event::where('published', true)->orderBy('event_date', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.event-landing')
            ->layout('layouts.frontend', ['title' => 'Events']);
    }
}

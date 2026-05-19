<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Event;

class EventDashboard extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $events = Event::withCount('registrations')
            ->orderBy('event_date', 'desc')
            ->paginate(10);

        return view('livewire.event-dashboard', [
            'events' => $events,
        ])->layout('layouts.frontend', ['title' => 'Event Dashboard']);
    }
}

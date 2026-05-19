<?php

namespace App\Http\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\EventRegistration;

#[Layout('layouts.frontend')]
class MemberDashboard extends Component
{
    public function render()
    {
        $user = auth()->user();
        $registrations = EventRegistration::where('email', $user->email)
            ->with('event')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.member-dashboard', [
            'registrations' => $registrations,
        ]);
    }
}

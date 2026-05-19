<?php

namespace App\Http\Livewire\Admin;

use App\Models\EventRegistration;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class RegistrationManagement extends Component
{
    use WithPagination;

    public string $search = '';
    public ?string $filterStatus = null;

    public function confirmPayment(EventRegistration $registration): void
    {
        $registration->update(['payment_status' => 'paid']);
        session()->flash('message', 'Registration payment confirmed as paid.');
    }

    public function render()
    {
        $query = EventRegistration::query()->with('event');

        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%')
                  ->orWhere('order_id', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->filterStatus) {
            $query->where('payment_status', $this->filterStatus);
        }

        return view('livewire.admin.registrations.index', [
            'registrations' => $query->orderByDesc('created_at')->paginate(15),
        ]);
    }
}

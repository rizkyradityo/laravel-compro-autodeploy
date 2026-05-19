<?php

namespace App\Http\Livewire\Admin;

use App\Models\Donation;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class DonationManagement extends Component
{
    use WithPagination;

    public string $search = '';
    public ?string $filterStatus = null;

    public function confirmPayment(Donation $donation): void
    {
        $donation->update(['payment_status' => 'paid']);
        session()->flash('message', 'Donation payment confirmed as paid.');
    }

    public function render()
    {
        $query = Donation::query();

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

        return view('livewire.admin.donations.index', [
            'donations' => $query->orderByDesc('created_at')->paginate(15),
        ]);
    }
}

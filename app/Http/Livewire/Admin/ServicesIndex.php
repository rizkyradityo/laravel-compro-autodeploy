<?php

namespace App\Http\Livewire\Admin;

use App\Models\Service;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class ServicesIndex extends Component
{
    use WithPagination;

    public string $search = '';

    public function render()
    {
        $query = Service::query();

        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('slug', 'like', '%' . $this->search . '%');
            });
        }

        return view('livewire.admin.services.index', [
            'services' => $query->orderByDesc('created_at')->paginate(15),
        ]);
    }
}


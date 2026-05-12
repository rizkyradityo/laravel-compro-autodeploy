<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ContactComponent extends Component
{
    public function render()
    {
        $contactPage = \App\Models\Page::where('type', 'contact')->first();

        return view('livewire.contact', [
            'contactPage' => $contactPage
        ]);
    }
}
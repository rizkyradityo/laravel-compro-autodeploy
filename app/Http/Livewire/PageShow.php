<?php

namespace App\Http\Livewire;

use App\Models\Page;
use Livewire\Component;

class PageShow extends Component
{
    public ?Page $page = null;

    public function mount(string $slug): void
    {
        $this->page = Page::where('slug', $slug)->where('published', true)->first();
    }

    public function render()
    {
        if (!$this->page) {
            return view('livewire.page-show', ['page' => null])
                ->layout('layouts.frontend', ['title' => '404']);
        }

        return view('livewire.page-show', ['page' => $this->page])
            ->layout('layouts.frontend', ['title' => $this->page->title]);
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Materi;

class MateriList extends Component
{
    public $category = '';
    public $materi;
    
    public function mount()
    {
        $query = Materi::where('published', true);
        if ($this->category) {
            $query->where('category', $this->category);
        }
        $this->materi = $query->orderBy('created_at', 'desc')->get();
    }
    
    public function filterByCategory($category)
    {
        $this->category = $category;
        $query = Materi::where('published', true);
        if ($category) {
            $query->where('category', $category);
        }
        $this->materi = $query->orderBy('created_at', 'desc')->get();
    }
    
    public function render()
    {
        $categories = Materi::where('published', true)->select('category')->distinct()->pluck('category')->filter();
        return view('livewire.materi-list', ['categories' => $categories])
            ->layout('layouts.frontend', ['title' => 'Materi']);
    }
}

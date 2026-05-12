<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Page;

class PageIndex extends Component
{
    public $search = '';

    public function render()
    {
        $query = Page::query();
        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%')
                   ->orWhere('slug', 'like', '%' . $this->search . '%');
        }
        $pages = $query->orderBy('created_at', 'desc')->paginate(15);
        return view('livewire.admin.pages.index', ['pages' => $pages]);
    }
}
?>

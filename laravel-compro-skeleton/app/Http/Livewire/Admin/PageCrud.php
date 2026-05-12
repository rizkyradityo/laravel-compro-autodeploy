<?php

namespace App\Http\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Page;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
class PageCrud extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $isModalOpen = false;
    public $page;
    public $title;
    public $slug;
    public $content;
    public $meta_title;
    public $meta_description;
    public $type = 'home'; // default type
    public $published;
    public $media_id;
    public $photo; // file upload

    protected function rules(): array
    {
        $pageId = $this->page?->id;

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'alpha_dash', 'max:255', 'unique:pages,slug,' . $pageId],
            'type' => ['required', 'string', 'in:home,about,contact'],
            'content' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:255'],
            'published' => ['boolean'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function mount()
    {
        $this->page = null;
        $this->published = true;
    }

    public function create()
    {
        $this->reset(['title', 'slug', 'content', 'meta_title', 'meta_description', 'type', 'published', 'photo']);
        $this->page = null;
        $this->published = true;
        $this->type = 'home';
        $this->isModalOpen = true;
    }

    public function refreshing()
    {
        $this->resetErrorMessages();
    }

    public function save()
    {
        $this->validate();
        $page = $this->page ?? new Page();
        $page->fill([
            'title' => $this->title,
            'slug' => $this->slug,
            'type' => $this->type,
            'content' => $this->content,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'published' => $this->published,
        ]);

        // handle photo upload
        if ($this->photo) {
            $path = $this->photo->store('cms', 'public');
            // If the page already had a media relation, replace it
            if ($page->media_id) {
                $existing = \App\Models\Media::find($page->media_id);
                if ($existing) {
                    $existing->delete();
                }
            }
            $media = new \App\Models\Media([
                    'original_name' => $this->photo->getClientOriginalName(),
                    'file_path' => $path,
                    'mime_type' => $this->photo->getMimeType(),
                    'size' => $this->photo->getSize(),
            ]);
            $media->save();
            $page->media_id = $media->id;
        }

        $page->save();
        session()->flash('message', 
            $page->wasNew() ? 'Page created successfully.' : 'Page updated successfully.');
        $this->reset(['title','slug','content','meta_title','meta_description','type','published','photo']);
        $this->isModalOpen = false;
        return;
    }

    public function delete(Page $page)
    {
        $page->delete();
        session()->flash('message', 'Page deleted successfully.');
    }

    // Helper to retrieve the selected page for editing
    public function edit(Page $page)
    {
        $this->page = $page;
        $this->title = $page->title;
        $this->slug = $page->slug;
        $this->content = $page->content;
        $this->meta_title = $page->meta_title;
        $this->meta_description = $page->meta_description;
        $this->type = $page->type;
        $this->published = $page->published;
        $this->photo = null;
        $this->isModalOpen = true;
    }

    public function render()
    {
        $pagesQuery = Page::query();
        if ($this->search) {
            $pagesQuery->where('title', 'like', '%' . $this->search . '%')
                       ->orWhere('slug', 'like', '%' . $this->search . '%');
        }
        $pages = $pagesQuery->orderBy('created_at', 'desc')->paginate(15);
        return view('livewire.admin.pages.index', ['pages' => $pages]);
    }
}


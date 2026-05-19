<?php

namespace App\Http\Livewire\Admin;

use App\Models\Materi;
use App\Models\Media;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class MateriCrud extends Component
{
    use WithPagination;
    use WithFileUploads;

    public string $search = '';
    public bool $isModalOpen = false;

    public ?Materi $materi = null;

    public ?string $title = null;
    public ?string $slug = null;
    public ?string $description = null;
    public ?string $content_type = 'file';
    public ?string $file_url = null;
    public ?string $link_url = null;
    public ?string $category = null;
    public bool $published = true;

    public $file = null;

    protected function rules(): array
    {
        $materiId = $this->materi?->id;

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'alpha_dash', 'max:255', 'unique:materi,slug,' . $materiId],
            'description' => ['nullable', 'string'],
            'content_type' => ['required', 'in:file,link,embed'],
            'file_url' => ['nullable', 'string', 'max:255'],
            'link_url' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'published' => ['boolean'],
            'file' => ['nullable', 'file', 'max:10240'],
        ];
    }

    public function mount(): void
    {
        $this->materi = null;
        $this->published = true;
        $this->content_type = 'file';
    }

    public function save(): void
    {
        $this->validate();

        $materi = $this->materi ?? new Materi();
        $materi->fill([
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'content_type' => $this->content_type,
            'file_url' => $this->file_url,
            'link_url' => $this->link_url,
            'category' => $this->category,
            'published' => $this->published,
        ]);

        if ($this->file) {
            if ($materi->media_id) {
                Media::query()->whereKey($materi->media_id)->delete();
            }

            $path = $this->file->store('cms/materi', 'public');
            $media = new Media([
                'original_name' => $this->file->getClientOriginalName(),
                'file_path' => $path,
                'mime_type' => $this->file->getMimeType(),
                'size' => $this->file->getSize(),
            ]);
            $media->save();
            $materi->media_id = $media->id;
        }

        $isNew = ! $materi->exists;
        $materi->save();

        session()->flash('message', $isNew ? 'Materi created successfully.' : 'Materi updated successfully.');

        $this->resetForm();
    }

    public function delete(Materi $materi): void
    {
        if ($materi->media_id) {
            Media::query()->whereKey($materi->media_id)->delete();
        }
        $materi->delete();
        session()->flash('message', 'Materi deleted successfully.');
    }

    public function edit(Materi $materi): void
    {
        $this->materi = $materi;
        $this->title = $materi->title;
        $this->slug = $materi->slug;
        $this->description = $materi->description;
        $this->content_type = $materi->content_type;
        $this->file_url = $materi->file_url;
        $this->link_url = $materi->link_url;
        $this->category = $materi->category;
        $this->published = (bool) $materi->published;
        $this->file = null;
        $this->isModalOpen = true;
    }

    public function togglePublished(Materi $materi): void
    {
        $materi->update(['published' => ! $materi->published]);
        session()->flash('message', 'Materi status updated.');
    }

    public function resetForm(): void
    {
        $this->reset(['title', 'slug', 'description', 'content_type', 'file_url', 'link_url', 'category', 'published', 'file']);
        $this->isModalOpen = false;
        $this->materi = null;
    }

    public function render()
    {
        $query = Materi::query();

        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('slug', 'like', '%' . $this->search . '%')
                  ->orWhere('category', 'like', '%' . $this->search . '%');
            });
        }

        return view('livewire.admin.materi.crud', [
            'materiList' => $query->orderByDesc('created_at')->paginate(15),
        ]);
    }
}

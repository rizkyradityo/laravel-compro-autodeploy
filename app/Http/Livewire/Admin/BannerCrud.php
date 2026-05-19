<?php

namespace App\Http\Livewire\Admin;

use App\Models\Banner;
use App\Models\Media;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class BannerCrud extends Component
{
    use WithPagination;
    use WithFileUploads;

    public string $search = '';
    public bool $isModalOpen = false;

    public ?Banner $banner = null;

    public ?string $title = null;
    public ?string $subtitle = null;
    public ?string $button_text = null;
    public ?string $button_url = null;
    public ?int $sort_order = 0;
    public bool $published = true;

    public $photo = null;

    protected function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'button_text' => ['nullable', 'string', 'max:100'],
            'button_url' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'published' => ['boolean'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function mount(): void
    {
        $this->banner = null;
        $this->published = true;
        $this->sort_order = 0;
    }

    public function save(): void
    {
        $this->validate();

        $banner = $this->banner ?? new Banner();
        $banner->fill([
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'button_text' => $this->button_text,
            'button_url' => $this->button_url,
            'sort_order' => $this->sort_order ?? 0,
            'published' => $this->published,
        ]);

        if ($this->photo) {
            if ($banner->media_id) {
                Media::query()->whereKey($banner->media_id)->delete();
            }

            $path = $this->photo->store('cms', 'public');
            $media = new Media([
                'original_name' => $this->photo->getClientOriginalName(),
                'file_path' => $path,
                'mime_type' => $this->photo->getMimeType(),
                'size' => $this->photo->getSize(),
            ]);
            $media->save();
            $banner->media_id = $media->id;
        }

        $isNew = ! $banner->exists;
        $banner->save();

        session()->flash('message', $isNew ? 'Banner created successfully.' : 'Banner updated successfully.');

        $this->resetForm();
    }

    public function delete(Banner $banner): void
    {
        if ($banner->media_id) {
            Media::query()->whereKey($banner->media_id)->delete();
        }
        $banner->delete();
        session()->flash('message', 'Banner deleted successfully.');
    }

    public function edit(Banner $banner): void
    {
        $this->banner = $banner;
        $this->title = $banner->title;
        $this->subtitle = $banner->subtitle;
        $this->button_text = $banner->button_text;
        $this->button_url = $banner->button_url;
        $this->sort_order = $banner->sort_order;
        $this->published = (bool) $banner->published;
        $this->photo = null;
        $this->isModalOpen = true;
    }

    public function togglePublished(Banner $banner): void
    {
        $banner->update(['published' => ! $banner->published]);
        session()->flash('message', 'Banner status updated.');
    }

    public function resetForm(): void
    {
        $this->reset(['title', 'subtitle', 'button_text', 'button_url', 'sort_order', 'published', 'photo']);
        $this->isModalOpen = false;
        $this->banner = null;
    }

    public function render()
    {
        $query = Banner::query();

        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('subtitle', 'like', '%' . $this->search . '%');
            });
        }

        return view('livewire.admin.banners.crud', [
            'banners' => $query->orderBy('sort_order')->paginate(15),
        ]);
    }
}

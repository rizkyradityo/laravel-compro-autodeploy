<?php

namespace App\Http\Livewire\Admin;

use App\Models\Media;
use App\Models\Portfolio;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class PortfolioCrud extends Component
{
    use WithPagination;
    use WithFileUploads;

    public string $search = '';
    public bool $isModalOpen = false;

    public ?Portfolio $portfolio = null;

    public ?string $title = null;
    public ?string $slug = null;
    public ?string $description = null;
    public ?string $meta_title = null;
    public ?string $meta_description = null;
    public bool $published = true;

    public $photo = null;

    protected function rules(): array
    {
        $portfolioId = $this->portfolio?->id;

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'alpha_dash', 'max:255', 'unique:portfolios,slug,' . $portfolioId],
            'description' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:255'],
            'published' => ['boolean'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function mount(): void
    {
        $this->portfolio = null;
        $this->published = true;
    }

    public function save(): void
    {
        $this->validate();

        $portfolio = $this->portfolio ?? new Portfolio();
        $portfolio->fill([
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'published' => $this->published,
        ]);

        if ($this->photo) {
            if ($portfolio->media_id) {
                Media::query()->whereKey($portfolio->media_id)->delete();
            }

            $path = $this->photo->store('cms', 'public');
            $media = new Media([
                'original_name' => $this->photo->getClientOriginalName(),
                'file_path' => $path,
                'mime_type' => $this->photo->getMimeType(),
                'size' => $this->photo->getSize(),
            ]);
            $media->save();
            $portfolio->media_id = $media->id;
        }

        $isNew = ! $portfolio->exists;
        $portfolio->save();

        session()->flash('message', $isNew ? 'Portfolio created successfully.' : 'Portfolio updated successfully.');

        $this->resetForm();
    }

    public function delete(Portfolio $portfolio): void
    {
        $portfolio->delete();
        session()->flash('message', 'Portfolio deleted successfully.');
    }

    public function edit(Portfolio $portfolio): void
    {
        $this->portfolio = $portfolio;
        $this->title = $portfolio->title;
        $this->slug = $portfolio->slug;
        $this->description = $portfolio->description;
        $this->meta_title = $portfolio->meta_title;
        $this->meta_description = $portfolio->meta_description;
        $this->published = (bool) $portfolio->published;
        $this->photo = null;
        $this->isModalOpen = true;
    }

    public function toggleModal(): void
    {
        if ($this->isModalOpen) {
            $this->resetForm();
        } else {
            $this->reset(['title', 'slug', 'description', 'meta_title', 'meta_description', 'published', 'photo']);
            $this->portfolio = null;
            $this->published = true;
            $this->isModalOpen = true;
        }
    }

    public function resetForm(): void
    {
        $this->reset(['title', 'slug', 'description', 'meta_title', 'meta_description', 'published', 'photo']);
        $this->isModalOpen = false;
        $this->portfolio = null;
    }

    public function render()
    {
        $query = Portfolio::query();

        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('slug', 'like', '%' . $this->search . '%');
            });
        }

        return view('livewire.admin.portfolios.index', [
            'portfolios' => $query->orderByDesc('created_at')->paginate(15),
        ]);
    }
}


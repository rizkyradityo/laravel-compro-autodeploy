<?php

namespace App\Http\Livewire\Admin;

use App\Models\Media;
use App\Models\Service;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ServicesCrud extends Component
{
    use WithPagination;
    use WithFileUploads;

    public string $search = '';
    public bool $isModalOpen = false;

    public ?Service $service = null;

    public ?string $name = null;
    public ?string $slug = null;
    public ?string $description = null;
    public ?string $meta_title = null;
    public ?string $meta_description = null;
    public bool $published = true;

    public $photo = null;

    protected function rules(): array
    {
        $serviceId = $this->service?->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'alpha_dash', 'max:255', 'unique:services,slug,' . $serviceId],
            'description' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:255'],
            'published' => ['boolean'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function mount(): void
    {
        $this->service = null;
        $this->published = true;
    }

    public function save(): void
    {
        $this->validate();

        $service = $this->service ?? new Service();
        $service->fill([
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'published' => $this->published,
        ]);

        if ($this->photo) {
            if ($service->media_id) {
                Media::query()->whereKey($service->media_id)->delete();
            }

            $path = $this->photo->store('cms', 'public');
            $media = new Media([
                'original_name' => $this->photo->getClientOriginalName(),
                'file_path' => $path,
                'mime_type' => $this->photo->getMimeType(),
                'size' => $this->photo->getSize(),
            ]);
            $media->save();
            $service->media_id = $media->id;
        }

        $isNew = ! $service->exists;
        $service->save();

        session()->flash('message', $isNew ? 'Service created successfully.' : 'Service updated successfully.');

        $this->reset(['name', 'slug', 'description', 'meta_title', 'meta_description', 'published', 'photo']);
        $this->service = null;
        $this->isModalOpen = false;
    }

    public function delete(Service $service): void
    {
        $service->delete();
        session()->flash('message', 'Service deleted successfully.');
    }

    public function edit(Service $service): void
    {
        $this->service = $service;
        $this->name = $service->name;
        $this->slug = $service->slug;
        $this->description = $service->description;
        $this->meta_title = $service->meta_title;
        $this->meta_description = $service->meta_description;
        $this->published = (bool) $service->published;
        $this->photo = null;
        $this->isModalOpen = true;
    }

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


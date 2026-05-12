<?php

namespace App\Http\Livewire\Admin;

use App\Models\Media;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
class MediaIndex extends Component
{
    use WithFileUploads;

    public string $search = '';

    // multiple uploads
    public array $uploads = [];

    protected function rules(): array
    {
        return [
            'uploads.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ];
    }

    public function save(): void
    {
        $validated = $this->validate();

        foreach ($validated['uploads'] ?? [] as $file) {
            $path = $file->store('cms', 'public');

            Media::create([
                'original_name' => $file->getClientOriginalName(),
                'file_path' => $path,
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
            ]);
        }

        session()->flash('message', 'Media uploaded successfully.');
        $this->reset(['uploads']);
    }

    public function delete(Media $media): void
    {
        $media->delete();
        session()->flash('message', 'Media deleted.');
    }

    public function render()
    {
        $media = Media::query()
            ->when($this->search !== '', function ($query) {
                $query->where('original_name', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(15);

        return view('livewire.admin.media.index', ['media' => $media]);
    }
}


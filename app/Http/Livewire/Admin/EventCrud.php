<?php

namespace App\Http\Livewire\Admin;

use App\Models\Event;
use App\Models\Media;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class EventCrud extends Component
{
    use WithPagination;
    use WithFileUploads;

    public string $search = '';
    public ?string $filterStatus = null;
    public bool $isModalOpen = false;

    public ?Event $event = null;

    public ?string $title = null;
    public ?string $slug = null;
    public ?string $content = null;
    public ?string $event_date = null;
    public ?string $event_time = null;
    public ?string $location = null;
    public ?string $price = null;
    public ?int $capacity = null;
    public ?string $registration_status = 'open';
    public bool $published = true;

    public $photo = null;

    protected function rules(): array
    {
        $eventId = $this->event?->id;

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'alpha_dash', 'max:255', 'unique:events,slug,' . $eventId],
            'content' => ['nullable', 'string'],
            'event_date' => ['required', 'date'],
            'event_time' => ['nullable', 'string', 'max:10'],
            'location' => ['nullable', 'string', 'max:255'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'capacity' => ['nullable', 'integer', 'min:0'],
            'registration_status' => ['required', 'in:open,closed,full'],
            'published' => ['boolean'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function mount(): void
    {
        $this->event = null;
        $this->published = true;
        $this->registration_status = 'open';
        $this->capacity = 0;
    }

    public function save(): void
    {
        $this->validate();

        $event = $this->event ?? new Event();
        $event->fill([
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'event_date' => $this->event_date,
            'event_time' => $this->event_time,
            'location' => $this->location,
            'price' => $this->price ?? 0,
            'capacity' => $this->capacity ?? 0,
            'registration_status' => $this->registration_status,
            'published' => $this->published,
        ]);

        if ($this->photo) {
            if ($event->media_id) {
                Media::query()->whereKey($event->media_id)->delete();
            }

            $path = $this->photo->store('cms', 'public');
            $media = new Media([
                'original_name' => $this->photo->getClientOriginalName(),
                'file_path' => $path,
                'mime_type' => $this->photo->getMimeType(),
                'size' => $this->photo->getSize(),
            ]);
            $media->save();
            $event->media_id = $media->id;
        }

        $isNew = ! $event->exists;
        $event->save();

        session()->flash('message', $isNew ? 'Event created successfully.' : 'Event updated successfully.');

        $this->resetForm();
    }

    public function delete(Event $event): void
    {
        if ($event->media_id) {
            Media::query()->whereKey($event->media_id)->delete();
        }
        $event->delete();
        session()->flash('message', 'Event deleted successfully.');
    }

    public function edit(Event $event): void
    {
        $this->event = $event;
        $this->title = $event->title;
        $this->slug = $event->slug;
        $this->content = $event->content;
        $this->event_date = $event->event_date?->format('Y-m-d');
        $this->event_time = $event->event_time;
        $this->location = $event->location;
        $this->price = $event->price;
        $this->capacity = $event->capacity;
        $this->registration_status = $event->registration_status;
        $this->published = (bool) $event->published;
        $this->photo = null;
        $this->isModalOpen = true;
    }

    public function togglePublished(Event $event): void
    {
        $event->update(['published' => ! $event->published]);
        session()->flash('message', 'Event status updated.');
    }

    public function resetForm(): void
    {
        $this->reset(['title', 'slug', 'content', 'event_date', 'event_time', 'location', 'price', 'capacity', 'registration_status', 'published', 'photo']);
        $this->isModalOpen = false;
        $this->event = null;
    }

    public function render()
    {
        $query = Event::query();

        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('slug', 'like', '%' . $this->search . '%')
                  ->orWhere('location', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->filterStatus) {
            $query->where('registration_status', $this->filterStatus);
        }

        return view('livewire.admin.events.crud', [
            'events' => $query->orderByDesc('created_at')->paginate(15),
        ]);
    }
}

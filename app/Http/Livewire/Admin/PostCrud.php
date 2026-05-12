<?php

namespace App\Http\Livewire\Admin;

use App\Models\Media;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class PostCrud extends Component
{
    use WithPagination;
    use WithFileUploads;

    public string $search = '';
    public bool $isModalOpen = false;

    public ?Post $post = null;

    public ?string $title = null;
    public ?string $slug = null;
    public ?string $content = null;
    public ?string $meta_title = null;
    public ?string $meta_description = null;
    public bool $published = true;

    public $photo = null;

    protected function rules(): array
    {
        $postId = $this->post?->id;

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'alpha_dash', 'max:255', 'unique:posts,slug,' . $postId],
            'content' => ['required', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:255'],
            'published' => ['boolean'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function mount(): void
    {
        $this->post = null;
        $this->published = true;
    }

    public function save(): void
    {
        $this->validate();

        $post = $this->post ?? new Post();
        $post->fill([
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'published' => $this->published,
        ]);

        if ($this->photo) {
            if ($post->media_id) {
                Media::query()->whereKey($post->media_id)->delete();
            }

            $path = $this->photo->store('cms', 'public');
            $media = new Media([
                'original_name' => $this->photo->getClientOriginalName(),
                'file_path' => $path,
                'mime_type' => $this->photo->getMimeType(),
                'size' => $this->photo->getSize(),
            ]);
            $media->save();
            $post->media_id = $media->id;
        }

        $isNew = ! $post->exists;
        $post->save();

        session()->flash('message', $isNew ? 'Post created successfully.' : 'Post updated successfully.');

        $this->resetForm();
    }

    public function delete(Post $post): void
    {
        $post->delete();
        session()->flash('message', 'Post deleted successfully.');
    }

    public function edit(Post $post): void
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->slug = $post->slug;
        $this->content = $post->content;
        $this->meta_title = $post->meta_title;
        $this->meta_description = $post->meta_description;
        $this->published = (bool) $post->published;
        $this->photo = null;
        $this->isModalOpen = true;
    }

    public function resetForm(): void
    {
        $this->reset(['title', 'slug', 'content', 'meta_title', 'meta_description', 'published', 'photo']);
        $this->isModalOpen = false;
        $this->post = null;
    }

    public function render()
    {
        $query = Post::query();

        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('slug', 'like', '%' . $this->search . '%');
            });
        }

        return view('livewire.admin.posts.index', [
            'posts' => $query->orderByDesc('created_at')->paginate(15),
        ]);
    }
}


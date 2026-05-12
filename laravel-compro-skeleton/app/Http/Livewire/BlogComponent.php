<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;

class BlogComponent extends Component
{
    public $search = '';
    public $post = null; // For showing a single post
    public $postSlug = null;

    public function mount($slug = null)
    {
        $this->postSlug = $slug;
        if ($slug) {
            try {
                $this->post = \App\Models\Post::with(['user', 'media'])
                    ->where('slug', $slug)
                    ->where('published', true)
                    ->first();
                
                if (!$this->post) {
                    session()->flash('error', 'Post not found.');
                }
            } catch (\Exception $e) {
                session()->flash('error', 'Failed to load post. Please try again.');
            }
        }
    }

    public function render()
    {
        if ($this->post) {
            // Show single post
            try {
                $relatedPosts = \App\Models\Post::with('media')
                    ->where('published', true)
                    ->where('id', '!=', $this->post->id)
                    ->orderBy('created_at', 'desc')
                    ->take(3)
                    ->get();

                return view('livewire.blog.show', [
                    'post' => $this->post,
                    'relatedPosts' => $relatedPosts
                ]);
            } catch (\Exception $e) {
                session()->flash('error', 'Failed to load related posts. Please try again.');
                return view('livewire.blog.show', [
                    'post' => $this->post,
                    'relatedPosts' => []
                ]);
            }
        } else {
            // Show blog index
            try {
                $query = \App\Models\Post::with(['user', 'media'])
                    ->where('published', true);

                if ($this->search) {
                    $query->where(function (Builder $q) {
                        $q->where('title', 'like', '%' . $this->search . '%')
                          ->orWhere('content', 'like', '%' . $this->search . '%');
                    });
                }

            $posts = $query->orderBy('created_at', 'desc')->paginate(10);

                return view('livewire.blog.index', [
                    'posts' => $posts,
                    'search' => $this->search
                ]);
            } catch (\Exception $e) {
                session()->flash('error', 'Failed to load blog posts. Please try again.');
                return view('livewire.blog.index', [
                    'posts' => [],
                    'search' => $this->search
                ]);
            }
        }
    }
}
?>

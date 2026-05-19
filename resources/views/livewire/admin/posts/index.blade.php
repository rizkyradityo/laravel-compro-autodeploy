<div>
    <div class="page-header">
        <h1>Artikel AMR</h1>
        <p>Kelola artikel AMR.</p>
    </div>

    <div class="filter-bar">
        <input type="text" class="form-input" wire:model="search" placeholder="Search articles..." />
        <button wire:click="$set('isModalOpen', true)" class="btn btn--primary">
            <i class="fas fa-plus"></i> New Article
        </button>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Date</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
                <tr>
                    <td><strong>{{ $post->title }}</strong></td>
                    <td style="color:#64748b;font-size:.82rem;">{{ $post->slug }}</td>
                    <td>
                        <span class="badge {{ $post->published ? 'badge--green' : 'badge--gray' }}">
                            {{ $post->published ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                    <td style="color:#64748b;font-size:.82rem;">{{ $post->created_at->format('M d, Y') }}</td>
                    <td style="text-align:right;white-space:nowrap;">
                        <button wire:click="edit({{ $post->id }})" class="btn btn--ghost btn--sm" title="Edit"><i class="fas fa-edit"></i></button>
                        <button wire:click="togglePublished({{ $post->id }})" class="btn btn--ghost btn--sm" title="Toggle Published">
                            <i class="fas {{ $post->published ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                        </button>
                        <button wire:click="delete({{ $post->id }})" class="btn btn--ghost btn--sm" style="color:#ef4444;" onclick="return confirm('Are you sure?')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center;padding:48px;color:#94a3b8;">
                        <i class="fas fa-newspaper" style="font-size:2rem;display:block;margin-bottom:8px;"></i>
                        No articles found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination">
        {{ $posts->links() }}
    </div>

    @if($isModalOpen)
        <div class="modal-overlay" wire:click.self="$set('isModalOpen', false)">
            <div class="modal">
                <div class="modal-header">
                    <h3>{{ $post ? 'Edit Article' : 'New Article' }}</h3>
                    <button class="modal-close" wire:click="resetForm">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="grid" style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div style="grid-column:span 2;">
                            <label class="form-label">Title</label>
                            <input class="form-input" wire:model="title" placeholder="Article title" />
                            @error('title') <span style="color:#ef4444;font-size:.78rem;">{{ $message }}</span> @enderror
                        </div>
                        <div style="grid-column:span 2;">
                            <label class="form-label">Slug</label>
                            <input class="form-input" wire:model="slug" placeholder="article-slug" />
                            @error('slug') <span style="color:#ef4444;font-size:.78rem;">{{ $message }}</span> @enderror
                        </div>
                        <div style="grid-column:span 2;">
                            <label class="form-label">Content</label>
                            <textarea class="form-input" wire:model="content" rows="8" placeholder="Article content..."></textarea>
                            @error('content') <span style="color:#ef4444;font-size:.78rem;">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="form-label">Meta Title</label>
                            <input class="form-input" wire:model="meta_title" placeholder="SEO title" />
                        </div>
                        <div>
                            <label class="form-label">Meta Description</label>
                            <input class="form-input" wire:model="meta_description" placeholder="SEO description" />
                        </div>
                        <div>
                            <label class="form-label" style="display:flex;align-items:center;gap:8px;margin-top:32px;">
                                <input type="checkbox" wire:model="published" style="width:18px;height:18px;" /> Published
                            </label>
                        </div>
                        <div>
                            <label class="form-label">Featured Image</label>
                            <input class="form-input" type="file" wire:model="photo" accept="image/*" />
                            @error('photo') <span style="color:#ef4444;font-size:.78rem;">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn--secondary" wire:click="resetForm">Cancel</button>
                    <button class="btn btn--primary" wire:click="save">
                        <i class="fas fa-save"></i> {{ $post ? 'Update' : 'Create' }}
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>

<div>
    <div class="page-header">
        <h1>Materi AMR</h1>
        <p>Kelola materi edukasi AMR.</p>
    </div>

    <div class="filter-bar">
        <input type="text" class="form-input" wire:model="search" placeholder="Search materi..." />
        <button wire:click="$set('isModalOpen', true)" class="btn btn--primary">
            <i class="fas fa-plus"></i> New Materi
        </button>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Type</th>
                <th>Category</th>
                <th>Status</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($materiList as $item)
                <tr>
                    <td><strong>{{ $item->title }}</strong></td>
                    <td>
                        <span class="badge badge--blue">{{ ucfirst($item->content_type) }}</span>
                    </td>
                    <td style="color:#64748b;">{{ $item->category ?? '—' }}</td>
                    <td>
                        <span class="badge {{ $item->published ? 'badge--green' : 'badge--gray' }}">
                            {{ $item->published ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                    <td style="text-align:right;white-space:nowrap;">
                        <button wire:click="edit({{ $item->id }})" class="btn btn--ghost btn--sm" title="Edit"><i class="fas fa-edit"></i></button>
                        <button wire:click="togglePublished({{ $item->id }})" class="btn btn--ghost btn--sm" title="Toggle Published">
                            <i class="fas {{ $item->published ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                        </button>
                        <button wire:click="delete({{ $item->id }})" class="btn btn--ghost btn--sm" style="color:#ef4444;" onclick="return confirm('Are you sure?')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center;padding:48px;color:#94a3b8;">
                        <i class="fas fa-book" style="font-size:2rem;display:block;margin-bottom:8px;"></i>
                        No materi found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination">
        {{ $materiList->links() }}
    </div>

    @if($isModalOpen)
        <div class="modal-overlay" wire:click.self="$set('isModalOpen', false)">
            <div class="modal">
                <div class="modal-header">
                    <h3>{{ $materi ? 'Edit Materi' : 'New Materi' }}</h3>
                    <button class="modal-close" wire:click="resetForm">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="grid" style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div style="grid-column:span 2;">
                            <label class="form-label">Title</label>
                            <input class="form-input" wire:model="title" placeholder="Materi title" />
                            @error('title') <span style="color:#ef4444;font-size:.78rem;">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="form-label">Slug</label>
                            <input class="form-input" wire:model="slug" placeholder="materi-slug" />
                            @error('slug') <span style="color:#ef4444;font-size:.78rem;">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="form-label">Category</label>
                            <input class="form-input" wire:model="category" placeholder="Category" />
                            @error('category') <span style="color:#ef4444;font-size:.78rem;">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="form-label">Content Type</label>
                            <select class="form-input form-select" wire:model="content_type">
                                <option value="file">File</option>
                                <option value="link">Link</option>
                                <option value="embed">Embed</option>
                            </select>
                            @error('content_type') <span style="color:#ef4444;font-size:.78rem;">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="form-label" style="display:flex;align-items:center;gap:8px;margin-top:32px;">
                                <input type="checkbox" wire:model="published" style="width:18px;height:18px;" /> Published
                            </label>
                        </div>
                        <div>
                            <label class="form-label">File URL</label>
                            <input class="form-input" wire:model="file_url" placeholder="https://..." />
                        </div>
                        <div>
                            <label class="form-label">Link URL</label>
                            <input class="form-input" wire:model="link_url" placeholder="https://..." />
                        </div>
                        <div style="grid-column:span 2;">
                            <label class="form-label">Description</label>
                            <textarea class="form-input" wire:model="description" rows="4" placeholder="Deskripsi materi..."></textarea>
                        </div>
                        <div style="grid-column:span 2;">
                            <label class="form-label">Upload File</label>
                            <input class="form-input" type="file" wire:model="file" />
                            @error('file') <span style="color:#ef4444;font-size:.78rem;">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn--secondary" wire:click="resetForm">Cancel</button>
                    <button class="btn btn--primary" wire:click="save">
                        <i class="fas fa-save"></i> {{ $materi ? 'Update' : 'Create' }}
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>

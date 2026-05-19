<div>
    <div class="page-header">
        <h1>{{ $pageTypeLabel }} Management</h1>
        <p>Kelola halaman {{ strtolower($pageTypeLabel) }}.</p>
    </div>

    <div class="filter-bar">
        <input type="text" class="form-input" wire:model="search" placeholder="Search pages..." />
        <button wire:click="create" class="btn btn--primary">
            <i class="fas fa-plus"></i> New {{ $pageTypeLabel }}
        </button>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Slug</th>
                <th>Type</th>
                <th>Status</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pages as $page)
                <tr>
                    <td><strong>{{ $page->title }}</strong></td>
                    <td style="color:#64748b;">/{{ $page->slug }}</td>
                    <td><span class="badge badge--blue">{{ $page->type }}</span></td>
                    <td>
                        <span class="badge {{ $page->published ? 'badge--green' : 'badge--gray' }}">
                            {{ $page->published ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                    <td style="text-align:right;white-space:nowrap;">
                        <button wire:click="edit({{ $page->id }})" class="btn btn--ghost btn--sm" title="Edit"><i class="fas fa-edit"></i></button>
                        <button wire:click="delete({{ $page->id }})" class="btn btn--ghost btn--sm" style="color:#ef4444;" onclick="return confirm('Are you sure?')" title="Delete"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center;padding:48px;color:#94a3b8;">
                        <i class="fas fa-file" style="font-size:2rem;display:block;margin-bottom:8px;"></i>
                        No pages found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination">
        {{ $pages->links() }}
    </div>

    @if($isModalOpen)
        <div class="modal-overlay" wire:click.self="$set('isModalOpen', false)">
            <div class="modal">
                <div class="modal-header">
                    <h3>{{ $page ? 'Edit' : 'New' }} {{ $pageTypeLabel }}</h3>
                    <button class="modal-close" wire:click="$set('isModalOpen', false)">&times;</button>
                </div>
                <div class="modal-body">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div>
                            <label class="form-label">Title</label>
                            <input class="form-input" wire:model="title" placeholder="Page title" />
                            @error('title') <span style="color:#ef4444;font-size:.78rem;">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="form-label">Slug</label>
                            <input class="form-input" wire:model="slug" placeholder="page-slug" />
                            @error('slug') <span style="color:#ef4444;font-size:.78rem;">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="form-label">Type</label>
                            <select class="form-input form-select" wire:model="type">
                                <option value="home">Home</option>
                                <option value="about">About</option>
                                <option value="contact">Contact</option>
                                <option value="edukasi_page">Edukasi</option>
                                <option value="dokumentasi_page">Dokumentasi</option>
                                <option value="tentang_kita_page">Tentang Kita</option>
                            </select>
                            @error('type') <span style="color:#ef4444;font-size:.78rem;">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="form-label" style="display:flex;align-items:center;gap:8px;margin-top:32px;">
                                <input type="checkbox" wire:model="published" style="width:18px;height:18px;" /> Published
                            </label>
                        </div>
                        <div style="grid-column:span 2;">
                            <label class="form-label">Meta Title</label>
                            <input class="form-input" wire:model="meta_title" placeholder="SEO title" />
                        </div>
                        <div style="grid-column:span 2;">
                            <label class="form-label">Meta Description</label>
                            <textarea class="form-input" wire:model="meta_description" rows="2"></textarea>
                        </div>
                        <div style="grid-column:span 2;">
                            <label class="form-label">Content</label>
                            <textarea class="form-input" wire:model="content" rows="8" placeholder="Page content (HTML)..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn--secondary" wire:click="$set('isModalOpen', false)">Cancel</button>
                    <button class="btn btn--primary" wire:click="save"><i class="fas fa-save"></i> {{ $page ? 'Update' : 'Create' }}</button>
                </div>
            </div>
        </div>
    @endif
</div>

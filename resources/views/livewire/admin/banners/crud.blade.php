<div>
    <div class="page-header">
        <h1>Banners</h1>
        <p>Kelola banner slider.</p>
    </div>

    <div class="filter-bar">
        <input type="text" class="form-input" wire:model="search" placeholder="Search banners..." />
        <button wire:click="$set('isModalOpen', true)" class="btn btn--primary">
            <i class="fas fa-plus"></i> New Banner
        </button>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Subtitle</th>
                <th>Sort Order</th>
                <th>Status</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($banners as $banner)
                <tr>
                    <td><strong>{{ $banner->title }}</strong></td>
                    <td style="color:#64748b;">{{ Str::limit($banner->subtitle, 40) }}</td>
                    <td>
                        <span class="badge badge--gray">{{ $banner->sort_order }}</span>
                    </td>
                    <td>
                        <span class="badge {{ $banner->published ? 'badge--green' : 'badge--gray' }}">
                            {{ $banner->published ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                    <td style="text-align:right;white-space:nowrap;">
                        <button wire:click="edit({{ $banner->id }})" class="btn btn--ghost btn--sm" title="Edit"><i class="fas fa-edit"></i></button>
                        <button wire:click="togglePublished({{ $banner->id }})" class="btn btn--ghost btn--sm" title="Toggle Published">
                            <i class="fas {{ $banner->published ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                        </button>
                        <button wire:click="delete({{ $banner->id }})" class="btn btn--ghost btn--sm" style="color:#ef4444;" onclick="return confirm('Are you sure?')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center;padding:48px;color:#94a3b8;">
                        <i class="fas fa-sliders-h" style="font-size:2rem;display:block;margin-bottom:8px;"></i>
                        No banners found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination">
        {{ $banners->links() }}
    </div>

    @if($isModalOpen)
        <div class="modal-overlay" wire:click.self="$set('isModalOpen', false)">
            <div class="modal">
                <div class="modal-header">
                    <h3>{{ $banner ? 'Edit Banner' : 'New Banner' }}</h3>
                    <button class="modal-close" wire:click="resetForm">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="grid" style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div style="grid-column:span 2;">
                            <label class="form-label">Title</label>
                            <input class="form-input" wire:model="title" placeholder="Banner title" />
                            @error('title') <span style="color:#ef4444;font-size:.78rem;">{{ $message }}</span> @enderror
                        </div>
                        <div style="grid-column:span 2;">
                            <label class="form-label">Subtitle</label>
                            <input class="form-input" wire:model="subtitle" placeholder="Banner subtitle" />
                            @error('subtitle') <span style="color:#ef4444;font-size:.78rem;">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="form-label">Button Text</label>
                            <input class="form-input" wire:model="button_text" placeholder="Selengkapnya" />
                            @error('button_text') <span style="color:#ef4444;font-size:.78rem;">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="form-label">Sort Order</label>
                            <input class="form-input" type="number" wire:model="sort_order" min="0" />
                            @error('sort_order') <span style="color:#ef4444;font-size:.78rem;">{{ $message }}</span> @enderror
                        </div>
                        <div style="grid-column:span 2;">
                            <label class="form-label">Button URL</label>
                            <input class="form-input" wire:model="button_url" placeholder="https://..." />
                            @error('button_url') <span style="color:#ef4444;font-size:.78rem;">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="form-label" style="display:flex;align-items:center;gap:8px;margin-top:32px;">
                                <input type="checkbox" wire:model="published" style="width:18px;height:18px;" /> Published
                            </label>
                        </div>
                        <div>
                            <label class="form-label">Image</label>
                            <input class="form-input" type="file" wire:model="photo" accept="image/*" />
                            @error('photo') <span style="color:#ef4444;font-size:.78rem;">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn--secondary" wire:click="resetForm">Cancel</button>
                    <button class="btn btn--primary" wire:click="save">
                        <i class="fas fa-save"></i> {{ $banner ? 'Update' : 'Create' }}
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>

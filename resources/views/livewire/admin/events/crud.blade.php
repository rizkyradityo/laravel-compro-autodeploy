<div>
    <div class="page-header">
        <h1>Events Management</h1>
        <p>Kelola semua event PAPRA Indonesia.</p>
    </div>

    <div class="filter-bar">
        <input type="text" class="form-input" wire:model="search" placeholder="Search events..." />
        <select class="form-input form-select" style="width:auto;min-width:140px;" wire:model="filterStatus">
            <option value="">All Status</option>
            <option value="open">Open</option>
            <option value="closed">Closed</option>
            <option value="full">Full</option>
        </select>
        <button wire:click="$set('isModalOpen', true)" class="btn btn--primary">
            <i class="fas fa-plus"></i> New Event
        </button>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Location</th>
                <th>Price</th>
                <th>Registration</th>
                <th>Status</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($events as $event)
                <tr>
                    <td><strong>{{ $event->title }}</strong></td>
                    <td>{{ $event->event_date?->format('M d, Y') }}</td>
                    <td style="color:#64748b;">{{ $event->location ?? '—' }}</td>
                    <td>{{ $event->price_formatted }}</td>
                    <td>
                        @php $cls = match($event->registration_status) { 'open' => 'badge--green', 'closed' => 'badge--red', 'full' => 'badge--yellow', default => 'badge--gray' }; @endphp
                        <span class="badge {{ $cls }}">{{ ucfirst($event->registration_status) }}</span>
                    </td>
                    <td>
                        <span class="badge {{ $event->published ? 'badge--green' : 'badge--gray' }}">
                            {{ $event->published ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                    <td style="text-align:right;white-space:nowrap;">
                        <button wire:click="edit({{ $event->id }})" class="btn btn--ghost btn--sm" title="Edit"><i class="fas fa-edit"></i></button>
                        <button wire:click="togglePublished({{ $event->id }})" class="btn btn--ghost btn--sm" title="Toggle Published">
                            <i class="fas {{ $event->published ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                        </button>
                        <button wire:click="delete({{ $event->id }})" class="btn btn--ghost btn--sm" style="color:#ef4444;" onclick="return confirm('Are you sure?')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center;padding:48px;color:#94a3b8;">
                        <i class="fas fa-calendar-times" style="font-size:2rem;display:block;margin-bottom:8px;"></i>
                        No events found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination">
        {{ $events->links() }}
    </div>

    @if($isModalOpen)
        <div class="modal-overlay" wire:click.self="$set('isModalOpen', false)">
            <div class="modal">
                <div class="modal-header">
                    <h3>{{ $event ? 'Edit Event' : 'New Event' }}</h3>
                    <button class="modal-close" wire:click="resetForm">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="grid" style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div style="grid-column:span 2;">
                            <label class="form-label">Title</label>
                            <input class="form-input" wire:model="title" placeholder="Event title" />
                            @error('title') <span style="color:#ef4444;font-size:.78rem;">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="form-label">Slug</label>
                            <input class="form-input" wire:model="slug" placeholder="event-slug" />
                            @error('slug') <span style="color:#ef4444;font-size:.78rem;">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="form-label">Featured Image</label>
                            <input class="form-input" type="file" wire:model="photo" accept="image/*" />
                        </div>
                        <div>
                            <label class="form-label">Date</label>
                            <input class="form-input" type="date" wire:model="event_date" />
                            @error('event_date') <span style="color:#ef4444;font-size:.78rem;">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="form-label">Time</label>
                            <input class="form-input" type="time" wire:model="event_time" />
                        </div>
                        <div>
                            <label class="form-label">Location</label>
                            <input class="form-input" wire:model="location" placeholder="Jakarta" />
                        </div>
                        <div>
                            <label class="form-label">Price (Rp)</label>
                            <input class="form-input" type="number" wire:model="price" min="0" />
                        </div>
                        <div>
                            <label class="form-label">Capacity</label>
                            <input class="form-input" type="number" wire:model="capacity" min="0" placeholder="0 = unlimited" />
                        </div>
                        <div>
                            <label class="form-label">Registration Status</label>
                            <select class="form-input form-select" wire:model="registration_status">
                                <option value="open">Open</option>
                                <option value="closed">Closed</option>
                                <option value="full">Full</option>
                            </select>
                        </div>
                        <div>
                            <label class="form-label" style="display:flex;align-items:center;gap:8px;margin-top:32px;">
                                <input type="checkbox" wire:model="published" style="width:18px;height:18px;" /> Published
                            </label>
                        </div>
                        <div style="grid-column:span 2;">
                            <label class="form-label">Description</label>
                            <textarea class="form-input" wire:model="content" rows="4" placeholder="Event description..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn--secondary" wire:click="resetForm">Cancel</button>
                    <button class="btn btn--primary" wire:click="save">
                        <i class="fas fa-save"></i> {{ $event ? 'Update' : 'Create' }}
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>

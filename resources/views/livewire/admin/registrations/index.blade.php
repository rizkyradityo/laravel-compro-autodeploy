<div>
    <div class="page-header">
        <h1>Registrations</h1>
        <p>Kelola pendaftaran event.</p>
    </div>

    <div class="filter-bar">
        <input type="text" class="form-input" wire:model="search" placeholder="Search registrations..." />
        <select class="form-input form-select" style="width:auto;min-width:140px;" wire:model="filterStatus">
            <option value="">All Status</option>
            <option value="pending">Pending</option>
            <option value="pending_qris">Pending QRIS</option>
            <option value="paid">Paid</option>
            <option value="failed">Failed</option>
        </select>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Event</th>
                <th>Name</th>
                <th>Email</th>
                <th>Amount</th>
                <th>Order ID</th>
                <th>Status</th>
                <th>Date</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($registrations as $registration)
                <tr>
                    <td><strong>{{ $registration->event?->title }}</strong></td>
                    <td>{{ $registration->name }}</td>
                    <td style="color:#64748b;">{{ $registration->email }}</td>
                    <td>Rp {{ number_format($registration->amount, 0, ',', '.') }}</td>
                    <td style="color:#64748b;font-size:.82rem;">{{ $registration->order_id }}</td>
                    <td>
                        @php
                            $cls = match($registration->payment_status) {
                                'paid' => 'badge--green',
                                'pending' => 'badge--yellow',
                                'pending_qris' => 'badge--blue',
                                'failed' => 'badge--red',
                                default => 'badge--gray'
                            };
                        @endphp
                        <span class="badge {{ $cls }}">{{ str_replace('_', ' ', ucfirst($registration->payment_status)) }}</span>
                    </td>
                    <td style="color:#64748b;font-size:.82rem;">{{ $registration->created_at->format('M d, Y') }}</td>
                    <td style="text-align:right;white-space:nowrap;">
                        @if($registration->payment_status === 'pending_qris')
                            <button wire:click="confirmPayment({{ $registration->id }})" class="btn btn--success btn--sm" onclick="return confirm('Confirm payment as paid?')">
                                <i class="fas fa-check"></i> Confirm
                            </button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align:center;padding:48px;color:#94a3b8;">
                        <i class="fas fa-clipboard-list" style="font-size:2rem;display:block;margin-bottom:8px;"></i>
                        No registrations found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination">
        {{ $registrations->links() }}
    </div>
</div>

<div>
    <div class="page-header">
        <h1>Donations</h1>
        <p>Kelola donasi.</p>
    </div>

    <div class="filter-bar">
        <input type="text" class="form-input" wire:model="search" placeholder="Search donations..." />
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
            @forelse($donations as $donation)
                <tr>
                    <td><strong>{{ $donation->name }}</strong></td>
                    <td style="color:#64748b;">{{ $donation->email }}</td>
                    <td><strong>Rp {{ number_format($donation->amount, 0, ',', '.') }}</strong></td>
                    <td style="color:#64748b;font-size:.82rem;">{{ $donation->order_id }}</td>
                    <td>
                        @php
                            $cls = match($donation->payment_status) {
                                'paid' => 'badge--green',
                                'pending' => 'badge--yellow',
                                'pending_qris' => 'badge--blue',
                                'failed' => 'badge--red',
                                default => 'badge--gray'
                            };
                        @endphp
                        <span class="badge {{ $cls }}">{{ str_replace('_', ' ', ucfirst($donation->payment_status)) }}</span>
                    </td>
                    <td style="color:#64748b;font-size:.82rem;">{{ $donation->created_at->format('M d, Y') }}</td>
                    <td style="text-align:right;white-space:nowrap;">
                        @if($donation->payment_status === 'pending_qris')
                            <button wire:click="confirmPayment({{ $donation->id }})" class="btn btn--success btn--sm" onclick="return confirm('Confirm payment as paid?')">
                                <i class="fas fa-check"></i> Confirm
                            </button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center;padding:48px;color:#94a3b8;">
                        <i class="fas fa-hand-holding-heart" style="font-size:2rem;display:block;margin-bottom:8px;"></i>
                        No donations found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination">
        {{ $donations->links() }}
    </div>
</div>

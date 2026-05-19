<div>
    <div class="external-div">
        <div class="box-image-page">
            <div class="single-page-img"></div>
        </div>
        <div class="box-text">
            <h2>Dashboard Member</h2>
        </div>
    </div>

    <div id="primary" class="content-area">
        <div class="container">

            @if(session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="dash-welcome">
                <div class="dash-welcome__avatar">
                    @if(auth()->user()->member_photo)
                        <img src="{{ Storage::url(auth()->user()->member_photo) }}" alt="{{ auth()->user()->name }}" class="dash-welcome__img">
                    @else
                        <div class="dash-welcome__initials">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                    @endif
                </div>
                <div class="dash-welcome__text">
                    <h3 class="dash-welcome__title">Halo, {{ auth()->user()->name }}!</h3>
                    <p class="dash-welcome__subtitle">Selamat datang di dashboard member PAPRA Indonesia.</p>
                </div>
                <a href="{{ route('member.edit-profile') }}" class="dash-welcome__btn">
                    <i class="fas fa-edit"></i> Edit Profil
                </a>
            </div>

            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="dash-card">
                        <div class="dash-card__header">
                            <i class="fas fa-id-card dash-card__header-icon"></i>
                            <h4 class="dash-card__title">Informasi Profil</h4>
                        </div>
                        <div class="dash-card__body">
                            <div class="dash-info">
                                <div class="dash-info__row">
                                    <span class="dash-info__label">Nama</span>
                                    <span class="dash-info__value">{{ auth()->user()->name }}</span>
                                </div>
                                <div class="dash-info__row">
                                    <span class="dash-info__label">Email</span>
                                    <span class="dash-info__value">{{ auth()->user()->email }}</span>
                                </div>
                                <div class="dash-info__row">
                                    <span class="dash-info__label">Telepon</span>
                                    <span class="dash-info__value">{{ auth()->user()->phone ?? '-' }}</span>
                                </div>
                                <div class="dash-info__row">
                                    <span class="dash-info__label">Member Sejak</span>
                                    <span class="dash-info__value">{{ auth()->user()->created_at->format('d F Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="dash-card">
                        <div class="dash-card__header">
                            <i class="fas fa-calendar-alt dash-card__header-icon"></i>
                            <h4 class="dash-card__title">Registrasi Event</h4>
                        </div>
                        <div class="dash-card__body">
                            @if($registrations->count())
                                <div class="table-responsive">
                                    <table class="dash-table">
                                        <thead>
                                            <tr>
                                                <th>Event</th>
                                                <th>Tanggal</th>
                                                <th>Order ID</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($registrations as $reg)
                                                <tr>
                                                    <td class="dash-table__event">
                                                        <span class="dash-table__event-title">{{ $reg->event->title ?? 'Event#' . $reg->event_id }}</span>
                                                    </td>
                                                    <td>
                                                        @if($reg->event)
                                                            {{ \Carbon\Carbon::parse($reg->event->event_date)->format('d M Y') }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td class="dash-table__order-id">{{ $reg->order_id }}</td>
                                                    <td>
                                                        @php
                                                            $statusClass = match($reg->payment_status) {
                                                                'paid' => 'dash-badge--success',
                                                                'pending', 'pending_qris' => 'dash-badge--warning',
                                                                'failed', 'expired' => 'dash-badge--danger',
                                                                default => 'dash-badge--secondary',
                                                            };
                                                            $statusLabel = match($reg->payment_status) {
                                                                'paid' => 'Lunas',
                                                                'pending' => 'Menunggu Pembayaran',
                                                                'pending_qris' => 'Menunggu Verifikasi',
                                                                'failed' => 'Gagal',
                                                                'expired' => 'Kadaluarsa',
                                                                default => $reg->payment_status,
                                                            };
                                                        @endphp
                                                        <span class="dash-badge {{ $statusClass }}">{{ $statusLabel }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="dash-empty">
                                    <i class="fas fa-ticket-alt dash-empty__icon"></i>
                                    <p class="dash-empty__text">Belum ada registrasi event.</p>
                                    <a href="{{ route('events.registration') }}" class="dash-empty__btn">Daftar Event</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <style>
        .dash-welcome {
            display: flex;
            align-items: center;
            gap: 20px;
            background: linear-gradient(135deg, #0d1b3e 0%, #1060a0 100%);
            border-radius: 16px;
            padding: 28px 32px;
            margin-bottom: 32px;
            color: #fff;
        }
        .dash-welcome__avatar {
            flex-shrink: 0;
        }
        .dash-welcome__img {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(255,255,255,.3);
        }
        .dash-welcome__initials {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: var(--color-primary1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
        }
        .dash-welcome__text {
            flex: 1;
        }
        .dash-welcome__title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #fff !important;
            margin: 0 0 2px;
        }
        .dash-welcome__subtitle {
            font-size: .88rem;
            color: rgba(255,255,255,.65) !important;
            margin: 0;
        }
        .dash-welcome__btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: rgba(255,255,255,.15);
            border: 1px solid rgba(255,255,255,.25);
            border-radius: 100px;
            color: #fff;
            font-size: .85rem;
            font-weight: 600;
            text-decoration: none;
            transition: background .2s;
            white-space: nowrap;
        }
        .dash-welcome__btn:hover {
            background: rgba(255,255,255,.25);
            color: #fff;
        }
        .dash-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 16px rgba(0,0,0,.06);
            border-bottom: 3px solid var(--color-primary1);
            overflow: hidden;
            height: 100%;
        }
        .dash-card__header {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 18px 24px;
            border-bottom: 1px solid #f0f2f5;
            background: #fafbfc;
        }
        .dash-card__header-icon {
            font-size: 1.1rem;
            color: var(--color-primary1);
        }
        .dash-card__title {
            font-size: 1rem;
            font-weight: 700;
            color: #1a2744;
            margin: 0;
        }
        .dash-card__body {
            padding: 20px 24px;
        }
        .dash-info__row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #f0f2f5;
        }
        .dash-info__row:last-child {
            border-bottom: none;
        }
        .dash-info__label {
            font-size: .85rem;
            color: #718096;
        }
        .dash-info__value {
            font-size: .88rem;
            font-weight: 600;
            color: #2d3748;
            text-align: right;
        }
        .dash-table {
            width: 100%;
            border-collapse: collapse;
        }
        .dash-table th {
            font-size: .78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: #718096;
            padding: 12px 8px;
            text-align: left;
            border-bottom: 2px solid #e2e8f0;
        }
        .dash-table td {
            padding: 14px 8px;
            font-size: .88rem;
            color: #4a5568;
            border-bottom: 1px solid #f0f2f5;
            vertical-align: middle;
        }
        .dash-table tr:last-child td {
            border-bottom: none;
        }
        .dash-table__event-title {
            font-weight: 600;
            color: #2d3748;
        }
        .dash-table__order-id {
            font-family: monospace;
            font-size: .82rem;
            color: #718096;
        }
        .dash-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 100px;
            font-size: .78rem;
            font-weight: 600;
            white-space: nowrap;
        }
        .dash-badge--success {
            background: #c6f6d5;
            color: #22543d;
        }
        .dash-badge--warning {
            background: #fefcbf;
            color: #744210;
        }
        .dash-badge--danger {
            background: #fed7d7;
            color: #822727;
        }
        .dash-badge--secondary {
            background: #edf2f7;
            color: #4a5568;
        }
        .dash-empty {
            text-align: center;
            padding: 32px 0;
        }
        .dash-empty__icon {
            font-size: 2.5rem;
            color: #cbd5e0;
            margin-bottom: 12px;
        }
        .dash-empty__text {
            font-size: .92rem;
            color: #718096;
            margin: 0 0 16px;
        }
        .dash-empty__btn {
            display: inline-block;
            padding: 10px 24px;
            background: var(--color-primary1);
            color: #fff;
            border-radius: 100px;
            font-size: .88rem;
            font-weight: 600;
            text-decoration: none;
            transition: opacity .2s;
        }
        .dash-empty__btn:hover {
            opacity: .9;
            color: #fff;
        }
    </style>
</div>

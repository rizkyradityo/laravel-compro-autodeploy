<div>
    <div class="external-div">
        <div class="box-image-page">
            <div class="single-page-img"></div>
        </div>
        <div class="box-text">
            <h2>Event Dashboard</h2>
        </div>
    </div>

    <div id="primary" class="content-area">
        <div class="container">
            @if(session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="page-box">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 style="color:#0d1b3e;margin:0;font-weight:700;">
                        <i class="fas fa-calendar-alt me-2" style="color:var(--color-primary1);"></i>
                        Daftar Event
                    </h4>
                    <span class="badge" style="background:var(--color-primary1);font-size:.85rem;padding:8px 16px;">
                        {{ $events->total() }} Event
                    </span>
                </div>

                @if($events->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" style="min-width:800px;">
                            <thead>
                                <tr style="background:#f8fafc;border-bottom:2px solid var(--color-primary1);">
                                    <th style="padding:14px 12px;font-size:.82rem;font-weight:700;text-transform:uppercase;color:#0d1b3e;">Event</th>
                                    <th style="padding:14px 12px;font-size:.82rem;font-weight:700;text-transform:uppercase;color:#0d1b3e;">Tanggal</th>
                                    <th style="padding:14px 12px;font-size:.82rem;font-weight:700;text-transform:uppercase;color:#0d1b3e;">Waktu</th>
                                    <th style="padding:14px 12px;font-size:.82rem;font-weight:700;text-transform:uppercase;color:#0d1b3e;">Harga</th>
                                    <th style="padding:14px 12px;font-size:.82rem;font-weight:700;text-transform:uppercase;color:#0d1b3e;">Pendaftar</th>
                                    <th style="padding:14px 12px;font-size:.82rem;font-weight:700;text-transform:uppercase;color:#0d1b3e;">Status</th>
                                    <th style="padding:14px 12px;font-size:.82rem;font-weight:700;text-transform:uppercase;color:#0d1b3e;">Registrasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($events as $event)
                                    <tr style="border-bottom:1px solid #eef2f6;">
                                        <td style="padding:14px 12px;">
                                            <div class="d-flex align-items-center gap-3">
                                                @if($event->thumb_url)
                                                    <img src="{{ $event->thumb_url }}" alt="{{ $event->title }}"
                                                         style="width:48px;height:48px;border-radius:10px;object-fit:cover;flex-shrink:0;">
                                                @else
                                                    <div style="width:48px;height:48px;border-radius:10px;background:linear-gradient(135deg,#0d1b3e,#1060a0);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                                        <i class="fas fa-calendar-alt" style="color:rgba(255,255,255,.4);font-size:1.1rem;"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <div style="font-weight:600;color:#0d1b3e;font-size:.9rem;">{{ $event->title }}</div>
                                                    <div style="font-size:.78rem;color:#6b7280;">{{ $event->location }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="padding:14px 12px;font-size:.85rem;color:#6b7280;white-space:nowrap;">
                                            <i class="far fa-calendar me-1" style="color:var(--color-primary1);"></i>
                                            {{ $event->event_date->format('d M Y') }}
                                        </td>
                                        <td style="padding:14px 12px;font-size:.85rem;color:#6b7280;white-space:nowrap;">
                                            @if($event->event_time)
                                                <i class="far fa-clock me-1" style="color:var(--color-primary1);"></i>
                                                {{ \Carbon\Carbon::parse($event->event_time)->format('H:i') }}
                                            @else
                                                <span style="color:#ccc;">-</span>
                                            @endif
                                        </td>
                                        <td style="padding:14px 12px;font-weight:700;color:#db5f5f;font-size:.88rem;white-space:nowrap;">
                                            {{ $event->price_formatted }}
                                        </td>
                                        <td style="padding:14px 12px;text-align:center;">
                                            <span style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:50%;background:rgba(74,198,185,.12);color:#4ac6b9;font-weight:700;font-size:.85rem;">
                                                {{ $event->registrations_count }}
                                            </span>
                                        </td>
                                        <td style="padding:14px 12px;">
                                            @if($event->published)
                                                <span class="dashboard-badge dashboard-badge--published">Published</span>
                                            @else
                                                <span class="dashboard-badge dashboard-badge--draft">Draft</span>
                                            @endif
                                        </td>
                                        <td style="padding:14px 12px;">
                                            @if($event->registration_status === 'open')
                                                <span class="dashboard-badge dashboard-badge--open">Open</span>
                                            @else
                                                <span class="dashboard-badge dashboard-badge--closed">Closed</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $events->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-calendar-times" style="font-size:3rem;color:var(--color-primary1);opacity:.5;"></i>
                        <p class="mt-3" style="color:#6b7280;">Belum ada event.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .dashboard-badge {
            display: inline-block;
            padding: 4px 14px;
            border-radius: 100px;
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
        }
        .dashboard-badge--published {
            background: rgba(74,198,185,.15);
            color: #4ac6b9;
        }
        .dashboard-badge--draft {
            background: rgba(107,114,128,.12);
            color: #6b7280;
        }
        .dashboard-badge--open {
            background: rgba(74,198,185,.15);
            color: #4ac6b9;
        }
        .dashboard-badge--closed {
            background: rgba(219,95,95,.12);
            color: #db5f5f;
        }
        .table > :not(caption) > * > * {
            border-bottom: none;
        }
        .pagination {
            margin: 0;
            gap: 4px;
        }
        .page-link {
            border-radius: 8px !important;
            border: 1px solid #eef2f6;
            color: #6b7280;
            font-size: .85rem;
            padding: 8px 14px;
        }
        .page-item.active .page-link {
            background: var(--color-primary1);
            border-color: var(--color-primary1);
            color: #fff;
        }
        .page-item.disabled .page-link {
            background: #f8fafc;
            border-color: #eef2f6;
            color: #ccc;
        }
    </style>
</div>

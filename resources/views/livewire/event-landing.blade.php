<div>
    <div class="external-div">
        <div class="box-image-page">
            <div class="single-page-img"></div>
        </div>
        <div class="box-text">
            <h2>Events</h2>
        </div>
    </div>

    <div id="primary" class="content-area">
        <div class="container">
            @if($events->count() > 0)
                <div class="row g-4">
                    @foreach($events as $event)
                        <div class="col-lg-4 col-md-6">
                            <div class="event-card">
                                <div class="event-card__img">
                                    @if($event->thumb_url)
                                        <img src="{{ $event->thumb_url }}" alt="{{ $event->title }}">
                                    @else
                                        <div class="event-card__img-placeholder">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    @endif
                                    <div class="event-card__badge {{ $event->registration_status === 'open' ? 'badge-open' : 'badge-closed' }}">
                                        {{ $event->registration_status === 'open' ? 'Dibuka' : 'Ditutup' }}
                                    </div>
                                </div>
                                <div class="event-card__body">
                                    <h3 class="event-card__title">{{ $event->title }}</h3>
                                    <div class="event-card__meta">
                                        <span><i class="far fa-calendar"></i> {{ $event->event_date->format('d M Y') }}</span>
                                        @if($event->event_time)
                                            <span><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($event->event_time)->format('H:i') }} WIB</span>
                                        @endif
                                        <span><i class="fas fa-map-marker-alt"></i> {{ $event->location }}</span>
                                    </div>
                                    <div class="event-card__desc">{{ $event->excerpt }}</div>
                                    <div class="event-card__footer">
                                        <span class="event-card__price">{{ $event->price_formatted }}</span>
                                        <a href="{{ route('events.registration', ['event' => $event->id]) }}" class="event-card__btn">
                                            Daftar <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-calendar-times" style="font-size:3rem;color:var(--color-primary1);opacity:.5;"></i>
                    <p class="mt-3" style="color:#6b7280;">Belum ada event tersedia.</p>
                </div>
            @endif
        </div>
    </div>

    <style>
        .event-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #eef2f6;
            transition: all .3s;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .event-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(13,27,62,.08);
        }
        .event-card__img {
            position: relative;
            height: 200px;
            overflow: hidden;
        }
        .event-card__img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .4s;
        }
        .event-card:hover .event-card__img img {
            transform: scale(1.06);
        }
        .event-card__img-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #0d1b3e, #1060a0);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: rgba(255,255,255,.3);
        }
        .event-card__badge {
            position: absolute;
            top: 12px;
            right: 12px;
            padding: 4px 12px;
            border-radius: 100px;
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
        }
        .event-card__body {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .event-card__title {
            font-family: 'Josefin Sans', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: #0d1b3e;
            margin: 0 0 12px;
            line-height: 1.35;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .event-card__meta {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 12px;
        }
        .event-card__meta span {
            font-size: .82rem;
            color: #6b7280;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .event-card__meta i {
            width: 14px;
            color: var(--color-primary1);
        }
        .event-card__desc {
            font-size: .84rem;
            color: #6b7280;
            line-height: 1.6;
            margin-bottom: 14px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex: 1;
        }
        .event-card__footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: auto;
            padding-top: 14px;
            border-top: 1px solid #eef2f6;
        }
        .event-card__price {
            font-family: 'Josefin Sans', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            color: #db5f5f;
        }
        .event-card__btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 18px;
            background: var(--color-primary1);
            color: #fff !important;
            border-radius: 100px;
            font-size: .78rem;
            font-weight: 600;
            text-decoration: none !important;
            transition: background .2s;
        }
        .event-card__btn:hover {
            background: var(--color-primary2);
            color: #fff !important;
        }
    </style>
</div>

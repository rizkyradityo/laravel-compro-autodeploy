<div class="mh-wrap">

    {{-- HERO --}}
    <section class="mh-hero">
        <div class="mh-container">
            <div class="mh-hero__inner">
                <div class="mh-hero__text">
                    <span class="mh-hero__eyebrow">PAPRA Indonesia</span>
                    <h1 class="mh-hero__title">
                        Bersama Lawan<br>
                        <span class="mh-hero__title--accent">Resistensi Antimikroba</span>
                    </h1>
                    <p class="mh-hero__desc">
                        Semakin banyak orang yang memahami AMR, semakin sulit untuk diabaikan.
                        Bergabunglah dan bantu sebarkan informasi ini.
                    </p>
                    <div class="mh-hero__ctas">
                        <a href="{{ route('events.landing') }}" class="mh-btn mh-btn--primary">
                            &#x1F3AB; Lihat Event
                        </a>
                    </div>
                </div>

                <div class="mh-hero__grid">
                    @php
                        $colors = ['#1a9ed4', '#e8734a', '#3b82f6', '#a855f7', '#f59e0b', '#10b981'];
                        $count = 0;
                        $postsForHero = $latestPosts ?? collect();
                    @endphp
                    @foreach($postsForHero as $p)
                        @php
                            $color = $colors[$count % count($colors)];
                            $count++;
                            $title = $p->title ?? 'Artikel';
                            $thumb = $p->media?->url ?? '';
                        @endphp
                        <a href="{{ route('blog.show', $p->id) }}" class="mh-card {{ $count === 1 ? 'mh-card--featured' : '' }}">
                            @if($thumb)
                                <img src="{{ $thumb }}" alt="{{ $title }}" class="mh-card__img" />
                            @else
                                <div class="mh-card__placeholder" style="background:{{ $color }};">
                                    <span class="mh-card__placeholder-text">{{ Str::limit($title, 50) }}</span>
                                    <span class="mh-card__brand">PAPRA</span>
                                </div>
                            @endif
                            <div class="mh-card__overlay">
                                <span>{{ Str::limit($title, 50) }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="mh-hero__wave">
            <svg viewBox="0 0 1440 60" preserveAspectRatio="none"><path d="M0,30 C360,60 1080,0 1440,30 L1440,60 L0,60 Z" fill="#e8f5fc"/></svg>
        </div>
    </section>

    {{-- STATS --}}
    <section class="mh-stats">
        <div class="mh-container">
            <div class="mh-stats__row">
                <div class="mh-stat">
                    <div class="mh-stat__icon">&#x1F3AB;</div>
                    <div class="mh-stat__value">{{ $totalEvents }}</div>
                    <div class="mh-stat__label">Aksi Nyata yang Dilakukan</div>
                </div>
                <div class="mh-stat">
                    <div class="mh-stat__icon">&#x1F465;</div>
                    <div class="mh-stat__value">{{ $totalRegistrations }}</div>
                    <div class="mh-stat__label">Orang yang Berpartisipasi</div>
                </div>
                <div class="mh-stat">
                    <div class="mh-stat__icon">&#x1F31F;</div>
                    <div class="mh-stat__value">{{ $totalMembers }}</div>
                    <div class="mh-stat__label">Orang yang Siap Berkontribusi</div>
                </div>
                <div class="mh-stat">
                    <div class="mh-stat__icon">&#x2665;</div>
                    <div class="mh-stat__value">Rp {{ number_format($totalDonations, 0, ',', '.') }}</div>
                    <div class="mh-stat__label">Total Donasi</div>
                </div>
            </div>
        </div>
    </section>

    {{-- MISSION --}}
    <section class="mh-mission">
        <div class="mh-container">
            <div class="mh-mission__inner">
                <div class="mh-mission__left">
                    <h2 class="mh-section-title">Sekarang Giliran Anda<br>Untuk Berkontribusi</h2>
                    <a href="{{ route('member.register') }}" class="mh-btn mh-btn--dark">
                        Bergabung Sekarang &#x2192;
                    </a>
                </div>
                <div class="mh-mission__right">
                    <p>Karena resistensi antimikroba (AMR) adalah tantangan kesehatan masyarakat global yang diproyeksikan menyebabkan hingga 10 juta kematian per tahun pada 2050, kami akan bekerja tanpa henti untuk menjaga perhatian dunia terhadap isu ini.</p>
                    <p>Apakah Anda bekerja di garis terdepan AMR atau berkontribusi dari kebijakan, media, penelitian, atau masyarakat sipil — keterlibatan Anda sangat berarti.</p>
                    <p>Dengan bergabung bersama kami, Anda dapat terlibat aktif memerangi AMR dengan mengikuti event-event yang memberikan manfaat nyata. Selalu simak info event terbaru kami di situs dan media sosial kami.</p>
                    <div class="mh-mission__tags">
                        <span class="mh-tag">&#x1F52C; Penelitian</span>
                        <span class="mh-tag">&#x1F4CB; Kebijakan</span>
                        <span class="mh-tag">&#x1F4E2; Edukasi</span>
                        <span class="mh-tag">&#x1F3E5; Kesehatan</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- EVENTS --}}
    @if($latestEvents->count() > 0)
    <section class="mh-events">
        <div class="mh-container">
            <div class="mh-section-header">
                <span class="mh-eyebrow">Program Kami</span>
                <h2 class="mh-section-title">Event Terkini</h2>
                <a href="{{ route('events.landing') }}" class="mh-section-link">Lihat Semua &#x2192;</a>
            </div>
            <div class="mh-events__grid">
                @php $evColors = ['#4ac6b9', '#e8734a', '#3b82f6']; @endphp
                @foreach($latestEvents as $i => $ev)
                    <div class="mh-event-card">
                        <div class="mh-event-card__thumb" style="background:{{ $evColors[$i % 3] }};">
                            @if($ev->thumb_url)
                                <img src="{{ $ev->thumb_url }}" alt="{{ $ev->title }}" />
                            @else
                                <span class="mh-event-card__icon">&#x1F3AB;</span>
                            @endif
                            <span class="mh-event-card__badge {{ $ev->registration_status === 'open' ? 'mh-badge--open' : 'mh-badge--closed' }}">
                                {{ $ev->registration_status === 'open' ? 'Terbuka' : 'Ditutup' }}
                            </span>
                        </div>
                        <div class="mh-event-card__body">
                            <h3 class="mh-event-card__title">{{ $ev->title ?: 'Untitled Event' }}</h3>
                            @if($ev->event_date)
                                <p class="mh-event-card__meta">&#x1F4C5; {{ $ev->event_date->format('d M Y') }}</p>
                            @endif
                            @if($ev->location)
                                <p class="mh-event-card__meta">&#x1F4CD; {{ $ev->location }}</p>
                            @endif
                            <div class="mh-event-card__footer">
                                <span class="mh-event-card__price">{{ $ev->price_formatted }}</span>
                                <a href="{{ route('events.registration', ['event' => $ev->id]) }}" class="mh-btn mh-btn--sm">Daftar &#x2192;</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- DONATE CTA --}}
    <section class="mh-donate-cta">
        <div class="mh-container">
            <div class="mh-donate-cta__inner">
                <div class="mh-donate-cta__text">
                    <h2>Donasi Anda Membuat Perbedaan</h2>
                    <p>Setiap kontribusi membantu kami mengedukasi lebih banyak orang tentang bahaya AMR dan mendukung program-program kesehatan masyarakat Indonesia.</p>
                </div>
                <a href="{{ route('donation.form') }}" class="mh-btn mh-btn--white">
                    &#x2665; Donasi Sekarang
                </a>
            </div>
        </div>
    </section>

    <style>
    :root {
        --mh-navy: #0d1b3e;
        --mh-teal: #1a9ed4;
        --mh-teal-dark: #1480b0;
        --mh-light: #e8f5fc;
        --mh-white: #ffffff;
        --mh-muted: #5a6e85;
        --mh-border: #b8ddf0;
        --mh-radius: 14px;
    }
    .mh-wrap { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; color: var(--mh-navy); overflow-x: hidden; }
    .mh-container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }

    .mh-btn { display: inline-flex; align-items: center; gap: 8px; padding: 13px 28px; border-radius: 99px; font-size: .95rem; font-weight: 700; text-decoration: none; transition: all .2s; white-space: nowrap; cursor: pointer; }
    .mh-btn--primary { background: var(--mh-teal); color: var(--mh-white); }
    .mh-btn--primary:hover { background: var(--mh-teal-dark); color: var(--mh-white); }
    .mh-btn--dark { background: var(--mh-navy); color: var(--mh-white); }
    .mh-btn--dark:hover { background: #0a1c2e; color: var(--mh-white); }
    .mh-btn--white { background: var(--mh-white); color: var(--mh-navy); }
    .mh-btn--white:hover { background: var(--mh-light); color: var(--mh-navy); }
    .mh-btn--sm { padding: 8px 18px; font-size: .82rem; background: var(--mh-teal); color: var(--mh-white); }
    .mh-btn--sm:hover { background: var(--mh-teal-dark); color: var(--mh-white); }

    .mh-hero { background: linear-gradient(135deg, #0d1b3e 0%, #0e2d5a 50%, #1060a0 100%); padding: 80px 0 0; position: relative; overflow: hidden; }
    .mh-hero::before { content: ''; position: absolute; top: -80px; right: -80px; width: 500px; height: 500px; border-radius: 50%; background: radial-gradient(circle, rgba(74,198,185,.12) 0%, transparent 70%); pointer-events: none; }
    .mh-hero__inner { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: center; padding-bottom: 60px; }
    .mh-hero__eyebrow { display: inline-block; background: rgba(74,198,185,.2); color: var(--mh-teal); font-size: .8rem; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; padding: 5px 14px; border-radius: 99px; margin-bottom: 20px; }
    .mh-hero__title { font-size: clamp(2rem, 4vw, 3rem); font-weight: 800; color: var(--mh-white); line-height: 1.2; margin: 0 0 20px; }
    .mh-hero__title--accent { color: var(--mh-teal); }
    .mh-hero__desc { color: rgba(255,255,255,.75); font-size: 1.05rem; line-height: 1.7; margin: 0 0 32px; max-width: 460px; }
    .mh-hero__ctas { display: flex; gap: 14px; flex-wrap: wrap; }
    .mh-hero__grid { display: grid; grid-template-columns: repeat(3, 1fr); grid-auto-rows: 180px; gap: 10px; min-height: 370px; }
    .mh-card { border-radius: 12px; overflow: hidden; position: relative; cursor: pointer; transition: transform .2s; display: block; text-decoration: none; color: inherit; }
    .mh-card:hover { transform: scale(1.02); }
    .mh-card--featured { grid-column: span 2; }
    .mh-card__img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .mh-card__placeholder { width: 100%; height: 100%; display: flex; flex-direction: column; align-items: flex-start; justify-content: flex-end; padding: 16px; }
    .mh-card__placeholder-text { color: rgba(255,255,255,.95); font-size: .85rem; font-weight: 700; line-height: 1.3; margin-bottom: 4px; }
    .mh-card__brand { color: rgba(255,255,255,.6); font-size: .72rem; font-weight: 600; letter-spacing: .08em; text-transform: uppercase; }
    .mh-card__overlay { position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,.7) 0%, transparent 100%); padding: 20px 12px 10px; color: #fff; font-size: .8rem; font-weight: 600; opacity: 0; transition: opacity .2s; }
    .mh-card:hover .mh-card__overlay { opacity: 1; }
    .mh-hero__wave { line-height: 0; }
    .mh-hero__wave svg { display: block; width: 100%; height: 60px; }

    .mh-stats { background: var(--mh-light); padding: 48px 0; }
    .mh-stats__row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; }
    .mh-stat { background: var(--mh-white); border-radius: var(--mh-radius); padding: 28px 20px; text-align: center; box-shadow: 0 2px 12px rgba(26,158,212,.12); border-bottom: 4px solid var(--mh-teal); border-top: 1px solid var(--mh-border); transition: transform .2s; }
    .mh-stat:hover { transform: translateY(-3px); }
    .mh-stat__icon { font-size: 1.8rem; margin-bottom: 8px; }
    .mh-stat__value { font-size: 1.6rem; font-weight: 800; color: var(--mh-navy); margin-bottom: 4px; }
    .mh-stat__label { font-size: .8rem; color: var(--mh-muted); font-weight: 500; }

    .mh-mission { padding: 80px 0; background: var(--mh-white); }
    .mh-mission__inner { display: grid; grid-template-columns: 1fr 1.4fr; gap: 64px; align-items: start; }
    .mh-mission__left { position: sticky; top: 100px; }
    .mh-section-title { font-size: clamp(1.6rem, 3vw, 2.2rem); font-weight: 800; color: var(--mh-navy); line-height: 1.25; margin: 0 0 28px; }
    .mh-mission__right p { color: var(--mh-muted); line-height: 1.8; margin-bottom: 16px; font-size: .97rem; }
    .mh-mission__tags { display: flex; gap: 10px; flex-wrap: wrap; margin-top: 24px; }
    .mh-tag { background: var(--mh-light); color: var(--mh-navy); border: 1.5px solid var(--mh-border); border-radius: 99px; padding: 6px 14px; font-size: .82rem; font-weight: 600; }

    .mh-events { padding: 80px 0; background: var(--mh-light); }
    .mh-section-header { display: flex; align-items: baseline; gap: 16px; margin-bottom: 36px; flex-wrap: wrap; }
    .mh-eyebrow { display: inline-block; background: rgba(74,198,185,.15); color: var(--mh-teal-dark); font-size: .75rem; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; padding: 4px 12px; border-radius: 99px; }
    .mh-section-link { margin-left: auto; color: var(--mh-teal-dark); font-weight: 700; font-size: .9rem; text-decoration: none; }
    .mh-section-link:hover { text-decoration: underline; }
    .mh-events__grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
    .mh-event-card { background: var(--mh-white); border-radius: var(--mh-radius); overflow: hidden; box-shadow: 0 2px 16px rgba(0,0,0,.07); transition: transform .2s, box-shadow .2s; }
    .mh-event-card:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(0,0,0,.12); }
    .mh-event-card__thumb { height: 180px; position: relative; display: flex; align-items: center; justify-content: center; }
    .mh-event-card__thumb img { width: 100%; height: 100%; object-fit: cover; }
    .mh-event-card__icon { font-size: 2.5rem; }
    .mh-event-card__body { padding: 20px; }
    .mh-event-card__title { font-size: 1rem; font-weight: 700; color: var(--mh-navy); margin: 0 0 10px; line-height: 1.4; }
    .mh-event-card__meta { font-size: .8rem; color: var(--mh-muted); margin: 0 0 4px; }
    .mh-event-card__footer { display: flex; align-items: center; justify-content: space-between; margin-top: 16px; padding-top: 14px; border-top: 1px solid var(--mh-border); }
    .mh-event-card__price { font-weight: 700; color: var(--mh-teal-dark); font-size: .9rem; }
    .mh-event-card__badge { position: absolute; top: 12px; left: 12px; padding: 4px 10px; border-radius: 99px; font-size: .72rem; font-weight: 700; }
    .mh-badge--open { background: #dcfce7; color: #16a34a; }
    .mh-badge--closed { background: #fee2e2; color: #dc2626; }

    .mh-donate-cta { background: linear-gradient(135deg, var(--mh-navy) 0%, #122050 100%); padding: 72px 0; }
    .mh-donate-cta__inner { display: flex; align-items: center; justify-content: space-between; gap: 32px; flex-wrap: wrap; }
    .mh-donate-cta__text h2 { font-size: 1.8rem; font-weight: 800; color: var(--mh-white); margin: 0 0 12px; }
    .mh-donate-cta__text p { color: rgba(255,255,255,.7); max-width: 520px; line-height: 1.7; margin: 0; font-size: .95rem; }

    @media (max-width: 1024px) {
        .mh-hero__grid { grid-auto-rows: 150px; }
        .mh-stats__row { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .mh-hero { padding: 48px 0 0; }
        .mh-hero__inner { grid-template-columns: 1fr; gap: 32px; }
        .mh-hero__grid { grid-template-columns: repeat(2, 1fr); grid-auto-rows: 130px; }
        .mh-card--featured { grid-column: span 2; }
        .mh-mission__inner { grid-template-columns: 1fr; gap: 32px; }
        .mh-mission__left { position: static; }
        .mh-events__grid { grid-template-columns: 1fr; }
        .mh-donate-cta__inner { flex-direction: column; text-align: center; }
        .mh-section-header { flex-direction: column; align-items: flex-start; }
    }
    @media (max-width: 480px) {
        .mh-stats__row { grid-template-columns: 1fr; }
        .mh-hero__grid { grid-template-columns: 1fr; grid-auto-rows: 160px; }
        .mh-card--featured { grid-column: span 1; }
        .mh-hero__ctas { flex-direction: column; }
        .mh-btn { justify-content: center; }
    }
    </style>
</div>

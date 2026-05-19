<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'PAPRA Indonesia' }} | PAPRA Indonesia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100;200;300;400;500;600;700&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    @vite(['resources/css/app.css'])
    <style>
        :root { --color-primary1: #4ac6b9; --color-primary2: #db5f5f; }
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family: 'Poppins', sans-serif; font-size:15px; color:#676767; background:#fff; -ms-word-wrap:break-word; word-wrap:break-word; }
        h1,h2,h3,h4,h5,h6 { color: var(--color-primary2); font-family: 'Josefin Sans', sans-serif; }
        a { text-decoration:none; color:var(--color-primary1); transition:color .2s; }
        a:hover { color:var(--color-primary2); }
        img { max-width:100%; height:auto; vertical-align:middle; }
        .container { max-width:1200px; }

        .top-header { background: linear-gradient(135deg, #0d1b3e 0%, #1060a0 100%) !important; box-shadow: 0 2px 16px rgba(13,27,62,.4); z-index:99; width:100%; }
        .top-header span, .top-header a { color:#fff; }
        .topbar i { color:#a8dcf5 !important; }
        .logo h1, .logo p.site-title { padding:0; font-size:25px; line-height:1; font-weight:600; font-family:'Josefin Sans',sans-serif; color:#fff; margin:0; }
        .logo h1 a, .logo p a { color:#fff; }
        .logo h1 a:hover { color:var(--color-primary2); }

        .main-navigation ul { list-style:none; margin:0; padding-left:0; display:flex; align-items:center; gap:0; }
        .main-navigation li { position:relative; padding:14px 7px; display:inline-block; text-transform:uppercase; white-space:nowrap; }
        .main-navigation a { display:block; color:#fff; padding:0; font-size:12px; font-weight:500; letter-spacing:.03em; }
        .main-navigation a:hover { color:#a8dcf5 !important; }
        .donasi-header-btn { background:#db5f5f; color:#fff!important; border-radius:100px; padding:8px 20px!important; font-weight:700; font-size:.85rem; display:inline-flex; align-items:center; gap:6px; transition:background .2s; white-space:nowrap; }
        .donasi-header-btn:hover { background:#c04444!important; color:#fff!important; }
        .mobile-toggle { display:none; background:none; border:1.5px solid rgba(255,255,255,.3); color:#fff; border-radius:8px; padding:6px 10px; cursor:pointer; font-size:1.2rem; line-height:1; }
        .sidenav { height:100%; width:100%; position:fixed; z-index:9999999; top:0; right:0; visibility:hidden; background:#0d1b3e; transition:.5s; padding-top:60px; overflow-y:scroll; }
        .sidenav.open { visibility:visible; }
        .sidenav a { text-decoration:none; color:#c8dff0; display:block; padding:12px 20px; font-size:15px; border-bottom:1px solid rgba(255,255,255,.05); }
        .sidenav .closebtn { position:absolute; top:0; right:25px; font-size:36px; color:#fff; text-decoration:none; }
        .main-navigation a:hover { color:#a8dcf5 !important; }
        .main-navigation ul ul { opacity:0; position:absolute; left:0; top:100%; background:var(--color-primary2); min-width:215px; z-index:9999; }
        .main-navigation ul li:hover > ul { opacity:1; }
        .main-navigation ul ul li { float:none; display:block; text-align:left; border-bottom:1px solid #ccc; }
        .main-navigation ul ul a { color:#fff; padding:12px; }
        .main-navigation ul ul li:last-child { border-bottom:0; }

        .hs-toggle { background:rgba(255,255,255,.15); border:1.5px solid rgba(255,255,255,.3); color:#fff; border-radius:50%; width:34px; height:34px; display:inline-flex; align-items:center; justify-content:center; cursor:pointer; font-size:.85rem; transition:background .2s; flex-shrink:0; }
        .hs-toggle:hover, .hs-toggle.is-active { background:#1a9ed4; border-color:#1a9ed4; }
        .hs-panel { background:#f8f9fb; border-bottom:none; max-height:0; overflow:hidden; transition:max-height .35s cubic-bezier(.4,0,.2,1); position:relative; z-index:9999; }
        .hs-panel.is-open { max-height:72px; padding:14px 0; }
        .hs-panel__form { flex:1; display:flex; height:38px; background:#fff; border-radius:8px; overflow:hidden; box-shadow:0 0 0 1.5px #d1d5db; }
        .hs-panel__input { flex:1; border:none; outline:none; padding:0 14px; font-size:.9rem; }
        .hs-panel__submit { background:#1a9ed4; border:none; color:#fff; width:38px; cursor:pointer; display:flex; align-items:center; justify-content:center; }
        .hs-panel__close { background:transparent; border:1.5px solid #d1d5db; color:#6b7280; border-radius:50%; width:36px; height:36px; display:inline-flex; align-items:center; justify-content:center; cursor:pointer; }

        .member-btn { display:inline-flex; align-items:center; gap:6px; padding:6px 14px; border-radius:100px; font-size:.82rem; font-weight:600; text-decoration:none !important; transition:background .2s,color .2s; cursor:pointer; border:none; }
        .member-btn--in { background:rgba(74,198,185,.25); color:#fff; }
        .member-btn--out { background:rgba(255,255,255,.12); color:#fff; }
        .member-btn__avatar { width:28px; height:28px; border-radius:50%; object-fit:cover; }
        .member-btn__initials { width:28px; height:28px; border-radius:50%; background:var(--color-primary1); color:#fff; display:inline-flex; align-items:center; justify-content:center; font-size:.75rem; font-weight:700; }
        .member-btn__label { white-space:nowrap; }
        .member-btn__caret { font-size:.6rem; }
        .member-btn__icon { font-size:.85rem; }
        .member-dropdown { position:relative; }
        .member-dropdown__menu { position:absolute; top:100%; right:0; background:#fff; border-radius:12px; box-shadow:0 8px 32px rgba(0,0,0,.15); min-width:200px; display:none; z-index:99999; overflow:hidden; }
        .member-dropdown__menu.is-open { display:block; }
        .member-dropdown__item { display:block; padding:12px 16px; color:#333 !important; font-size:.85rem; text-decoration:none; transition:background .15s; }
        .member-dropdown__item:hover { background:#f5f7fa; color:var(--color-primary1) !important; }
        .member-dropdown__item--logout { color:#db5f5f !important; border-top:1px solid #eee; }
        .member-dropdown__divider { height:1px; background:#eee; }

        .donate-btn-1, .donate-btn-2 { padding:10px 30px; font-size:16px; font-weight:600; color:#fff!important; border-radius:4px; }
        .donate-btn-1 { background:var(--color-primary2); }
        .donate-btn-2 { background:var(--color-primary1); }
        .donate-btn-1:hover { background:var(--color-primary1); }
        .donate-btn-2:hover { background:var(--color-primary2); }

        .external-div { position:relative; text-align:center; height:160px; background:#0d1b3e; }
        .box-image-page { background:#0d1b3e; height:160px; overflow:hidden; position:relative; }
        .box-image-page .single-page-img { background:linear-gradient(135deg,#0d1b3e 0%,#122050 100%); height:160px; }
        .box-text { position:absolute; top:50%; transform:translateY(-50%); left:30%; right:30%; z-index:99; text-align:center; }
        .box-text h2 { color:#fff; font-weight:800; letter-spacing:.05em; text-transform:uppercase; }

        #primary { padding:3% 0; }
        #tp_content { background:#e8f5fc; }
        #primary.content-area { padding:48px 0 64px; }

        .page-box { margin:0 0 4em; padding:45px 30px; background:#fff; border-radius:12px; box-shadow:0 0 2px #aaa; border-bottom:3px solid var(--color-primary1); }
        .page-box:hover { box-shadow:0 0 20px #cfcfcf; }

        #footer { background:transparent !important; padding:0 !important; }
        .site-info { background:var(--color-primary1); padding:15px 0; }
        .site-info p, .site-info a { margin-bottom:0; text-align:center; color:#fff; }
        .site-info a:hover { color:#000 !important; }

        @media (max-width:1000px) {
            .mobile-toggle { display:flex; align-items:center; justify-content:center; }
            .main-navigation { display:none; }
            .donasi-header-btn { padding:6px 14px!important; font-size:.78rem!important; }
            .member-btn--out .member-btn__label { display:none; }
        }
        #return-to-top { position:fixed; bottom:20px; right:20px; background:rgba(0,0,0,.7); width:50px; height:50px; border-radius:35px; display:none; z-index:9999; cursor:pointer; }
        #return-to-top i { color:#fff; display:flex; align-items:center; justify-content:center; height:100%; font-size:19px; }
    </style>
    @stack('styles')
</head>
<body>
    <div class="top-header py-1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-auto align-self-md-center">
                    <div class="logo">
                        <h1 class="text-capitalize mb-0" style="font-size:20px;margin-right:24px;">
                            <a href="{{ url('/') }}" class="d-flex align-items-center gap-2">
                                <span style="color:#fff;">PAPRA</span>
                                <span style="color:#1a9ed4;font-weight:300;">Indonesia</span>
                            </a>
                        </h1>
                    </div>
                </div>
                <div class="col align-self-center">
                    <div class="d-flex align-items-center justify-content-between w-100" style="gap:12px;">
                        <div class="main-navigation">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><a href="{{ route('materi.list') }}">Materi AMR</a></li>
                                <li><a href="{{ route('events.landing') }}">Aksi AMR</a></li>
                                <li><a href="{{ route('page.show', 'tentang-kita') }}">Tentang Kita</a></li>
                                <li><a href="{{ route('blog.index') }}">Artikel AMR</a></li>
                            </ul>
                        </div>

                        <div class="d-flex align-items-center" style="gap:6px;flex-shrink:0;">
                            <a href="{{ route('donation.form') }}" class="donasi-header-btn">
                                &#x2665; Donasi
                            </a>
                            @auth
                                <div class="member-dropdown">
                                    <button type="button" class="member-btn member-btn--in" id="memberToggle" aria-expanded="false" style="padding:4px 10px;font-size:.78rem;">
                                        @if(auth()->user()->member_photo)
                                            <img src="{{ Storage::url(auth()->user()->member_photo) }}" alt="" class="member-btn__avatar" style="width:24px;height:24px;" />
                                        @else
                                            <span class="member-btn__initials" style="width:24px;height:24px;font-size:.65rem;">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                                        @endif
                                        <span class="member-btn__label d-none d-md-inline">{{ auth()->user()->name }}</span>
                                    </button>
                                    <div class="member-dropdown__menu" id="memberMenu">
                                        <a href="{{ route('member.dashboard') }}" class="member-dropdown__item">&#x1F3E0; Dashboard</a>
                                        <a href="{{ route('member.edit-profile') }}" class="member-dropdown__item">&#x270E; Edit Profil</a>
                                        <div class="member-dropdown__divider"></div>
                                        <a href="{{ route('member.logout') }}" class="member-dropdown__item member-dropdown__item--logout">&#x1F6AA; Keluar</a>
                                    </div>
                                </div>
                            @else
                                <a href="{{ route('member.login') }}" class="member-btn member-btn--out" style="padding:4px 10px;font-size:.78rem;">
                                    <i class="fas fa-user member-btn__icon" style="font-size:.75rem;"></i>
                                    <span class="member-btn__label d-none d-md-inline">Member</span>
                                </a>
                            @endauth
                            <button class="mobile-toggle" id="mobileMenuToggle" aria-label="Menu">
                                <i class="fas fa-bars"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Sidenav for mobile --}}
    <div class="sidenav" id="mobileSidenav">
        <a href="javascript:void(0)" class="closebtn" id="mobileSidenavClose">&times;</a>
        <a href="{{ url('/') }}">Home</a>
        <a href="{{ route('materi.list') }}">Materi AMR</a>
        <a href="{{ route('events.landing') }}">Aksi AMR</a>
        <a href="{{ route('page.show', 'tentang-kita') }}">Tentang Kita</a>
        <a href="{{ route('blog.index') }}">Artikel AMR</a>
        <a href="{{ route('donation.form') }}" style="color:#db5f5f;font-weight:700;">&#x2665; Donasi</a>
        @auth
            <a href="{{ route('member.dashboard') }}">&#x1F3E0; Dashboard</a>
            <a href="{{ route('member.edit-profile') }}">&#x270E; Edit Profil</a>
            <a href="{{ route('member.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">&#x1F6AA; Keluar</a>
            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">@csrf</form>
        @else
            <a href="{{ route('member.login') }}">&#x1F464; Login Member</a>
        @endauth
    </div>

    <div class="hs-panel" id="hsPanel" aria-hidden="true">
        <div class="container d-flex align-items-center gap-2">
            <form class="hs-panel__form" action="{{ url('/') }}" method="GET" role="search">
                <input type="text" name="s" class="hs-panel__input" placeholder="Cari event atau artikel..." />
                <button type="submit" class="hs-panel__submit" aria-label="Cari"><i class="fas fa-search"></i></button>
            </form>
            <button class="hs-panel__close" id="hsClose" aria-label="Tutup"><i class="fas fa-times"></i></button>
        </div>
    </div>

    {{ $slot }}

    <div class="papra-footer">
        <div class="papra-footer__top">
            <div class="papra-footer__container">
                <div class="papra-footer__brand">
                    <div class="papra-footer__site-name">PAPRA Indonesia</div>
                    <p class="papra-footer__tagline">
                        Perkumpulan Penggerak Aksi Pengendalian Resistansi Antimikroba (PAPRA)<br>
                        Sekretariat: Jalan Rawamangun No. 93C RT.10 RW 002, Kelurahan Rawasari, Kecamatan Cempaka Putih, Jakarta Pusat, DKI Jakarta
                    </p>
                    <div class="papra-footer__contact">
                        <a href="https://wa.me/6281234567890" target="_blank" rel="noopener" class="papra-footer__contact-item">&#x1F4DE; +62 812-3456-7890</a>
                        <a href="mailto:info@papra.id" class="papra-footer__contact-item">&#x2709; info@papra.id</a>
                    </div>
                    <div class="papra-footer__social">
                        <a href="#" class="papra-footer__social-icon" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="papra-footer__social-icon" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="papra-footer__social-icon" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="papra-footer__social-icon" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="papra-footer__col">
                    <h4 class="papra-footer__col-title">Program</h4>
                    <ul class="papra-footer__links">
                        <li><a href="{{ route('events.landing') }}">&#x1F3AB; Aksi AMR</a></li>
                        <li><a href="{{ route('materi.list') }}">&#x1F4DA; Materi AMR</a></li>
                        <li><a href="{{ route('page.show', 'tentang-kita') }}">&#x2139; Tentang Kita</a></li>
                        <li><a href="{{ route('blog.index') }}">&#x1F4DD; Artikel AMR</a></li>
                    </ul>
                </div>
                <div class="papra-footer__col">
                    <h4 class="papra-footer__col-title">Member</h4>
                    <ul class="papra-footer__links">
                        <li><a href="{{ route('member.login') }}">&#x1F464; Login</a></li>
                        <li><a href="{{ route('member.register') }}">&#x1F31F; Daftar</a></li>
                        <li><a href="{{ route('member.dashboard') }}">&#x1F3E0; Dashboard</a></li>
                    </ul>
                </div>
                <div class="papra-footer__col--cta">
                    <h4 class="papra-footer__col-title">Bergabung Bersama Kami</h4>
                    <p class="papra-footer__cta-text">Dukung gerakan pengendalian AMR di Indonesia. Setiap kontribusi berarti.</p>
                    <a href="{{ route('donation.form') }}" class="papra-footer__donate-btn">&#x2665; Donasi Sekarang</a>
                </div>
            </div>
        </div>
        <div class="papra-footer__bottom">
            <div class="papra-footer__bottom-inner container">
                <p>&copy; {{ date('Y') }} PAPRA Indonesia. All rights reserved.</p>
            </div>
        </div>
    </div>

    <a href="javascript:void(0)" id="return-to-top"><i class="fas fa-arrow-up"></i></a>

    <button id="papra-chat-fab" aria-label="Buka chatbot">
        <svg class="papra-chat-fab__open" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        <svg class="papra-chat-fab__close" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
    <div id="papra-chat-box" role="dialog" aria-label="Chatbot AMR">
        <iframe id="papra-chat-iframe" src="" title="Chatbot AMR" allow="microphone"></iframe>
    </div>

    <style>
    .papra-footer { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; }
    .papra-footer__top { background: linear-gradient(135deg, #0d1b3e 0%, #0e3570 50%, #1060a0 100%); padding: 64px 0 48px; border-top: 4px solid #1a9ed4; }
    .papra-footer__container { max-width: 1200px; margin: 0 auto; padding: 0 24px; display: grid; grid-template-columns: 1.8fr 1fr 1fr 1.4fr; gap: 0; }
    .papra-footer__brand { padding-right: 48px; border-right: 1px solid rgba(255,255,255,.08); }
    .papra-footer__site-name { font-size: 1.5rem; font-weight: 800; color: #1a9ed4; margin-bottom: 10px; }
    .papra-footer__tagline { color: rgba(255,255,255,.55); font-size: .84rem; line-height: 1.75; margin: 0 0 20px; max-width: 260px; }
    .papra-footer__contact { display: flex; flex-direction: column; gap: 8px; margin-bottom: 24px; }
    .papra-footer__contact-item { color: rgba(255,255,255,.65); font-size: .82rem; text-decoration: none; transition: color .2s; display: flex; align-items: center; gap: 6px; }
    .papra-footer__contact-item:hover { color: #1a9ed4; }
    .papra-footer__social { display: flex; gap: 8px; }
    .papra-footer__social-icon { width: 34px; height: 34px; border-radius: 50%; background: rgba(255,255,255,.07); border: 1px solid rgba(255,255,255,.1); display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,.6); text-decoration: none; font-size: .85rem; transition: background .2s; }
    .papra-footer__social-icon:hover { background: #1a9ed4; color: #fff; border-color: #1a9ed4; }
    .papra-footer__col { padding: 0 32px; border-right: 1px solid rgba(255,255,255,.08); }
    .papra-footer__col-title { font-size: .72rem !important; font-weight: 700 !important; letter-spacing: .14em; text-transform: uppercase; color: #1a9ed4 !important; margin: 0 0 20px !important; padding: 0 0 12px !important; border: none !important; border-bottom: 1px solid rgba(74,198,185,.25) !important; }
    .papra-footer__links { list-style: none; margin: 0; padding: 0; }
    .papra-footer__links li { padding: 0 !important; }
    .papra-footer__links li a { color: rgba(255,255,255,.6) !important; font-size: .86rem; text-decoration: none; transition: color .2s, padding-left .2s; display: block; padding: 7px 0 !important; border-bottom: 1px solid rgba(255,255,255,.04); }
    .papra-footer__links li:last-child a { border-bottom: none !important; }
    .papra-footer__links li a:hover { color: #1a9ed4 !important; padding-left: 6px !important; }
    .papra-footer__col--cta { padding: 24px; border-right: none; background: rgba(26,158,212,.12); border-radius: 12px; border: 1px solid rgba(26,158,212,.3); margin-left: 24px; align-self: start; }
    .papra-footer__cta-text { color: rgba(255,255,255,.55) !important; font-size: .84rem; line-height: 1.65; margin: 0 0 20px !important; }
    .papra-footer__donate-btn { display: inline-flex; align-items: center; gap: 8px; padding: 12px 22px; background: linear-gradient(135deg, #1a9ed4 0%, #1480b0 100%); color: #fff !important; border-radius: 99px; font-size: .86rem; font-weight: 700; text-decoration: none; transition: opacity .2s, transform .2s; box-shadow: 0 4px 16px rgba(74,198,185,.3); }
    .papra-footer__donate-btn:hover { opacity: .9; transform: translateY(-1px); color: #fff !important; }
    .papra-footer__bottom { background: #0a1a40; padding: 16px 0; border-top: 1px solid rgba(26,158,212,.2); }
    .papra-footer__bottom-inner { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px; }
    .papra-footer__bottom p { color: rgba(255,255,255,.35) !important; font-size: .78rem; margin: 0 !important; }

    #papra-chat-fab { position: fixed; bottom: 84px; right: 20px; width: 56px; height: 56px; border-radius: 50%; background: linear-gradient(135deg, #1a73e8, #0d47a1); color: #fff; border: none; cursor: pointer; box-shadow: 0 4px 16px rgba(0,0,0,.3); display: flex; align-items: center; justify-content: center; z-index: 99999; transition: transform .2s; }
    #papra-chat-fab:hover { transform: scale(1.08); }
    #papra-chat-fab svg { width: 26px; height: 26px; }
    #papra-chat-fab .papra-chat-fab__close { display: none; }
    #papra-chat-fab.is-open .papra-chat-fab__open { display: none; }
    #papra-chat-fab.is-open .papra-chat-fab__close { display: block; }
    #papra-chat-box { position: fixed; bottom: 152px; right: 20px; width: 390px; height: calc(100vh - 180px); max-height: 680px; min-height: 300px; border-radius: 16px; overflow: hidden; box-shadow: 0 8px 32px rgba(0,0,0,.25); z-index: 99998; display: none; background: #fff; }
    #papra-chat-box.is-open { display: block; }
    #papra-chat-box iframe { width: 100%; height: 100%; border: none; }

    @media (max-width: 1024px) {
        .papra-footer__container { grid-template-columns: 1fr 1fr; }
        .papra-footer__brand { border-right: none; border-bottom: 1px solid rgba(255,255,255,.08); padding-right: 0; padding-bottom: 32px; }
        .papra-footer__col { border-right: none; border-bottom: 1px solid rgba(255,255,255,.08); padding: 24px 0; }
        .papra-footer__col--cta { margin-left: 0; grid-column: span 2; }
    }
    @media (max-width: 600px) {
        .papra-footer__container { grid-template-columns: 1fr; }
        .papra-footer__col--cta { grid-column: span 1; }
        #papra-chat-box { width: calc(100vw - 24px); right: 12px; }
    }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var mobileToggle = document.getElementById('mobileMenuToggle');
        var mobileSidenav = document.getElementById('mobileSidenav');
        var mobileClose = document.getElementById('mobileSidenavClose');
        if (mobileToggle && mobileSidenav) {
            mobileToggle.addEventListener('click', function() { mobileSidenav.classList.toggle('open'); });
            if (mobileClose) { mobileClose.addEventListener('click', function() { mobileSidenav.classList.remove('open'); }); }
            mobileSidenav.addEventListener('click', function(e) { if (e.target.tagName === 'A' && !e.target.hasAttribute('onclick')) { mobileSidenav.classList.remove('open'); } });
        }
        var toggle = document.querySelector('.toggle-nav button');
        if (toggle) {
            toggle.addEventListener('click', function() {
                document.querySelector('.sidenav').classList.toggle('open');
            });
        }
        var closeBtn = document.querySelector('.sidenav .closebtn');
        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                document.querySelector('.sidenav').classList.remove('open');
            });
        }
        var memberToggle = document.getElementById('memberToggle');
        var memberMenu = document.getElementById('memberMenu');
        if (memberToggle && memberMenu) {
            memberToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                memberMenu.classList.toggle('is-open');
            });
            document.addEventListener('click', function() { memberMenu.classList.remove('is-open'); });
            memberMenu.addEventListener('click', function(e) { e.stopPropagation(); });
        }
        window.addEventListener('scroll', function() {
            var btn = document.getElementById('return-to-top');
            if (btn) { btn.style.display = window.scrollY > 300 ? 'block' : 'none'; }
        });
        document.getElementById('return-to-top')?.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        var fab = document.getElementById('papra-chat-fab');
        var box = document.getElementById('papra-chat-box');
        var frame = document.getElementById('papra-chat-iframe');
        var url = 'https://rezekara.dev/chatbotamr/chatbox.html';
        var loaded = false;
        if (fab && box && frame) {
            fab.addEventListener('click', function() {
                var open = box.classList.toggle('is-open');
                fab.classList.toggle('is-open', open);
                fab.setAttribute('aria-expanded', open);
                if (open && !loaded) { frame.src = url; loaded = true; }
            });
        }
    });
    </script>
    @stack('scripts')
</body>
</html>

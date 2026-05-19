<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') — PAPRA CMS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css'])
    @livewireStyles
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f1f5f9; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }

        .admin-wrapper { display: flex; min-height: 100vh; }
        .sidebar { width: 280px; background: #0f172a; display: flex; flex-direction: column; flex-shrink: 0; position: fixed; top: 0; left: 0; bottom: 0; z-index: 50; transition: transform .3s ease; }
        .sidebar-brand { padding: 20px 24px; border-bottom: 1px solid rgba(255,255,255,.06); display: flex; align-items: center; gap: 12px; }
        .sidebar-brand-icon { width: 38px; height: 38px; border-radius: 10px; background: linear-gradient(135deg, #6366f1, #8b5cf6); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 1rem; font-weight: 700; flex-shrink: 0; }
        .sidebar-brand-text { font-size: 1.05rem; font-weight: 700; color: #fff; letter-spacing: -.02em; }
        .sidebar-brand-badge { font-size: .6rem; font-weight: 600; color: #94a3b8; background: rgba(255,255,255,.06); padding: 2px 8px; border-radius: 4px; margin-left: auto; letter-spacing: .04em; text-transform: uppercase; }
        .sidebar-nav { flex: 1; overflow-y: auto; padding: 16px 12px 20px; }
        .sidebar-section { margin-bottom: 24px; }
        .sidebar-section-title { font-size: .65rem; font-weight: 600; text-transform: uppercase; letter-spacing: .1em; color: #475569; padding: 0 12px; margin-bottom: 6px; }
        .sidebar-link { display: flex; align-items: center; gap: 12px; padding: 10px 12px; border-radius: 8px; font-size: .87rem; font-weight: 500; color: #94a3b8; text-decoration: none; transition: all .15s; position: relative; }
        .sidebar-link:hover { background: rgba(255,255,255,.06); color: #e2e8f0; }
        .sidebar-link i { width: 20px; text-align: center; font-size: .95rem; flex-shrink: 0; }
        .sidebar-link.active { background: rgba(99,102,241,.15); color: #a5b4fc; }
        .sidebar-link.active::before { content: ''; position: absolute; left: 0; top: 50%; transform: translateY(-50%); width: 3px; height: 20px; border-radius: 0 3px 3px 0; background: #6366f1; }
        .sidebar-footer { padding: 16px 12px; border-top: 1px solid rgba(255,255,255,.06); }
        .sidebar-footer .sidebar-link { padding: 8px 12px; font-size: .82rem; }

        .main-area { flex: 1; margin-left: 280px; display: flex; flex-direction: column; min-height: 100vh; }
        .topbar { background: #fff; border-bottom: 1px solid #e2e8f0; padding: 0 32px; height: 64px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 40; }
        .topbar-left { display: flex; align-items: center; gap: 16px; }
        .topbar-menu-btn { display: none; background: none; border: none; font-size: 1.2rem; color: #475569; cursor: pointer; padding: 4px; }
        .topbar-search { display: flex; align-items: center; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 0 12px; height: 36px; width: 280px; }
        .topbar-search i { color: #94a3b8; font-size: .85rem; }
        .topbar-search input { border: none; background: none; outline: none; padding: 0 8px; font-size: .85rem; color: #1e293b; width: 100%; }
        .topbar-right { display: flex; align-items: center; gap: 8px; }
        .topbar-btn { width: 36px; height: 36px; border-radius: 8px; border: none; background: transparent; color: #64748b; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 1rem; transition: all .15s; position: relative; }
        .topbar-btn:hover { background: #f1f5f9; color: #1e293b; }
        .topbar-btn .dot { position: absolute; top: 6px; right: 6px; width: 8px; height: 8px; border-radius: 50%; background: #ef4444; border: 2px solid #fff; }
        .topbar-user { display: flex; align-items: center; gap: 10px; padding: 6px 10px 6px 6px; border-radius: 8px; cursor: pointer; transition: background .15s; text-decoration: none; margin-left: 8px; }
        .topbar-user:hover { background: #f1f5f9; }
        .topbar-user-avatar { width: 32px; height: 32px; border-radius: 8px; background: linear-gradient(135deg, #6366f1, #8b5cf6); color: #fff; display: flex; align-items: center; justify-content: center; font-size: .75rem; font-weight: 700; flex-shrink: 0; }
        .topbar-user-name { font-size: .85rem; font-weight: 600; color: #1e293b; }
        .topbar-user-role { font-size: .7rem; color: #94a3b8; }

        .page-content { padding: 32px; flex: 1; }

        .stat-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 32px; }
        .stat-card { background: #fff; border-radius: 12px; border: 1px solid #e2e8f0; padding: 24px; display: flex; align-items: center; gap: 16px; transition: all .2s; }
        .stat-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,.06); transform: translateY(-1px); }
        .stat-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0; }
        .stat-icon--indigo { background: #eef2ff; color: #6366f1; }
        .stat-icon--emerald { background: #ecfdf5; color: #10b981; }
        .stat-icon--amber { background: #fffbeb; color: #f59e0b; }
        .stat-icon--rose { background: #fff1f2; color: #e11d48; }
        .stat-icon--sky { background: #f0f9ff; color: #0ea5e9; }
        .stat-number { font-size: 1.75rem; font-weight: 800; color: #0f172a; line-height: 1.2; }
        .stat-label { font-size: .82rem; color: #64748b; margin-top: 2px; }

        .admin-table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; }
        .admin-table thead { background: #f8fafc; }
        .admin-table th { padding: 12px 16px; text-align: left; font-size: .72rem; font-weight: 600; text-transform: uppercase; letter-spacing: .05em; color: #64748b; border-bottom: 1px solid #e2e8f0; }
        .admin-table td { padding: 14px 16px; font-size: .87rem; color: #1e293b; border-bottom: 1px solid #f1f5f9; }
        .admin-table tbody tr:hover { background: #f8fafc; }
        .admin-table tbody tr:last-child td { border-bottom: none; }

        .badge { display: inline-flex; align-items: center; padding: 3px 10px; border-radius: 100px; font-size: .72rem; font-weight: 600; gap: 4px; }
        .badge--green { background: #dcfce7; color: #15803d; }
        .badge--red { background: #fef2f2; color: #b91c1c; }
        .badge--yellow { background: #fef9c3; color: #a16207; }
        .badge--gray { background: #f1f5f9; color: #475569; }
        .badge--blue { background: #dbeafe; color: #1d4ed8; }
        .badge--purple { background: #f3e8ff; color: #7c3aed; }

        .btn { display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 8px; font-size: .85rem; font-weight: 600; border: none; cursor: pointer; transition: all .15s; text-decoration: none; line-height: 1; }
        .btn--primary { background: #6366f1; color: #fff; }
        .btn--primary:hover { background: #4f46e5; }
        .btn--secondary { background: #f1f5f9; color: #475569; }
        .btn--secondary:hover { background: #e2e8f0; }
        .btn--success { background: #10b981; color: #fff; }
        .btn--success:hover { background: #059669; }
        .btn--danger { background: #ef4444; color: #fff; }
        .btn--danger:hover { background: #dc2626; }
        .btn--sm { padding: 6px 12px; font-size: .78rem; }
        .btn--xs { padding: 4px 8px; font-size: .72rem; border-radius: 6px; }
        .btn--ghost { background: transparent; color: #64748b; }
        .btn--ghost:hover { background: #f1f5f9; }

        .form-input { width: 100%; padding: 10px 14px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: .87rem; color: #1e293b; outline: none; transition: border-color .15s; background: #fff; }
        .form-input:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,.1); }
        .form-label { display: block; font-size: .82rem; font-weight: 600; color: #1e293b; margin-bottom: 6px; }
        .form-select { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 8L1 3h10z'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; padding-right: 36px; }

        .alert { padding: 14px 16px; border-radius: 8px; font-size: .85rem; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        .alert--success { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }
        .alert--error { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

        .modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,.5); backdrop-filter: blur(4px); z-index: 100; display: flex; align-items: center; justify-content: center; padding: 24px; }
        .modal { background: #fff; border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,.15); width: 100%; max-width: 640px; max-height: calc(100vh - 48px); overflow-y: auto; }
        .modal-header { padding: 20px 24px; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; }
        .modal-header h3 { font-size: 1.1rem; font-weight: 700; color: #0f172a; }
        .modal-close { background: none; border: none; font-size: 1.2rem; color: #94a3b8; cursor: pointer; padding: 4px; }
        .modal-close:hover { color: #475569; }
        .modal-body { padding: 24px; }
        .modal-footer { padding: 16px 24px; border-top: 1px solid #e2e8f0; display: flex; justify-content: flex-end; gap: 8px; }

        .pagination { display: flex; align-items: center; gap: 4px; margin-top: 20px; flex-wrap: wrap; }
        .pagination a, .pagination span { display: inline-flex; align-items: center; justify-content: center; min-width: 36px; height: 36px; padding: 0 8px; border-radius: 8px; font-size: .85rem; font-weight: 500; text-decoration: none; transition: all .15s; }
        .pagination a { color: #475569; background: #fff; border: 1px solid #e2e8f0; }
        .pagination a:hover { background: #f1f5f9; border-color: #cbd5e1; }
        .pagination span.active { background: #6366f1; color: #fff; border-color: #6366f1; }
        .pagination span.disabled { color: #cbd5e1; background: #f8fafc; border: 1px solid #f1f5f9; }

        .filter-bar { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; margin-bottom: 20px; }

        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-area { margin-left: 0; }
            .topbar-menu-btn { display: block; }
            .topbar-search { width: 200px; }
            .page-content { padding: 24px 20px; }
        }
        @media (max-width: 640px) {
            .topbar { padding: 0 16px; }
            .topbar-search { display: none; }
            .page-content { padding: 16px; }
            .stat-grid { grid-template-columns: 1fr 1fr; gap: 10px; }
            .stat-card { padding: 16px; }
            .stat-number { font-size: 1.3rem; }
        }
    </style>
</head>
<body>
    @php $routeName = request()->route()->getName(); @endphp
    <div class="admin-wrapper">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-brand">
                <div class="sidebar-brand-icon">P</div>
                <div class="sidebar-brand-text">PAPRA CMS</div>
                <span class="sidebar-brand-badge">v2.0</span>
            </div>
            <nav class="sidebar-nav">
                <div class="sidebar-section">
                    <div class="sidebar-section-title">Main</div>
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ $routeName === 'admin.dashboard' ? 'active' : '' }}"><i class="fas fa-th-large"></i> Dashboard</a>
                </div>
                <div class="sidebar-section">
                    <div class="sidebar-section-title">Frontend Menu</div>
                    <a href="{{ route('admin.materi') }}" class="sidebar-link {{ $routeName === 'admin.materi' ? 'active' : '' }}"><i class="fas fa-book"></i> Materi AMR</a>
                    <a href="{{ route('admin.events') }}" class="sidebar-link {{ str_starts_with($routeName, 'admin.events') ? 'active' : '' }}"><i class="fas fa-calendar-alt"></i> Aksi AMR</a>
                    <a href="{{ route('admin.pages', ['type' => 'tentang_kita_page']) }}" class="sidebar-link {{ $routeName === 'admin.pages' && request('type') === 'tentang_kita_page' ? 'active' : '' }}"><i class="fas fa-info-circle"></i> Tentang Kita</a>
                    <a href="{{ route('admin.posts') }}" class="sidebar-link {{ $routeName === 'admin.posts' ? 'active' : '' }}"><i class="fas fa-newspaper"></i> Artikel AMR</a>
                </div>
                <div class="sidebar-section">
                    <div class="sidebar-section-title">Events</div>
                    <a href="{{ route('admin.registrations') }}" class="sidebar-link {{ $routeName === 'admin.registrations' ? 'active' : '' }}"><i class="fas fa-clipboard-list"></i> Registrations</a>
                    <a href="{{ route('admin.donations') }}" class="sidebar-link {{ $routeName === 'admin.donations' ? 'active' : '' }}"><i class="fas fa-hand-holding-heart"></i> Donations</a>
                    <a href="{{ route('admin.banners') }}" class="sidebar-link {{ $routeName === 'admin.banners' ? 'active' : '' }}"><i class="fas fa-sliders-h"></i> Banners</a>
                </div>
                <div class="sidebar-section">
                    <div class="sidebar-section-title">Communication</div>
                    <a href="{{ route('admin.contact-messages') }}" class="sidebar-link {{ $routeName === 'admin.contact-messages' ? 'active' : '' }}"><i class="fas fa-envelope"></i> Messages</a>
                    <a href="{{ route('admin.users') }}" class="sidebar-link {{ $routeName === 'admin.users' ? 'active' : '' }}"><i class="fas fa-users"></i> Users</a>
                    <a href="{{ route('admin.settings') }}" class="sidebar-link {{ $routeName === 'admin.settings' ? 'active' : '' }}"><i class="fas fa-cog"></i> Settings</a>
                </div>
            </nav>
            <div class="sidebar-footer">
                <a href="{{ route('home') }}" class="sidebar-link"><i class="fas fa-arrow-left"></i> Back to Site</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="sidebar-link" style="width:100%;background:none;border:none;cursor:pointer;text-align:left;"><i class="fas fa-sign-out-alt"></i> Sign Out</button>
                </form>
            </div>
        </aside>

        <div class="main-area">
            <header class="topbar">
                <div class="topbar-left">
                    <button class="topbar-menu-btn" id="sidebarToggle"><i class="fas fa-bars"></i></button>
                    <div class="topbar-search">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search anything..." />
                        <span style="font-size:.7rem;color:#94a3b8;background:#f1f5f9;padding:2px 6px;border-radius:4px;">Ctrl+K</span>
                    </div>
                </div>
                <div class="topbar-right">
                    <button class="topbar-btn" title="Notifications"><i class="fas fa-bell"></i><span class="dot"></span></button>
                    <button class="topbar-btn" title="Messages"><i class="fas fa-envelope"></i></button>
                    <a href="{{ route('home') }}" class="topbar-btn" title="View Site" target="_blank"><i class="fas fa-external-link-alt"></i></a>
                    <div style="width:1px;height:28px;background:#e2e8f0;margin:0 8px;"></div>
                    <a href="{{ route('admin.users') }}" class="topbar-user" style="text-decoration:none;">
                        <div class="topbar-user-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
                        <div>
                            <div class="topbar-user-name">{{ auth()->user()->name ?? 'Admin' }}</div>
                            <div class="topbar-user-role">{{ auth()->user()->role === 'admin' ? 'Administrator' : 'User' }}</div>
                        </div>
                    </a>
                </div>
            </header>
            <main class="page-content">
                @if(session('message'))
                    <div class="alert alert--success"><i class="fas fa-check-circle"></i> {{ session('message') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert--error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
                @endif
                {{ $slot }}
            </main>
        </div>
    </div>
    <div id="sidebarOverlay" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.4);z-index:49;" onclick="closeSidebar()"></div>
    <script>
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('sidebarOverlay').style.display = 'none';
        document.body.style.overflow = '';
    }
    document.addEventListener('DOMContentLoaded', function() {
        var toggle = document.getElementById('sidebarToggle');
        var sidebar = document.getElementById('sidebar');
        var overlay = document.getElementById('sidebarOverlay');
        if (toggle && sidebar) {
            toggle.addEventListener('click', function() {
                var open = sidebar.classList.toggle('open');
                overlay.style.display = open ? 'block' : 'none';
                document.body.style.overflow = open ? 'hidden' : '';
            });
        }
        window.addEventListener('resize', function() {
            if (window.innerWidth > 1024) {
                sidebar.classList.remove('open');
                overlay.style.display = 'none';
                document.body.style.overflow = '';
            }
        });
    });
    </script>
    @livewireScripts
</body>
</html>

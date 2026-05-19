<div>
    <div class="page-header">
        <h1>Dashboard</h1>
        <p>Selamat datang kembali, {{ auth()->user()->name }}! Berikut ringkasan sistem Anda.</p>
    </div>

    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-icon stat-icon--indigo"><i class="fas fa-file-lines"></i></div>
            <div>
                <div class="stat-number">{{ $totalPages }}</div>
                <div class="stat-label">Total Pages</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon stat-icon--emerald"><i class="fas fa-cogs"></i></div>
            <div>
                <div class="stat-number">{{ $totalServices }}</div>
                <div class="stat-label">Total Services</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon stat-icon--amber"><i class="fas fa-briefcase"></i></div>
            <div>
                <div class="stat-number">{{ $totalPortfolios }}</div>
                <div class="stat-label">Total Portfolios</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon stat-icon--rose"><i class="fas fa-newspaper"></i></div>
            <div>
                <div class="stat-number">{{ $totalPosts }}</div>
                <div class="stat-label">Total Posts</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon stat-icon--purple"><i class="fas fa-users"></i></div>
            <div>
                <div class="stat-number">{{ $totalUsers }}</div>
                <div class="stat-label">Total Users</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon stat-icon--sky"><i class="fas fa-calendar-alt"></i></div>
            <div>
                <div class="stat-number">{{ $totalEvents ?? 0 }}</div>
                <div class="stat-label">Total Events</div>
            </div>
        </div>
    </div>
</div>

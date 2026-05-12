<div>
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Dashboard Overview</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center gap-4 hover:shadow-md transition">
            <div class="w-14 h-14 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-file text-blue-600 text-2xl"></i>
            </div>
            <div>
                <div class="text-3xl font-bold text-gray-900">{{ $totalPages }}</div>
                <p class="text-gray-500 text-sm">Total Pages</p>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center gap-4 hover:shadow-md transition">
            <div class="w-14 h-14 rounded-xl bg-green-50 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-cogs text-green-600 text-2xl"></i>
            </div>
            <div>
                <div class="text-3xl font-bold text-gray-900">{{ $totalServices }}</div>
                <p class="text-gray-500 text-sm">Total Services</p>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center gap-4 hover:shadow-md transition">
            <div class="w-14 h-14 rounded-xl bg-indigo-50 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-briefcase text-indigo-600 text-2xl"></i>
            </div>
            <div>
                <div class="text-3xl font-bold text-gray-900">{{ $totalPortfolios }}</div>
                <p class="text-gray-500 text-sm">Total Portfolios</p>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center gap-4 hover:shadow-md transition">
            <div class="w-14 h-14 rounded-xl bg-red-50 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-newspaper text-red-600 text-2xl"></i>
            </div>
            <div>
                <div class="text-3xl font-bold text-gray-900">{{ $totalPosts }}</div>
                <p class="text-gray-500 text-sm">Total Posts</p>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center gap-4 hover:shadow-md transition">
            <div class="w-14 h-14 rounded-xl bg-purple-50 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-users text-purple-600 text-2xl"></i>
            </div>
            <div>
                <div class="text-3xl font-bold text-gray-900">{{ $totalUsers }}</div>
                <p class="text-gray-500 text-sm">Total Users</p>
            </div>
        </div>
    </div>
</div>

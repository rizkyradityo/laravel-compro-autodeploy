<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Company Profile CMS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100">
    @php
        $routeName = request()->route()->getName();
    @endphp
    <div class="flex h-screen">
        {{-- Sidebar --}}
        <div class="w-64 bg-white border-r border-gray-200 flex flex-col flex-shrink-0">
            <div class="flex items-center p-4 border-b border-gray-200">
                <span class="font-semibold text-lg">Company CMS</span>
            </div>
            <nav class="flex-1 mt-4 space-y-1 px-3">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition {{ $routeName === 'admin.dashboard' ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-100' }}">
                    <i class="fas fa-tachometer-alt w-5"></i> Dashboard
                </a>
                <a href="{{ route('admin.pages') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition {{ $routeName === 'admin.pages' ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-100' }}">
                    <i class="fas fa-file w-5"></i> Pages
                </a>
                <a href="{{ route('admin.services') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition {{ $routeName === 'admin.services' ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-100' }}">
                    <i class="fas fa-cogs w-5"></i> Services
                </a>
                <a href="{{ route('admin.portfolios') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition {{ $routeName === 'admin.portfolios' ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-100' }}">
                    <i class="fas fa-briefcase w-5"></i> Portfolios
                </a>
                <a href="{{ route('admin.posts') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition {{ $routeName === 'admin.posts' ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-100' }}">
                    <i class="fas fa-newspaper w-5"></i> Posts
                </a>
                <a href="{{ route('admin.media') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition {{ $routeName === 'admin.media' ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-100' }}">
                    <i class="fas fa-image w-5"></i> Media
                </a>
                <a href="{{ route('admin.contact-messages') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition {{ $routeName === 'admin.contact-messages' ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-100' }}">
                    <i class="fas fa-envelope w-5"></i> Messages
                </a>
                <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition {{ $routeName === 'admin.users' ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-100' }}">
                    <i class="fas fa-users w-5"></i> Users
                </a>
                <hr class="my-2 border-gray-200">
                <a href="{{ route('home') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition">
                    <i class="fas fa-arrow-left w-5"></i> Back to Site
                </a>
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50 transition w-full">
                        <i class="fas fa-sign-out-alt w-5"></i> Logout
                    </button>
                </form>
            </nav>
        </div>
        {{-- Main Content --}}
        <div class="flex-1 overflow-y-auto">
            <div class="px-6 pt-4 pb-2 border-b border-gray-200 bg-white">
                <div class="flex justify-between items-center">
                    <div class="text-xl font-bold text-gray-800">Company Profile CMS</div>
                </div>
            </div>
            <main class="p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
    @livewireScripts
</body>
</html>
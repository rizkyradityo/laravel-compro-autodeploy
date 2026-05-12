<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Company Profile CMS</title>
    @livewireStyles
</head>
<body class="bg-gray-100">
    @php
        $routeName = request()->routeName();
    @endphp
    <div class="flex">
        {{-- Sidebar --}}
        <div class="w-64 bg-white border-r border-gray-200 flex flex-col">
            <div class="flex items-center p-4 border-b border-gray-200">
                <img src="/images/logo.svg" alt="Logo" class="h-10 w-10 object-cover rounded-full mr-3"/>
                <span class="font-semibold text-lg">Company CMS</span>
            </div>
            <nav class="flex-1 mt-4 space-y-2">
                <Livewire:admin.dashboard :active="'dashboard'" />
                <Livewire:admin/pages/index />
                <Livewire:admin/services/index />
                <Livewire:admin/portfolios/index />
                <Livewire:admin/posts/index />
                <Livewire:admin/media/index />
                <Livewire:admin/contact-messages />
                <hr class="my-2 border-gray-200" />
                <Livewire:admin/users/> {{-- optional --}}
            </nav>
        </div>
        {{-- Main Content --}}
        <div class="flex-1 overflow-hidden">
            <div class="flex flex-col h-full">
                <div class="px-6 pt-4 pb-2 border-b border-gray-200"><!-- Topbar -->
                    <div class="flex justify-between items-center">
                        <div class="text-xl font-bold text-gray-800">Company Profile CMS</div>
                        <div class="flex items-center space-x-4">
                            {{-- User dropdown, notifications, etc. --}}
                            <div class="rounded-full" title="User Profile">
                                <img src="https://via.placeholder.com/30" class="w-8 h-8 rounded-full" alt="User">
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Content Placeholder --}}
                <main class="flex-1 overflow-y-auto py-4" id="content">
                    @slot('content')
                    @endslot
                </main>
            </div>
        </div>
    </div>
    @livewireScripts
</body>
</html>
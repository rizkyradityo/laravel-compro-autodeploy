<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Company Profile CMS')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-slate-100">
    <!-- Background accents -->
    <div class="pointer-events-none fixed inset-0 -z-10">
        <div class="absolute -top-24 left-1/2 h-72 w-72 -translate-x-1/2 rounded-full bg-emerald-500/20 blur-3xl"></div>
        <div class="absolute top-1/3 -left-24 h-72 w-72 rounded-full bg-teal-400/10 blur-3xl"></div>
        <div class="absolute bottom-0 right-0 h-80 w-80 rounded-full bg-emerald-400/10 blur-3xl"></div>
    </div>
    <!-- Navigation -->
    <nav class="sticky top-0 z-40 border-b border-white/10 bg-slate-950/70 backdrop-blur">
        <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-emerald-400/50 to-transparent"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center">
                    <img src="/assets/logo.png" alt="Logo" class="h-8 w-auto" onerror="this.style.display='none'">
                    <span class="text-xl font-bold tracking-tight text-white">Company</span>
                    <span class="ml-2 rounded-full bg-emerald-500/15 px-2 py-0.5 text-xs font-semibold text-emerald-300 ring-1 ring-emerald-400/20">CMS</span>
                </a>
                
                <div class="hidden md:flex items-center gap-2">
                    <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition @if(request()->routeIs('home')) bg-emerald-500/15 text-emerald-200 ring-1 ring-emerald-400/30 @else text-slate-200 hover:bg-white/5 hover:text-white @endif">Home</a>
                    <a href="{{ route('services') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition @if(request()->routeIs('services')) bg-emerald-500/15 text-emerald-200 ring-1 ring-emerald-400/30 @else text-slate-200 hover:bg-white/5 hover:text-white @endif">Services</a>
                    <a href="{{ route('portfolio') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition @if(request()->routeIs('portfolio')) bg-emerald-500/15 text-emerald-200 ring-1 ring-emerald-400/30 @else text-slate-200 hover:bg-white/5 hover:text-white @endif">Portfolio</a>
                    <a href="{{ route('blog.index') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition @if(request()->routeIs('blog.*')) bg-emerald-500/15 text-emerald-200 ring-1 ring-emerald-400/30 @else text-slate-200 hover:bg-white/5 hover:text-white @endif">Blog</a>
                    <a href="{{ route('contact') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition @if(request()->routeIs('contact')) bg-emerald-500/15 text-emerald-200 ring-1 ring-emerald-400/30 @else text-slate-200 hover:bg-white/5 hover:text-white @endif">Contact</a>
                </div>

                <div class="md:hidden">
                    <button id="mobile-menu-btn" class="text-slate-200 hover:text-white">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-white/10">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" class="block rounded-lg px-3 py-2 text-slate-200 hover:bg-white/5 hover:text-white">Home</a>
                <a href="{{ route('services') }}" class="block rounded-lg px-3 py-2 text-slate-200 hover:bg-white/5 hover:text-white">Services</a>
                <a href="{{ route('portfolio') }}" class="block rounded-lg px-3 py-2 text-slate-200 hover:bg-white/5 hover:text-white">Portfolio</a>
                <a href="{{ route('blog.index') }}" class="block rounded-lg px-3 py-2 text-slate-200 hover:bg-white/5 hover:text-white">Blog</a>
                <a href="{{ route('contact') }}" class="block rounded-lg px-3 py-2 text-slate-200 hover:bg-white/5 hover:text-white">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('message'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="rounded-xl border border-emerald-400/20 bg-emerald-500/10 px-4 py-3 text-emerald-200">
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>

    <!-- Footer -->
    <footer class="border-t border-white/10 bg-slate-950 text-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-lg font-semibold mb-4">About Company</h3>
                    <p class="text-gray-400 text-sm mb-4">
                        We deliver quality services and innovative solutions to help your business grow. Contact us today to discuss your project.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white">Home</a></li>
                        <li><a href="{{ route('services') }}" class="text-gray-400 hover:text-white">Services</a></li>
                        <li><a href="{{ route('portfolio') }}" class="text-gray-400 hover:text-white">Portfolio</a></li>
                        <li><a href="{{ route('blog.index') }}" class="text-gray-400 hover:text-white">Blog</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact Info</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><i class="fas fa-envelope mr-2"></i> info@company.com</li>
                        <li><i class="fas fa-phone mr-2"></i> +1 (555) 123-4567</li>
                        <li><i class="fas fa-map-marker-alt mr-2"></i>123 Business St, City</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-white/10 mt-8 pt-8 text-center text-slate-400">
                <p class="text-sm">&copy; {{ date('Y') }} Company. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
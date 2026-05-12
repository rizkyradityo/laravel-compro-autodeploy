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
<body class="bg-gray-50 text-gray-800">
    <!-- Navigation -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center">
                    <img src="/assets/logo.png" alt="Logo" class="h-8 w-auto" onerror="this.style.display='none'">
                    <span class="text-xl font-bold text-indigo-600">Company</span>
                </a>
                
                <div class="hidden md:flex space-x-8">
                    <a href="{{ route('home') }}" class="@if(request()->routeIs('home')) text-indigo-600 @else text-gray-700 @endif hover:text-indigo-600 px-3 py-2">Home</a>
                    <a href="{{ route('services') }}" class="@if(request()->routeIs('services')) text-indigo-600 @else text-gray-700 @endif hover:text-indigo-600 px-3 py-2">Services</a>
                    <a href="{{ route('portfolio') }}" class="@if(request()->routeIs('portfolio')) text-indigo-600 @else text-gray-700 @endif hover:text-indigo-600 px-3 py-2">Portfolio</a>
                    <a href="{{ route('blog.index') }}" class="@if(request()->routeIs('blog.*')) text-indigo-600 @else text-gray-700 @endif hover:text-indigo-600 px-3 py-2">Blog</a>
                    <a href="{{ route('contact') }}" class="@if(request()->routeIs('contact')) text-indigo-600 @else text-gray-700 @endif hover:text-indigo-600 px-3 py-2">Contact</a>
                </div>

                <div class="md:hidden">
                    <button id="mobile-menu-btn" class="text-gray-600 hover:text-indigo-600">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-gray-200">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" class="block px-3 py-2 text-gray-700 hover:bg-gray-50">Home</a>
                <a href="{{ route('services') }}" class="block px-3 py-2 text-gray-700 hover:bg-gray-50">Services</a>
                <a href="{{ route('portfolio') }}" class="block px-3 py-2 text-gray-700 hover:bg-gray-50">Portfolio</a>
                <a href="{{ route('blog.index') }}" class="block px-3 py-2 text-gray-700 hover:bg-gray-50">Blog</a>
                <a href="{{ route('contact') }}" class="block px-3 py-2 text-gray-700 hover:bg-gray-50">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('message'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white">
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
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
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
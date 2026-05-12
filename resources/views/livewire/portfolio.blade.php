-- Portfolio page content

<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900">Our Portfolio</h1>
            <p class="text-gray-600 mt-4 max-w-2xl mx-auto">
                Explore our collection of successful projects and see how we've helped our clients achieve their goals.
            </p>
        </div>

        <!-- Portfolio Grid -->
        @if($portfolios->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($portfolios as $portfolio)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow group">
                        <div class="relative overflow-hidden">
                            @if($portfolio->media)
                                <img src="{{ $portfolio->media->url }}" alt="{{ $portfolio->title }}" class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-64 bg-indigo-600 flex items-center justify-center">
                                    <i class="fas fa-briefcase text-white text-6xl"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <div class="text-white text-center p-4">
                                    <h3 class="text-xl font-semibold mb-2">{{ $portfolio->title }}</h3>
                                    <p class="text-sm">{{ Str::limit($portfolio->description, 100) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-briefcase text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg">No portfolio items available yet.</p>
            </div>
        @endif

        <!-- Stats Section -->
        <div class="mt-16 bg-indigo-600 rounded-lg shadow-lg p-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="text-white">
                    <div class="text-4xl font-bold mb-2">50+</div>
                    <div class="text-indigo-200">Projects Completed</div>
                </div>
                <div class="text-white">
                    <div class="text-4xl font-bold mb-2">30+</div>
                    <div class="text-indigo-200">Happy Clients</div>
                </div>
                <div class="text-white">
                    <div class="text-4xl font-bold mb-2">5+</div>
                    <div class="text-indigo-200">Years Experience</div>
                </div>
                <div class="text-white">
                    <div class="text-4xl font-bold mb-2">100%</div>
                    <div class="text-indigo-200">Client Satisfaction</div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="mt-16 text-center">
            <div class="bg-white rounded-lg shadow-md p-8 max-w-3xl mx-auto">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Want to see more?</h2>
                <p class="text-gray-600 mb-6">
                    The projects shown above are just a sample of our work. Contact us to discuss your project requirements.
                </p>
                <a href="{{ route('contact') }}" class="inline-block bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700">
                    Start Your Project
                </a>
            </div>
        </div>
    </div>
</div>
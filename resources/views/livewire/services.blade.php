-- Services page content

<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900">Our Services</h1>
            <p class="text-gray-600 mt-4 max-w-2xl mx-auto">
                We offer a comprehensive range of services to help your business grow and succeed in the digital world.
            </p>
        </div>

        <!-- Services Grid -->
        @if($services->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($services as $service)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                        @if($service->media_id)
                            <img src="{{ $service->media->url }}" alt="{{ $service->name }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-indigo-600 flex items-center justify-center">
                                <i class="fas fa-cogs text-white text-6xl"></i>
                            </div>
                        @endif
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $service->name }}</h3>
                            <p class="text-gray-600">{{ $service->description }}</p>
                            @if($service->meta_description)
                                <p class="text-sm text-gray-500 mt-2">{{ Str::limit($service->meta_description, 150) }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-tools text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg">No services available at the moment.</p>
            </div>
        @endif

        <!-- CTA Section -->
        <div class="mt-16 text-center">
            <div class="bg-white rounded-lg shadow-md p-8 max-w-3xl mx-auto">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Need a custom solution?</h2>
                <p class="text-gray-600 mb-6">
                    Have a project in mind? Contact us to discuss how we can tailor our services to meet your specific needs.
                </p>
                <a href="{{ route('contact') }}" class="inline-block bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700">
                    Get in Touch
                </a>
            </div>
        </div>
    </div>
</div>
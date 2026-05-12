<div>
    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-bold tracking-tight text-white">Our Services</h1>
        <p class="mt-4 max-w-2xl mx-auto text-slate-300">
            We offer a comprehensive range of services to help your business grow and succeed in the digital world.
        </p>
    </div>

    @if($services->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
                <div class="group rounded-2xl border border-white/10 bg-white/5 overflow-hidden shadow-sm hover:shadow-emerald-500/10 hover:border-emerald-400/30 transition">
                    @if($service->media_id)
                        <img src="{{ $service->media->url }}" alt="{{ $service->name }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center">
                            <i class="fas fa-cogs text-white text-6xl"></i>
                        </div>
                    @endif
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-white mb-2 group-hover:text-emerald-300 transition">{{ $service->name }}</h3>
                        <p class="text-slate-300">{{ $service->description }}</p>
                        @if($service->meta_description)
                            <p class="text-sm text-slate-400 mt-2">{{ Str::limit($service->meta_description, 150) }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-16">
            <i class="fas fa-tools text-6xl text-slate-600 mb-4"></i>
            <p class="text-slate-400 text-lg">No services available at the moment.</p>
        </div>
    @endif

    <div class="mt-16 text-center">
        <div class="rounded-2xl border border-white/10 bg-white/5 p-8 max-w-3xl mx-auto">
            <h2 class="text-2xl font-bold text-white mb-4">Need a custom solution?</h2>
            <p class="text-slate-300 mb-6">
                Have a project in mind? Contact us to discuss how we can tailor our services to meet your specific needs.
            </p>
            <a href="{{ route('contact') }}" class="inline-flex items-center justify-center rounded-xl bg-emerald-500 px-8 py-3 font-semibold text-slate-950 hover:bg-emerald-400 transition">
                Get in Touch
            </a>
        </div>
    </div>
</div>

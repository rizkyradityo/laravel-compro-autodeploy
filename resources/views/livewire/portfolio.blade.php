<div>
    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-bold tracking-tight text-white">Our Portfolio</h1>
        <p class="mt-4 max-w-2xl mx-auto text-slate-300">
            Explore our collection of successful projects and see how we've helped our clients achieve their goals.
        </p>
    </div>

    @if($portfolios->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($portfolios as $portfolio)
                <div class="group rounded-2xl border border-white/10 bg-white/5 overflow-hidden shadow-sm hover:shadow-emerald-500/10 hover:border-emerald-400/30 transition">
                    <div class="relative overflow-hidden">
                        @if($portfolio->media)
                            <img src="{{ $portfolio->media->url }}" alt="{{ $portfolio->title }}" class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-full h-64 bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center">
                                <i class="fas fa-briefcase text-white text-6xl"></i>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <div class="text-white text-center p-4">
                                <h3 class="text-xl font-semibold mb-2">{{ $portfolio->title }}</h3>
                                <p class="text-sm text-slate-200">{{ Str::limit($portfolio->description, 100) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-semibold text-white group-hover:text-emerald-300 transition">{{ $portfolio->title }}</h3>
                        <p class="text-sm text-slate-300 mt-1">{{ Str::limit($portfolio->description, 80) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-16">
            <i class="fas fa-briefcase text-6xl text-slate-600 mb-4"></i>
            <p class="text-slate-400 text-lg">No portfolio items available yet.</p>
        </div>
    @endif

    <div class="mt-16 rounded-2xl border border-white/10 bg-gradient-to-br from-emerald-500/10 to-teal-500/10 p-8 text-center">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div>
                <div class="text-4xl font-bold text-emerald-400 mb-2">50+</div>
                <div class="text-slate-300">Projects Completed</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-emerald-400 mb-2">30+</div>
                <div class="text-slate-300">Happy Clients</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-emerald-400 mb-2">5+</div>
                <div class="text-slate-300">Years Experience</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-emerald-400 mb-2">100%</div>
                <div class="text-slate-300">Client Satisfaction</div>
            </div>
        </div>
    </div>

    <div class="mt-16 text-center">
        <div class="rounded-2xl border border-white/10 bg-white/5 p-8 max-w-3xl mx-auto">
            <h2 class="text-2xl font-bold text-white mb-4">Want to see more?</h2>
            <p class="text-slate-300 mb-6">
                The projects shown above are just a sample of our work. Contact us to discuss your project requirements.
            </p>
            <a href="{{ route('contact') }}" class="inline-flex items-center justify-center rounded-xl bg-emerald-500 px-8 py-3 font-semibold text-slate-950 hover:bg-emerald-400 transition">
                Start Your Project
            </a>
        </div>
    </div>
</div>

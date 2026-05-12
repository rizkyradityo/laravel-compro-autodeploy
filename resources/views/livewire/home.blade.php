<div>
    @if($homePage)
        <section class="relative overflow-hidden pb-16">
            <div class="pointer-events-none absolute inset-0 -z-10">
                <div class="absolute -top-24 left-1/2 h-96 w-96 -translate-x-1/2 rounded-full bg-emerald-500/20 blur-3xl"></div>
            </div>
            <div class="text-center pt-16 pb-12">
                <h1 class="text-5xl md:text-6xl font-bold tracking-tight text-white mb-6">{!! $homePage->title !!}</h1>
                <p class="text-lg md:text-xl text-slate-300 max-w-3xl mx-auto">{!! $homePage->content !!}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
                @foreach($featuredServices as $service)
                    <div class="group rounded-2xl border border-white/10 bg-white/5 p-6 hover:border-emerald-400/30 hover:shadow-lg hover:shadow-emerald-500/5 transition">
                        <div class="w-12 h-12 rounded-xl bg-emerald-500/15 flex items-center justify-center mb-4">
                            <i class="fas fa-cogs text-emerald-400 text-xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">{!! $service->name !!}</h3>
                        <p class="text-slate-300 text-sm">{!! $service->description !!}</p>
                    </div>
                @endforeach
            </div>

            @if($latestPortfolios->count() > 0)
                <div class="mt-16">
                    <h2 class="text-3xl font-bold text-white mb-8 text-center">Recent Work</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        @foreach($latestPortfolios as $portfolio)
                            <div class="group rounded-2xl border border-white/10 bg-white/5 overflow-hidden hover:border-emerald-400/30 transition">
                                <div class="relative overflow-hidden">
                                    @php($mediaUrl = $portfolio->media ? asset($portfolio->media->file_path) : null)
                                    @if($mediaUrl)
                                        <img src="{{ $mediaUrl }}" alt="{!! $portfolio->title !!}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div class="w-full h-48 bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center">
                                            <i class="fas fa-briefcase text-white text-5xl"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-5">
                                    <h4 class="font-semibold text-white mb-1">{!! $portfolio->title !!}</h4>
                                    <p class="text-sm text-slate-300">{!! Str::limit($portfolio->description, 100) !!}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($latestPosts->count() > 0)
                <div class="mt-16">
                    <h2 class="text-3xl font-bold text-white mb-8 text-center">Latest Blog Posts</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        @foreach($latestPosts as $post)
                            <a href="{{ route('blog.show', $post->slug) }}" class="group rounded-2xl border border-white/10 bg-white/5 p-6 hover:border-emerald-400/30 hover:shadow-lg hover:shadow-emerald-500/5 transition">
                                <div class="flex items-center gap-2 text-sm text-slate-400 mb-3">
                                    <i class="fas fa-calendar"></i>
                                    <span>{{ $post->created_at->format('M d, Y') }}</span>
                                </div>
                                <h5 class="font-semibold text-white mb-2 group-hover:text-emerald-300 transition">{{ $post->title }}</h5>
                                <p class="text-sm text-slate-300">{{ Str::limit($post->content, 120) }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </section>

        <section class="border-t border-white/10 py-16 text-center">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-3xl font-bold text-white mb-4">About Us</h2>
                <p class="text-slate-300 text-lg">{!! $homePage ? $homePage->content : 'Our company ...' }}</p>
            </div>
        </section>

        <section class="border-t border-white/10 py-16">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-white mb-8">Contact Us</h2>
                <livewire:contact-form />
            </div>
        </section>
    @endif
</div>

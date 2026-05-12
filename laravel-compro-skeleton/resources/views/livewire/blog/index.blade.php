<div>
    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-bold tracking-tight text-white">Blog</h1>
        <p class="mt-4 max-w-2xl mx-auto text-slate-300">
            Stay updated with the latest news, insights, and industry trends.
        </p>
    </div>

    <div class="mb-8 max-w-2xl mx-auto">
        <div class="relative">
            <input type="text" wire:model="search" 
                   class="w-full px-4 py-3 rounded-xl border border-white/10 bg-white/5 text-white placeholder-slate-400 focus:ring-2 focus:ring-emerald-500 focus:border-transparent" 
                   placeholder="Search articles...">
            <button wire:click="resetSearch" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-slate-400 hover:text-white transition" wire:loading.attr="disabled">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>

    @if($posts->count() > 0 && $posts->currentPage() == 1)
        @php($featured = $posts->first())
        <div class="mb-12 rounded-2xl border border-white/10 bg-white/5 overflow-hidden hover:border-emerald-400/30 transition">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="relative">
                    @if($featured->media)
                        <img src="{{ $featured->media->url }}" alt="{{ $featured->title }}" class="w-full h-64 md:h-full object-cover">
                    @else
                        <div class="w-full h-64 md:h-full bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center">
                            <i class="fas fa-newspaper text-white text-6xl"></i>
                        </div>
                    @endif
                    <div class="absolute top-4 left-4 bg-emerald-500 text-slate-950 px-3 py-1 rounded-lg text-sm font-semibold">
                        Featured
                    </div>
                </div>
                <div class="p-8 flex flex-col justify-center">
                    <div class="flex items-center gap-4 text-sm text-slate-400 mb-4">
                        <span><i class="fas fa-user mr-1"></i> {{ $featured->user->name }}</span>
                        <span><i class="fas fa-calendar mr-1"></i> {{ $featured->created_at->format('M d, Y') }}</span>
                    </div>
                    <h2 class="text-3xl font-bold text-white mb-4">{{ $featured->title }}</h2>
                    <p class="text-slate-300 mb-6">{{ Str::limit($featured->content, 200) }}</p>
                    <a href="{{ route('blog.show', $featured->slug) }}" class="inline-flex items-center justify-center rounded-xl bg-emerald-500 px-6 py-2 font-semibold text-slate-950 hover:bg-emerald-400 self-start transition">
                        Read More
                    </a>
                </div>
            </div>
        </div>
    @endif

    @if($posts->count() > 1)
        <h3 class="text-2xl font-bold text-white mb-8">Recent Articles</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posts->slice(1) as $post)
                <div class="group rounded-2xl border border-white/10 bg-white/5 overflow-hidden hover:border-emerald-400/30 hover:shadow-lg hover:shadow-emerald-500/5 transition">
                    <div class="relative">
                        @if($post->media)
                            <img src="{{ $post->media->url }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-slate-700 to-slate-600 flex items-center justify-center">
                                <i class="fas fa-newspaper text-slate-400 text-4xl"></i>
                            </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-4 text-sm text-slate-400 mb-3">
                            <span><i class="fas fa-calendar mr-1"></i> {{ $post->created_at->format('M d, Y') }}</span>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2 group-hover:text-emerald-300 transition">{{ $post->title }}</h3>
                        <p class="text-slate-300 mb-4">{{ Str::limit($post->content, 100) }}</p>
                        <a href="{{ route('blog.show', $post->slug) }}" class="text-emerald-400 hover:text-emerald-300 font-medium transition">
                            Read More <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    @elseif($search && $posts->count() == 0)
        <div class="text-center py-16">
            <i class="fas fa-search text-6xl text-slate-600 mb-4"></i>
            <p class="text-slate-400 text-lg">No articles found matching "{{ $search }}"</p>
        </div>
    @endif
</div>

<div>
    <a href="{{ route('blog.index') }}" class="inline-flex items-center text-emerald-400 hover:text-emerald-300 mb-8 transition">
        <i class="fas fa-arrow-left mr-2"></i> Back to Blog
    </a>

    <article class="rounded-2xl border border-white/10 bg-white/5 overflow-hidden">
        @if($post->media)
            <img src="{{ $post->media->url }}" alt="{{ $post->title }}" class="w-full h-64 md:h-96 object-cover">
        @else
            <div class="w-full h-64 md:h-96 bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center">
                <i class="fas fa-newspaper text-white text-6xl"></i>
            </div>
        @endif

        <div class="p-8">
            <div class="flex items-center gap-4 text-sm text-slate-400 mb-4">
                <span class="flex items-center">
                    <i class="fas fa-user mr-1"></i> {{ $post->user->name }}
                </span>
                <span class="flex items-center">
                    <i class="fas fa-calendar mr-1"></i> {{ $post->created_at->format('M d, Y') }}
                </span>
            </div>

            <h1 class="text-3xl md:text-4xl font-bold text-white mb-6">{{ $post->title }}</h1>

            <div class="text-slate-300 leading-relaxed">
                {!! $post->content !!}
            </div>

            <div class="mt-8 pt-8 border-t border-white/10">
                <p class="text-sm text-slate-400"></p>
            </div>
        </div>
    </article>

    @if($relatedPosts->count() > 0)
        <div class="mt-16">
            <h2 class="text-2xl font-bold text-white mb-8">Related Posts</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($relatedPosts as $relatedPost)
                    <a href="{{ route('blog.show', $relatedPost->slug) }}" class="group rounded-2xl border border-white/10 bg-white/5 overflow-hidden hover:border-emerald-400/30 transition">
                        @if($relatedPost->media)
                            <img src="{{ $relatedPost->media->url }}" alt="{{ $relatedPost->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-slate-700 to-slate-600 flex items-center justify-center">
                                <i class="fas fa-newspaper text-slate-400 text-4xl"></i>
                            </div>
                        @endif
                        <div class="p-4">
                            <h3 class="font-semibold text-white mb-2 group-hover:text-emerald-300 transition">{{ $relatedPost->title }}</h3>
                            <span class="text-emerald-400 hover:text-emerald-300 text-sm font-medium transition">
                                Read More <i class="fas fa-arrow-right ml-1"></i>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <div class="mt-16 rounded-2xl border border-white/10 bg-gradient-to-br from-emerald-500/10 to-teal-500/10 p-8 text-center">
        <h2 class="text-2xl font-bold text-white mb-4">Enjoyed this article?</h2>
        <p class="text-slate-300 mb-6">Share it with your friends or contact us for more updates.</p>
        <div class="flex justify-center gap-4">
            <button onclick="sharePost('{{ route('blog.show', $post->slug) }}')" class="inline-flex items-center justify-center rounded-xl bg-emerald-500 px-6 py-2 font-semibold text-slate-950 hover:bg-emerald-400 transition">
                <i class="fas fa-share-alt mr-2"></i> Share
            </button>
            <a href="{{ route('contact') }}" class="inline-flex items-center justify-center rounded-xl border border-emerald-500/30 px-6 py-2 font-semibold text-emerald-300 hover:bg-emerald-500/10 transition">
                <i class="fas fa-envelope mr-2"></i> Contact Us
            </a>
        </div>
    </div>

    <script>
        function sharePost(url) {
            if (navigator.share) {
                navigator.share({
                    title: '{{ $post->title }}',
                    text: 'Check out this interesting article!',
                    url: url
                });
            } else {
                navigator.clipboard.writeText(url).then(() => {
                    alert('Link copied to clipboard!');
                });
            }
        }
    </script>
</div>

-- Individual blog post page content

<div class="bg-gray-50 py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Back Button -->
        <a href="{{ route('blog.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 mb-8">
            <i class="fas fa-arrow-left mr-2"></i> Back to Blog
        </a>

        <!-- Post Content -->
        <article class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Featured Image -->
            @if($post->media)
                <img src="{{ $post->media->url }}" alt="{{ $post->title }}" class="w-full h-64 md:h-96 object-cover">
            @else
                <div class="w-full h-64 md:h-96 bg-indigo-600 flex items-center justify-center">
                    <i class="fas fa-newspaper text-white text-6xl"></i>
                </div>
            @endif

            <div class="p-8">
                <!-- Meta Info -->
                <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                    <span class="flex items-center">
                        <i class="fas fa-user mr-1"></i> {{ $post->user->name }}
                    </span>
                    <span class="flex items-center">
                        <i class="fas fa-calendar mr-1"></i> {{ $post->created_at->format('M d, Y') }}
                    </span>
                </div>

                <!-- Title -->
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">{{ $post->title }}</h1>

                <!-- Content -->
                <div class="prose max-w-none text-gray-700 leading-relaxed">
                    {!! $post->content !!}
                </div>

                <!-- Tags/Categories (if needed) -->
                <div class="mt-8 pt-8 border-t border-gray-200">
                    <p class="text-sm text-gray-500">
                        <!-- Can add tags/categories here if needed -->
                    </p>
                </div>
            </div>
        </article>

        <!-- Related Posts -->
        @if($relatedPosts->count() > 0)
            <div class="mt-16">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Related Posts</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedPosts as $relatedPost)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                            @if($relatedPost->media)
                                <img src="{{ $relatedPost->media->url }}" alt="{{ $relatedPost->title }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-newspaper text-gray-400 text-4xl"></i>
                                </div>
                            @endif
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-900 mb-2">{{ $relatedPost->title }}</h3>
                                <a href="{{ route('blog.show', $relatedPost->slug) }}" class="text-indigo-600 hover:text-indigo-800 text-sm">
                                    Read More ->
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Share/Subscribe CTA -->
        <div class="mt-16 bg-indigo-600 rounded-lg shadow-lg p-8 text-center">
            <h2 class="text-2xl font-bold text-white mb-4">Enjoyed this article?</h2>
            <p class="text-indigo-100 mb-6">Share it with your friends or subscribe to our newsletter for more updates.</p>
            <div class="flex justify-center gap-4">
                <button onclick="sharePost('{{ route('blog.show', $post->slug) }}')" class="bg-white text-indigo-600 px-6 py-2 rounded-lg font-semibold hover:bg-gray-100">
                    <i class="fas fa-share-alt mr-2"></i> Share
                </button>
                <a href="{{ route('contact') }}" class="bg-indigo-800 text-white px-6 py-2 rounded-lg font-semibold hover:bg-indigo-900">
                    <i class="fas fa-envelope mr-2"></i> Contact Us
                </a>
            </div>
        </div>
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
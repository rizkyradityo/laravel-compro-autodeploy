-- Blog index page content

<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900">Blog</h1>
            <p class="text-gray-600 mt-4 max-w-2xl mx-auto">
                Stay updated with the latest news, insights, and industry trends.
            </p>
        </div>

        <!-- Search -->
        <div class="mb-8 max-w-2xl mx-auto">
            <div class="relative">
                <input type="text" wire:model="search" 
                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                       placeholder="Search articles...">
                <button wire:click="resetSearch" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600" wire:loading.attr="disabled">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>

        <!-- Featured Post -->
        @if($posts->count() > 0 && $posts->currentPage() == 1)
            <div class="mb-12">
                @php($featured = $posts->first())
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="relative">
                            @if($featured->media)
                                <img src="{{ $featured->media->url }}" alt="{{ $featured->title }}" class="w-full h-64 md:h-full object-cover">
                            @else
                                <div class="w-full h-64 md:h-full bg-indigo-600 flex items-center justify-center">
                                    <i class="fas fa-newspaper text-white text-6xl"></i>
                                </div>
                            @endif
                            <div class="absolute top-4 left-4 bg-indigo-600 text-white px-3 py-1 rounded text-sm">
                                Featured
                            </div>
                        </div>
                        <div class="p-8 flex flex-col justify-center">
                            <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                                <span><i class="fas fa-user mr-1"></i> {{ $featured->user->name }}</span>
                                <span><i class="fas fa-calendar mr-1"></i> {{ $featured->created_at->format('M d, Y') }}</span>
                            </div>
                            <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ $featured->title }}</h2>
                            <p class="text-gray-600 mb-6">{{ Str::limit($featured->content, 200) }}</p>
                            <a href="{{ route('blog.show', $featured->slug) }}" class="inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-indigo-700 self-start">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Posts Grid -->
        @if($posts->count() > 1)
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Recent Articles</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($posts->slice(1) as $post)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                        <div class="relative">
                            @if($post->media)
                                <img src="{{ $post->media->url }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-newspaper text-gray-400 text-4xl"></i>
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-4 text-sm text-gray-500 mb-3">
                                <span><i class="fas fa-calendar mr-1"></i> {{ $post->created_at->format('M d, Y') }}</span>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $post->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($post->content, 100) }}</p>
                            <a href="{{ route('blog.show', $post->slug) }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                                Read More ->
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        @elseif($search && $posts->count() == 0)
            <div class="text-center py-12">
                <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg">No articles found matching "{{ $search }}"</p>
            </div>
        @endif
    </div>
</div>
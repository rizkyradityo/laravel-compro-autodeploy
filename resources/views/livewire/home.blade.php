<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profile</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body class="bg-gray-100">
    {{-- Hero Section --}}
    @if($homePage)
        <section class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-20">
            <div class="container mx-auto px-4">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">{!! $homePage->title !!}</h1>
                <p class="text-lg md:text-xl mb-8">{!! $homePage->content !!}</p>
                {{-- Services Highlight --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
                    @foreach($featuredServices as $service)
                        <div class="bg-white text-center p-6 rounded-lg shadow hover:scale-105 transition-transform">
                            <div class="mb-3"><!-- Icon placeholder --} -->

                            </div>
                            <h3 class="text-xl font-semibold">{!! $service->name !!}</h3>
                            <p class="mt-2 text-gray-600">{!! $service->description !!}</p>
                        </div>
                    @endforeach
                </div>
                {{-- Latest Portfolio Highlights --}}
                <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($latestPortfolios as $portfolio)
                        <div class="bg-white p-4 rounded-lg shadow hover:scale-105 transition-transform">
                            <img src="{{ 
                                \App\Models\Media::find($portfolio->media_id)?->file_path ?
                                \App\Models\Media::find($portfolio->media_id)->file_path : '/images/placeholder.jpg'
                            }}" alt="{!! $portfolio->title !!}" class="w-full h-48 object-cover rounded mb-2"/>
                            <h4 class="font-semibold">{!! $portfolio->title !!}</h4>
                            <p class="text-sm text-gray-600">{!! $portfolio->description !!}</p>
                        </div>
                    @endforeach
                </div>
                {{-- Latest Blog Posts --}}
                <div class="mt-12">
                    <h3 class="text-2xl font-semibold mb-4">Latest Blog Posts</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach($latestPosts as $post)
                            <a href="{{ route('blog.show', $post->slug) }}" class="block bg-white p-4 rounded-lg shadow hover:shadow-lg">
                                <h5 class="font-medium">{{ $post->title }}</h5>
                                <p class="text-sm text-gray-600 mt-1">{!! Str::limit($post->content, 100) !!}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- About Summary (if separate page) --}}
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4 max-w-3xl">
            <h2 class="text-3xl font-bold mb-6">About Us</h2>
            <p class="text-lg text-gray-700">{!! $homePage ? $homePage->content : 'Our company ...' }}</p>
        </div>
    </section>

    {{-- Contact Form --}}
    <section class="bg-gray-50 py-12">
        <div class="container mx-auto px-4 max-w-3xl">
            <h2 class="text-3xl font-bold mb-6">Contact Us</h2>
            <livewire:contact-form />
        </div>
    </section>
</body>
</html>
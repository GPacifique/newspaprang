<x-app-layout>

@php
    $latestArticles = $latestArticles ?? collect();
    $trending = $trending ?? collect();
    $breakingNews = $breakingNews ?? collect();
    $featured = $featured ?? null;
@endphp

<!-- ================= BREAKING NEWS BAR ================= -->
<div class="bg-red-600 text-white text-sm overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 py-2 whitespace-nowrap animate-pulse">
        🔴 Breaking:
        @foreach($breakingNews as $news)
            <span class="mx-4">
                {{ $news->title }} •
            </span>
        @endforeach
    </div>
</div>
<x-article-ticker/>

<!-- ================= HERO SECTION ================= -->
<section class="max-w-7xl mx-auto px-4 mt-6 grid lg:grid-cols-3 gap-6">

    <!-- FEATURED -->
    <div class="lg:col-span-2 bg-white border rounded shadow-sm overflow-hidden">

        @if($featured)

            @if($featured->featured_image)
                <img src="{{ asset('articles/' . $featured->featured_image) }}"
                     class="w-full h-96 object-cover"
                     alt="{{ $featured->title }}">
            @endif

            <div class="p-5">
                <span class="text-red-600 font-semibold text-sm">FEATURED</span>

                <h1 class="text-2xl font-bold mt-2">
                    {{ $featured->title }}
                </h1>

                <p class="text-gray-600 mt-3">
                    {{ Str::limit($featured->content, 180) }}
                </p>

                <a href="{{ route('articles.show', $featured->slug) }}"
                   class="inline-block mt-4 text-red-600 font-semibold hover:underline">
                    Read more →
                </a>
            </div>

        @else
            <div class="p-5 text-gray-500">
                No featured article available
            </div>
        @endif

    </div>

    <!-- TRENDING SIDEBAR -->
    <aside class="bg-white border rounded p-4">

        <h2 class="font-bold border-b pb-2 mb-3">Trending</h2>

        @forelse($trending as $item)
            <div class="flex gap-3 border-b py-3 last:border-none">

                @if($item->featured_image)
                    <img src="{{ asset('articles/' . $item->featured_image) }}"
                         class="w-16 h-16 object-cover rounded">
                @endif

                <div>
                    <a href="{{ route('articles.show', $item->slug) }}"
                       class="text-sm font-semibold hover:text-red-600">
                        {{ Str::limit($item->title, 60) }}
                    </a>
                </div>

            </div>
        @empty
            <p class="text-sm text-gray-500">No trending news</p>
        @endforelse

    </aside>

</section>

<!-- ================= LATEST NEWS GRID ================= -->
<section class="max-w-7xl mx-auto px-4 mt-10">

    <h2 class="text-xl font-bold border-b pb-2 mb-4">
        Latest News
    </h2>

    <div class="grid md:grid-cols-4 gap-5">

        @forelse($latestArticles as $article)
            <div class="bg-white border rounded overflow-hidden hover:shadow transition">

                @if($article->featured_image)
                    <img src="{{ asset('articles/' . $article->featured_image) }}"
                         class="w-full h-40 object-cover">
                @endif

                <div class="p-3">
                    <h3 class="text-sm font-semibold">
                        <a href="{{ route('articles.show', $article->slug) }}"
                           class="hover:text-red-600">
                            {{ Str::limit($article->title, 70) }}
                        </a>
                    </h3>
                </div>

            </div>
        @empty
            <p class="text-gray-500">No news available</p>
        @endforelse

    </div>

</section>

</x-app-layout>
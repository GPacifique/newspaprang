<x-app-layout>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Umwambi.com| Latest News from Rwanda|Africa|</title>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Portal - Rwanda Style</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .ticker {
            animation: scroll 25s linear infinite;
        }

        @keyframes scroll {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900">
   
@php
    $latestArticles = $latestArticles ?? collect();
    $trending = $trending ?? collect();
    $breakingNews = $breakingNews ?? collect();
    $featured = $featured ?? null;

    $entertainment = $entertainment ?? collect();
    $health = $health ?? collect();
    $education = $education ?? collect();
    $politics = $politics ?? collect();
    $sports = $sports ?? collect();
    $business = $business ?? collect();
    $technology = $technology ?? collect();

    $tenders = $tenders ?? collect();
    $announcements = $announcements ?? collect();
    $advertisements = $advertisements ?? collect();
@endphp

<!-- ================= HERO ================= -->
<section class="max-w-7xl mx-auto mt-6 px-4 grid lg:grid-cols-3 gap-6">

    <!-- MAIN FEATURE -->
    <div class="lg:col-span-2 bg-white rounded shadow overflow-hidden">

        @if($featured)
            @if($featured->featured_image)
                <img src="{{ asset('storage/' . $featured->featured_image) }}"
                     class="w-full h-96 object-cover" alt="{{ $featured->title }}">
            @endif

            <div class="p-5">
                <h1 class="text-2xl font-bold">
                    {{ $featured->title ?? 'Latest News' }}
                </h1>

                <p class="text-gray-600 mt-3">
                    {{ Str::limit($featured->content ?? '', 200) }}
                </p>

                @if($featured->slug)
                    <a href="{{ route('articles.show', $featured->slug) }}"
                       class="inline-block mt-4 bg-red-600 text-white px-4 py-2 rounded">
                        Soma byinshi
                    </a>
                @endif
            </div>
        @else
            <div class="p-5 text-center text-gray-500">
                <p>No featured article available</p>
            </div>
        @endif
    </div>

    <!-- SIDEBAR TRENDING -->
    <div class="bg-white p-4 rounded shadow">

        <h2 class="font-bold mb-3">Trending</h2>

        @forelse($trending as $item)
            <div class="border-b py-2">
                @if($item->slug)
                    <a href="{{ route('articles.show', $item->slug) }}"
                       class="text-sm hover:text-red-600 block">
                        {{ Str::limit($item->title, 40) }}
                    </a>
                @else
                    <span class="text-sm text-gray-500 block">
                        {{ Str::limit($item->title, 40) }}
                    </span>
                @endif
            </div>
        @empty
            <p class="text-sm text-gray-500">No trending articles</p>
        @endforelse

    </div>

</section>

<!-- ================= ADS ================= -->
<section class="max-w-7xl mx-auto mt-6 px-4">

    <div class="grid md:grid-cols-3 gap-4">

        @forelse($advertisements as $ad)
            @if($ad->featured_image)
                <div class="bg-white shadow rounded overflow-hidden">
                    <img src="{{ $ad->featured_image }}" class="w-full h-40 object-cover" alt="{{ $ad->title }}">
                </div>
            @endif
        @empty
            <!-- No ads available -->
        @endforelse

    </div>

</section>

<!-- ================= CATEGORY BLOCKS ================= -->
<section class="max-w-7xl mx-auto mt-10 px-4 space-y-8">

@foreach([
    'Latest' => $latestArticles,
    'Breaking' => $breakingNews,
    'featured' => $featured ? collect([$featured]) : collect(),
    'Trending' => $trending,
    'Announcements' => $announcements,
    'Politics' => $politics,
    'Sports' => $sports,
    'Entertainment' => $entertainment,
    'Health' => $health,
    'Education' => $education,
    'Business' => $business,
    'Technology' => $technology,
] as $title => $items)

<div class="bg-white p-5 rounded shadow">

    <h2 class="text-xl font-bold mb-4 border-b pb-2">
        {{ $title }}
    </h2>

    <div class="grid md:grid-cols-4 gap-4">

        @forelse($items as $article)

            <div class="border rounded p-2 hover:shadow">

                @if($article->featured_image)
                    <img src="{{ asset('storage/' . $article->featured_image) }}" class="w-full h-32 object-cover rounded" alt="{{ $article->title }}">     
                        
                @endif

                @if($article->slug)
                    <a href="{{ route('articles.show', $article->slug) }}"
                       class="text-sm font-semibold mt-2 block hover:text-red-600">
                        {{ Str::limit($article->title, 60) }}
                    </a>
                @else
                    <h3 class="font-semibold mt-2 text-sm text-gray-400">
                        {{ Str::limit($article->title, 60) }}
                    </h3>
                @endif

            </div>

        @empty
            <p class="text-gray-500">No news</p>
        @endforelse

    </div>

</div>

@endforeach

</section>

<!-- ================= TENDERS ================= -->
<section class="max-w-7xl mx-auto mt-10 px-4">

    <div class="bg-white p-5 rounded shadow">

        <h2 class="text-xl font-bold mb-4">Tenders</h2>

        @forelse($tenders as $tender)
            <div class="border-b py-2">
                <h3 class="font-semibold">{{ $tender->title }}</h3>
                <p class="text-sm text-gray-500">Deadline: {{ $tender->end_date ? $tender->end_date->format('M d, Y') : 'No deadline' }}</p>
            </div>
        @empty
            <p class="text-sm text-gray-500">No tenders available</p>
        @endforelse

    </div>

</section>
<!-- ================= ANNOUNCEMENTS ================= -->
<section class="max-w-7xl mx-auto mt-10 px-4">

    <div class="bg-white p-5 rounded shadow">

        <h2 class="text-xl font-bold mb-4">Announcements</h2>

        @forelse($announcements as $announcement)
            <div class="border-b py-2">
                <h3 class="font-semibold">{{ $announcement->title }}</h3>
                <p class="text-sm text-gray-500">{{ $announcement->content }}</p>
            </div>
        @empty
            <p class="text-sm text-gray-500">No announcements available</p>
        @endforelse

    </div>

</section>  
<!-- ================= NEWSLETTER ================= -->
<section class="bg-red-600 text-white mt-10 py-10 text-center">

    <h2 class="text-2xl font-bold">Subscribe</h2>
    <p>Get breaking news updates</p>

    <input type="email" class="mt-4 p-2 text-black rounded" placeholder="Email">
    <button class="bg-black px-4 py-2 rounded">Subscribe</button>

</section>

<!-- ================= FOOTER ================= -->
<footer class="bg-black text-white text-center p-5 mt-10">
    <p>&copy; {{ date('Y') }} RwandaNews. All rights reserved.</p>
</footer>

</body>
</html>
</x-app-layout>
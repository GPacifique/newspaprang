<!DOCTYPE html>
<html lang="en">
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

<!-- ================= NAVBAR ================= -->
<header class="bg-black text-white sticky top-0 z-50 shadow">

    <div class="max-w-7xl mx-auto flex justify-between items-center p-4">

        <div class="text-2xl font-bold text-red-500">
            RwandaNews
        </div>

        <nav class="hidden md:flex space-x-5 text-sm">
            <a href="/" class="hover:text-red-400">Home</a>
            <a href="/category/politics">Politiki</a>
            <a href="/category/sports">Siporo</a>
            <a href="/category/entertainment">Imyidagaduro</a>
            <a href="/category/health">Ubuzima</a>
            <a href="/category/business">Ubukungu</a>
            <a href="/category/technology">Tech</a>
        </nav>

    </div>

    <!-- Breaking Ticker -->
    <div class="bg-red-600 text-white overflow-hidden whitespace-nowrap">
        <div class="ticker px-4 py-1 text-sm">
            @foreach($breakingNews as $news)
                🔴 {{ $news->title }} &nbsp;&nbsp;&nbsp;
            @endforeach
        </div>
    </div>

</header>

<!-- ================= HERO ================= -->
<section class="max-w-7xl mx-auto mt-6 px-4 grid lg:grid-cols-3 gap-6">

    <!-- MAIN FEATURE -->
    <div class="lg:col-span-2 bg-white rounded shadow overflow-hidden">

        @if($featured && $featured->featured_image)
            <img src="{{ asset('storage/'.$featured->featured_image) }}"
                 class="w-full h-96 object-cover">
        @endif

        <div class="p-5">
            <h1 class="text-2xl font-bold">
                {{ $featured->title ?? 'Latest News' }}
            </h1>

            <p class="text-gray-600 mt-3">
                {{ Str::limit($featured->content ?? '', 200) }}
            </p>

            @if($featured)
                <a href="{{ route('articles.show', $featured->slug) }}"
                   class="inline-block mt-4 bg-red-600 text-white px-4 py-2 rounded">
                    Soma byinshi
                </a>
            @endif
        </div>
    </div>

    <!-- SIDEBAR TRENDING -->
    <div class="bg-white p-4 rounded shadow">

        <h2 class="font-bold mb-3">Trending</h2>

        @foreach($trending as $item)
            <div class="border-b py-2">
                <a href="{{ route('articles.show', $item->slug) }}"
                   class="text-sm hover:text-red-600">
                    {{ $item->title }}
                </a>
            </div>
        @endforeach

    </div>

</section>

<!-- ================= ADS ================= -->
<section class="max-w-7xl mx-auto mt-6 px-4">

    <div class="grid md:grid-cols-3 gap-4">

        @foreach($advertisements as $ad)
            <div class="bg-white shadow rounded overflow-hidden">
                <img src="{{ asset('storage/'.$ad->image) }}" class="w-full h-40 object-cover">
            </div>
        @endforeach

    </div>

</section>

<!-- ================= CATEGORY BLOCKS ================= -->
<section class="max-w-7xl mx-auto mt-10 px-4 space-y-8">

@foreach([
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
                    <img src="{{ asset('storage/'.$article->featured_image) }}"
                         class="w-full h-32 object-cover rounded">
                @endif

                <h3 class="font-semibold mt-2 text-sm">
                    {{ Str::limit($article->title, 60) }}
                </h3>

                @if($item->slug)
    <a href="{{ route('articles.show', $item->slug) }}"
       class="text-sm hover:text-red-600">
        {{ $item->title }}
    </a>
@else
    <span class="text-sm text-gray-400">
        {{ $item->title }}
    </span>
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

        @foreach($tenders as $tender)
            <div class="border-b py-2">
                <h3 class="font-semibold">{{ $tender->title }}</h3>
                <p class="text-sm text-gray-500">Deadline: {{ $tender->end_date ?? '' }}</p>
            </div>
        @endforeach

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
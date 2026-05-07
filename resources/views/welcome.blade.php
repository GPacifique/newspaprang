<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News CMS - Rwanda News Portal</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900">

<!-- ================= NAVBAR ================= -->
<header class="bg-black text-white shadow">

    <div class="max-w-7xl mx-auto flex justify-between items-center p-4">

        <!-- LOGO -->
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center text-xs font-bold">
                RN
            </div>
            <span class="font-bold text-lg">Rwanda News</span>
        </div>

        <!-- NAV LINKS -->
        <nav class="hidden md:flex space-x-6 text-sm">
            <a href="/" class="hover:text-red-400">Home</a>
            <a href="/category/politics">Politics</a>
            <a href="/category/sports">Sports</a>
            <a href="/category/technology">Tech</a>
            <a href="/category/business">Business</a>
        </nav>

        <!-- AUTH -->
        <div class="text-sm">
            @auth
                <a href="{{ route('dashboard') }}" class="text-red-400">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="mr-3">Login</a>
                <a href="{{ route('register') }}" class="bg-red-600 px-3 py-1 rounded">
                    Register
                </a>
            @endauth
        </div>

    </div>
</header>

<!-- ================= HERO FEATURE ================= -->
<section class="max-w-7xl mx-auto mt-6 px-4">

    @if($featured ?? null)
        <div class="bg-white rounded shadow overflow-hidden">

            @if($featured->featured_image)
                <img src="{{ $featured->featured_image }}"
                     class="w-full h-96 object-cover">
            @endif

            <div class="p-6">
                <h1 class="text-3xl font-bold">
                    {{ $featured->title }}
                </h1>

                <p class="text-gray-600 mt-3">
                    {{ Str::limit($featured->content, 200) }}
                </p>

                <a href="{{ route('articles.show', $featured->slug) }}"
                   class="inline-block mt-4 bg-red-600 text-white px-4 py-2 rounded">
                    Read More
                </a>
            </div>

        </div>
    @endif

</section>

<!-- ================= TRENDING ================= -->
<section class="max-w-7xl mx-auto mt-10 px-4">

    <h2 class="text-xl font-bold mb-4">Trending News</h2>

    <div class="grid md:grid-cols-4 gap-4">

        @foreach($trending ?? [] as $article)
            <div class="bg-white rounded shadow p-3 hover:shadow-lg">

                @if($article->featured_image)
                    <img src="{{ $article->featured_image }}"
                         class="h-32 w-full object-cover rounded">
                @endif

                <h3 class="mt-2 font-semibold text-sm">
                    {{ Str::limit($article->title, 60) }}
                </h3>

                <a href="{{ route('articles.show', $article->slug) }}"
                   class="text-red-600 text-xs mt-2 block">
                    Read more
                </a>

            </div>
        @endforeach

    </div>

</section>

<!-- ================= CATEGORIES ================= -->
<section class="max-w-7xl mx-auto mt-10 px-4">

    <div class="grid md:grid-cols-3 gap-6">

        @foreach($categories ?? [] as $category)

            <div class="bg-white p-4 rounded shadow">

                <h3 class="font-bold text-lg border-b pb-2">
                    {{ $category->name }}
                </h3>

                <ul class="mt-3 space-y-2 text-sm">

                    @foreach($category->articles->take(4) as $article)
                        <li>
                            <a href="{{ route('articles.show', $article->slug) }}"
                               class="hover:text-red-600">
                                {{ Str::limit($article->title, 50) }}
                            </a>
                        </li>
                    @endforeach

                </ul>

            </div>

        @endforeach

    </div>

</section>

<!-- ================= FOOTER ================= -->
<footer class="bg-black text-white text-center p-5 mt-10">
    <p>&copy; {{ date('Y') }} Rwanda News CMS</p>
</footer>

</body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Umwambi News') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Tailwind CDN fallback (optional remove if using Vite only) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-900">

<!-- ================= HEADER ================= -->
<header class="bg-white border-b sticky top-0 z-50 shadow-sm">

    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">

        <!-- Logo -->
        <a href="{{ url('/') }}" class="text-2xl font-bold text-red-600">
            Umwambi
        </a>

          <nav class="hidden md:flex space-x-5 text-sm">
                <a href="/" class="hover:text-red-400">Ahabanza</a>

                <a href="{{ route('categories.show', 'politics') }}">Politiki</a>
                <a href="{{ route('categories.show', 'sports') }}">Siporo</a>
                <a href="{{ route('categories.show', 'world') }}">Isi</a>
                <a href="{{ route('categories.show', 'science') }}">Ikoranabuhanga</a>
                <a href="{{ route('categories.show', 'technology') }}">Tech</a>
                <a href="{{ route('categories.show', 'lifestyle') }}">Ubuzima bwiza</a>
                <a href="{{ route('categories.show', 'entertainment') }}">Imyidagaduro</a>
                <a href="{{ route('categories.show', 'health') }}">Ubuzima</a>
                <a href="{{ route('categories.show', 'business') }}">Ubukungu</a>
                <a href="{{ route('categories.show', 'culture') }}">Umuco</a>
            </nav>

        <!-- Search -->
        <form class="hidden md:block">
            <input type="text"
                   placeholder="Search news..."
                   class="border rounded px-3 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-red-500">
        </form>

    </div>
</header>

<!-- ================= FLASH MESSAGES ================= -->
@if(session('success'))
    <div class="max-w-7xl mx-auto mt-4 px-4">
        <div class="bg-green-100 text-green-700 p-3 rounded">
            {{ session('success') }}
        </div>
    </div>
@endif

@if(session('error'))
    <div class="max-w-7xl mx-auto mt-4 px-4">
        <div class="bg-red-100 text-red-700 p-3 rounded">
            {{ session('error') }}
        </div>
    </div>
@endif

<!-- ================= PAGE CONTENT ================= -->
<main class="min-h-screen">
    {{ $slot }}
</main>

<!-- ================= FOOTER ================= -->
<footer class="bg-black text-white mt-12">

    <div class="max-w-7xl mx-auto px-4 py-8 grid md:grid-cols-3 gap-6">

        <div>
            <h3 class="font-bold text-lg text-red-500">Umwambi News</h3>
            <p class="text-sm text-gray-300 mt-2">
                Latest news from Rwanda, Africa and the world.
            </p>
        </div>

        <div>
            <h4 class="font-semibold mb-2">Sections</h4>
            <ul class="text-sm space-y-1 text-gray-300">
                <li>Politics</li>
                <li>Business</li>
                <li>Sports</li>
                <li>Technology</li>
            </ul>
        </div>

        <div>
            <h4 class="font-semibold mb-2">Contact</h4>
            <p class="text-sm text-gray-300">
                Email: info@umwambi.com<br>
                Kigali, Rwanda
            </p>
        </div>

    </div>

    <div class="text-center text-sm py-4 border-t border-gray-700">
        &copy; {{ date('Y') }} Umwambi News. All rights reserved.
    </div>

</footer>

</body>
</html>
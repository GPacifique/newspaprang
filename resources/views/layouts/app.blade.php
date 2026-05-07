<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Portal - Rwanda Style</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('images/logo-umwambi.jpeg') }}" type="image/jpeg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"> 
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
                <x-header/>
               

<body class="bg-green-100 text-gray-900 font-[Inter]">
<x-article-ticker />
    <!-- NAVBAR -->
    <header class="bg-green-100 text-black sticky top-0 z-50 shadow">
        <div class="max-w-7xl mx-auto flex justify-between items-center p-4">
            <div class="flex items-center space-x-3">
    <a href="/" class="flex items-center space-x-2">

        <!-- Logo Frame -->
        <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-white-hadow-md bg-white flex items-center justify-center">
            <img 
                src="{{ asset('images/logo-umwambi.jpeg') }}" 
                alt="Umwambi Logo"
                class="w-full h-full object-cover"
            >
        </div>

        <!-- Site Name -->
        <span class="text-xl font-bold text-red-500 tracking-wide">
            Umwambi.com
        </span>

    </a>

</div>
<div class="flex items-center gap-6">
   
       
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
        </div>
         <!-- language switcher -->
        <div class="relative group">
    <button class="flex items-center gap-2 bg-white text-black px-3 py-2 rounded shadow text-sm">
        🌍 Language
    </button>

    <div class="absolute right-0 hidden group-hover:block bg-white shadow-lg rounded mt-2 w-48 z-50">

        <a href="{{ route('language.switch', 'rw') }}"
           class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100">
            🇷🇼 Kinyarwanda
        </a>

        <a href="{{ route('language.switch', 'fr') }}"
           class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100">
            🇫🇷 Français
        </a>

        <a href="{{ route('language.switch', 'en') }}"
           class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100">
            🇬🇧 English
        </a>

        <a href="{{ route('language.switch', 'sw') }}"
           class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100">
            🇰🇪 Swahili
        </a>

    </div>
</div>
</div>
    </header>

    <!-- CATEGORY HEADER -->
    @if(isset($category) && $category)
        <div class="max-w-7xl mx-auto mt-6 px-4">
            <div class="bg-white rounded shadow p-6">
                <h1 class="text-3xl font-bold text-gray-900">
                    {{ $category->name }}
                </h1>

                @if($category->description)
                    <p class="text-gray-600 mt-2">
                        {{ $category->description }}
                    </p>
                @endif
            </div>
        </div>
    @endif

    <!-- PAGE CONTENT -->
    <main>
        {{ $slot }}
    </main>

</body>
</html>
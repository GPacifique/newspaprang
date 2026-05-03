<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Umwambi.com|| – Amakuru mashya kandi yizewe yo mu Rwanda n’amahanga, harimo politiki, imyidagaduro, ubukungu n’inkuru zigezweho buri munsi.</title>

    <!-- SEO (basic) -->
    <meta name="description" content="Latest news, politics, sports and business updates">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans">



<!-- 🧭 Navbar -->
<header class="bg-black shadow">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center"> 
            <div class="logo">
    <x-application-logo />
</div>
        </a>

        <!-- Navigation -->
        <nav class="hidden md:flex space-x-6 text-gray-700 font-medium">
            <a href="/" class="hover:text-green-600">Ahabanza</a>
            <a href="/category/politics" class="hover:text-green-600">Politiki</a>
            <a href="/category/education" class="hover:text-green-600">Uburezi</a>
            <a href="/category/sports" class="hover:text-green-600">Siporo</a>
            <a href="/category/business" class="hover:text-green-600">Ubukungu</a>        
            <a href="/category/health"   class="hover:text-green-600">Ubuzima</a>
            <a href="/category/technology" class="hover:text-green-600">Ikoranabuhanga</a>
            <a href="/category/entertainment" class="hover:text-green-600">Imyidagaduro</a>
            <a
        </nav>


    </div>
</header>
<x-article-ticker />
<!-- 📢 Flash Messages -->
@if(session('success'))
    <div class="max-w-7xl mx-auto px-4 mt-4">
        <div class="bg-green-100 text-green-700 p-3 rounded">
            {{ session('success') }}
        </div>
    </div>
@endif

@if(session('error'))
    <div class="max-w-7xl mx-auto px-4 mt-4">
        <div class="bg-red-100 text-red-700 p-3 rounded">
            {{ session('error') }}
        </div>
    </div>
@endif
<main>
        {{ $slot }}
    </main>
<!-- 📄 Main Content -->
<main class="py-6">
    @yield('content')
</main>

<x-footer/>

</body>
</html>
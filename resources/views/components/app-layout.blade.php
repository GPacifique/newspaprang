<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Umwambi.com - Amakuru mashya kandi yizewe yo mu Rwanda n'amahanga</title>

    <!-- SEO (basic) -->
    <meta name="description" content="Latest news, politics, sports and business updates">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans">

<!-- 🧭 Navbar -->
<header class="bg-black shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <div class="logo">
            <a href="/" class="text-2xl font-bold text-white hover:text-gray-300">
                RwandaNews
            </a>
        </div>

        <!-- Navigation -->
        <nav class="hidden md:flex space-x-6 text-gray-300 font-medium">
            <a href="/" class="hover:text-red-500 transition">Ahabanza</a>
            <a href="/category/politics" class="hover:text-red-500 transition">Politiki</a>
            <a href="/category/education" class="hover:text-red-500 transition">Uburezi</a>
            <a href="/category/sports" class="hover:text-red-500 transition">Siporo</a>
            <a href="/category/business" class="hover:text-red-500 transition">Ubukungu</a>
            <a href="/category/health" class="hover:text-red-500 transition">Ubuzima</a>
            <a href="/category/technology" class="hover:text-red-500 transition">Ikoranabuhanga</a>
            <a href="/category/entertainment" class="hover:text-red-500 transition">Imyidagaduro</a>
        </nav>
    </div>
</header>

<!-- 📢 Flash Messages -->
@if(session('success'))
    <div class="max-w-7xl mx-auto px-4 mt-4">
        <div class="bg-green-100 text-green-700 p-3 rounded border border-green-400">
            {{ session('success') }}
        </div>
    </div>
@endif

@if(session('error'))
    <div class="max-w-7xl mx-auto px-4 mt-4">
        <div class="bg-red-100 text-red-700 p-3 rounded border border-red-400">
            {{ session('error') }}
        </div>
    </div>
@endif

<!-- 📄 Main Content -->
<main class="py-6">
    {{ $slot }}
</main>

<!-- 📄 Footer -->
<footer class="bg-black text-white text-center p-5 mt-10">
    <p>&copy; {{ date('Y') }} RwandaNews. All rights reserved.</p>
</footer>

</body>
</html>

```blade
<x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>

    {{-- FONT AWESOME --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

    {{-- GOOGLE FONT --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    <style>
        body{
            font-family: 'Inter', sans-serif;
        }

        .glass{
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(10px);
        }

        .card-hover{
            transition: all .3s ease;
        }

        .card-hover:hover{
            transform: translateY(-6px);
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-100 via-gray-100 to-blue-100 min-h-screen">

<div class="flex">

    {{-- SIDEBAR --}}
    <aside class="w-72 bg-slate-900 text-white min-h-screen hidden lg:block">

        <div class="p-6 border-b border-slate-800">
            <div class="flex items-center gap-3">
                <x-application-logo class="w-12 h-12 fill-current text-blue-400" />

                <div>
                    <h1 class="font-bold text-xl">News Admin</h1>
                    <p class="text-sm text-slate-400">Control Center</p>
                </div>
            </div>
        </div>

        <nav class="p-5 space-y-2">

            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl bg-blue-600 text-white">
                <i class="fas fa-home"></i>
                Dashboard
            </a>

            <a href="{{ route('articles.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">
                <i class="fas fa-newspaper"></i>
                Articles
            </a>

            <a href="{{ route('categories.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">
                <i class="fas fa-list"></i>
                Categories
            </a>

            <a href="{{ route('users.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">
                <i class="fas fa-users"></i>
                Users
            </a>

            <a href="{{ route('comments.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">
                <i class="fas fa-comments"></i>
                Comments
            </a>

            <a href="{{ route('media.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">
                <i class="fas fa-photo-video"></i>
                Media
            </a>

            <a href="{{ route('analytics.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">
                <i class="fas fa-chart-line"></i>
                Analytics
            </a>

            <a href="{{ route('settings.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">
                <i class="fas fa-cog"></i>
                Settings
            </a>

        </nav>

        <div class="absolute bottom-0 w-72 p-5 border-t border-slate-800">

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                        class="w-full bg-red-500 hover:bg-red-600 py-3 rounded-xl font-semibold transition">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    Logout
                </button>
            </form>

        </div>

    </aside>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 p-6">

        {{-- TOPBAR --}}
        <div class="glass rounded-3xl p-6 shadow-lg mb-8">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <h1 class="text-4xl font-extrabold text-slate-800">
                        👑 Admin Dashboard
                    </h1>

                    <p class="text-gray-500 mt-2">
                        Welcome back, manage your platform professionally.
                    </p>
                </div>

                <div class="flex items-center gap-4">

                    <div class="bg-white px-5 py-3 rounded-2xl shadow">
                        <p class="text-sm text-gray-500">Today</p>
                        <h3 class="font-bold text-slate-700">
                            {{ now()->format('d M Y') }}
                        </h3>
                    </div>

                </div>

            </div>

        </div>

        {{-- STATS --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

            {{-- USERS --}}
            <div class="bg-white rounded-3xl p-6 shadow-lg card-hover border border-gray-100">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500">Total Users</p>
                        <h2 class="text-4xl font-extrabold mt-2">
                            {{ $users ?? 0 }}
                        </h2>
                    </div>

                    <div class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-users text-2xl text-blue-600"></i>
                    </div>
                </div>
            </div>

            {{-- ARTICLES --}}
            <div class="bg-white rounded-3xl p-6 shadow-lg card-hover border border-gray-100">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500">Articles</p>
                        <h2 class="text-4xl font-extrabold mt-2">
                            {{ $articles_total ?? 0 }}
                        </h2>
                    </div>

                    <div class="w-16 h-16 rounded-2xl bg-green-100 flex items-center justify-center">
                        <i class="fas fa-newspaper text-2xl text-green-600"></i>
                    </div>
                </div>
            </div>

            {{-- PUBLISHED --}}
            <div class="bg-white rounded-3xl p-6 shadow-lg card-hover border border-gray-100">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500">Published</p>
                        <h2 class="text-4xl font-extrabold mt-2">
                            {{ $published ?? 0 }}
                        </h2>
                    </div>

                    <div class="w-16 h-16 rounded-2xl bg-purple-100 flex items-center justify-center">
                        <i class="fas fa-check-circle text-2xl text-purple-600"></i>
                    </div>
                </div>
            </div>

            {{-- ADMINS --}}
            <div class="bg-white rounded-3xl p-6 shadow-lg card-hover border border-gray-100">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500">Admins</p>
                        <h2 class="text-4xl font-extrabold mt-2">
                            {{ $admins ?? 0 }}
                        </h2>
                    </div>

                    <div class="w-16 h-16 rounded-2xl bg-red-100 flex items-center justify-center">
                        <i class="fas fa-user-shield text-2xl text-red-600"></i>
                    </div>
                </div>
            </div>

        </div>

        {{-- QUICK ACTIONS --}}
        <div class="bg-white rounded-3xl shadow-lg p-8">

            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-slate-800">
                    Quick Actions
                </h2>

                <span class="text-sm text-gray-400">
                    Manage everything easily
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                {{-- CARD --}}
                <a href="{{ route('articles.index') }}"
                   class="group bg-slate-50 hover:bg-blue-600 rounded-2xl p-6 transition-all duration-300">

                    <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center mb-4 group-hover:bg-white">
                        <i class="fas fa-newspaper text-blue-600 text-xl"></i>
                    </div>

                    <h3 class="font-bold text-lg text-slate-800 group-hover:text-white">
                        Articles
                    </h3>

                    <p class="text-gray-500 mt-2 group-hover:text-blue-100">
                        Manage all news articles.
                    </p>
                </a>

                <a href="{{ route('categories.index') }}"
                   class="group bg-slate-50 hover:bg-green-600 rounded-2xl p-6 transition-all duration-300">

                    <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center mb-4 group-hover:bg-white">
                        <i class="fas fa-list text-green-600 text-xl"></i>
                    </div>

                    <h3 class="font-bold text-lg text-slate-800 group-hover:text-white">
                        Categories
                    </h3>

                    <p class="text-gray-500 mt-2 group-hover:text-green-100">
                        Organize content categories.
                    </p>
                </a>

                <a href="{{ route('users.index') }}"
                   class="group bg-slate-50 hover:bg-yellow-500 rounded-2xl p-6 transition-all duration-300">

                    <div class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center mb-4 group-hover:bg-white">
                        <i class="fas fa-users text-yellow-600 text-xl"></i>
                    </div>

                    <h3 class="font-bold text-lg text-slate-800 group-hover:text-white">
                        Users
                    </h3>

                    <p class="text-gray-500 mt-2 group-hover:text-yellow-100">
                        Manage platform users.
                    </p>
                </a>

                <a href="{{ route('analytics.index') }}"
                   class="group bg-slate-50 hover:bg-purple-600 rounded-2xl p-6 transition-all duration-300">

                    <div class="w-14 h-14 rounded-2xl bg-purple-100 flex items-center justify-center mb-4 group-hover:bg-white">
                        <i class="fas fa-chart-line text-purple-600 text-xl"></i>
                    </div>

                    <h3 class="font-bold text-lg text-slate-800 group-hover:text-white">
                        Analytics
                    </h3>

                    <p class="text-gray-500 mt-2 group-hover:text-purple-100">
                        View reports and analytics.
                    </p>
                </a>

            </div>

        </div>

    </main>

</div>

</body>
</html>
</x-app-layout>
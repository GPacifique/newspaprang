<x-app-layout/>

<div class="max-w-7xl mx-auto p-6">

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-slate-800">📊 Analytics Dashboard</h1>
        <p class="text-gray-500">Overview of your platform performance</p>
    </div>

    {{-- STATS CARDS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <div class="bg-white p-6 rounded-3xl shadow">
            <p class="text-gray-500">Total Users</p>
            <h2 class="text-3xl font-bold">{{ \App\Models\User::count() }}</h2>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow">
            <p class="text-gray-500">Total Articles</p>
            <h2 class="text-3xl font-bold">{{ \App\Models\Article::count() }}</h2>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow">
            <p class="text-gray-500">Published Articles</p>
            <h2 class="text-3xl font-bold">
                {{ \App\Models\Article::where('status', 'published')->count() }}
            </h2>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow">
            <p class="text-gray-500">Ads</p>
            <h2 class="text-3xl font-bold">{{ \App\Models\Ad::count() }}</h2>
        </div>

    </div>

    {{-- CHART PLACEHOLDERS --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- USERS GROWTH --}}
        <div class="bg-white p-6 rounded-3xl shadow">
            <h3 class="text-lg font-bold mb-4">📈 Users Growth</h3>

            <div class="h-64 flex items-center justify-center text-gray-400 border rounded-xl">
                Chart will appear here (Chart.js / ApexCharts)
            </div>
        </div>

        {{-- ARTICLES PERFORMANCE --}}
        <div class="bg-white p-6 rounded-3xl shadow">
            <h3 class="text-lg font-bold mb-4">📰 Articles Performance</h3>

            <div class="h-64 flex items-center justify-center text-gray-400 border rounded-xl">
                Chart will appear here (views, engagement)
            </div>
        </div>

    </div>

    {{-- RECENT ACTIVITY --}}
    <div class="mt-8 bg-white p-6 rounded-3xl shadow">

        <h3 class="text-lg font-bold mb-4">🕒 Recent Activity</h3>

        <ul class="divide-y">

            <li class="py-3 flex justify-between">
                <span>New user registered</span>
                <span class="text-gray-400 text-sm">Today</span>
            </li>

            <li class="py-3 flex justify-between">
                <span>New article published</span>
                <span class="text-gray-400 text-sm">Yesterday</span>
            </li>

            <li class="py-3 flex justify-between">
                <span>Ad campaign created</span>
                <span class="text-gray-400 text-sm">2 days ago</span>
            </li>

        </ul>

    </div>

</div>
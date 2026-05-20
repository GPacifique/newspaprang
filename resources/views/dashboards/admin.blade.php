<x-app-layout>

    <div class="max-w-7xl mx-auto p-6">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">👑 Newsroom Control Center</h1>

            <div class="text-sm text-gray-600">
                Today: {{ now()->format('d M Y') }}
            </div>
        </div>

        <!-- STATS GRID -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">

            <div class="bg-white p-4 shadow rounded">
                <h2 class="font-bold text-gray-700">Users</h2>
                <p class="text-2xl font-bold">{{ $users ?? 0 }}</p>
            </div>

            <div class="bg-blue-50 p-4 shadow rounded">
                <h2 class="font-bold text-blue-700">Admins</h2>
                <p class="text-2xl font-bold">{{ $admins ?? 0 }}</p>
            </div>

            <div class="bg-green-50 p-4 shadow rounded">
                <h2 class="font-bold text-green-700">Editors</h2>
                <p class="text-2xl font-bold">{{ $editors ?? 0 }}</p>
            </div>

            <div class="bg-yellow-50 p-4 shadow rounded">
                <h2 class="font-bold text-yellow-700">Journalists</h2>
                <p class="text-2xl font-bold">{{ $journalists ?? 0 }}</p>
            </div>

            <div class="bg-white p-4 shadow rounded">
                <h2 class="font-bold">Total Articles</h2>
                <p class="text-2xl">{{ $articles_total ?? 0 }}</p>
            </div>

            <div class="bg-green-100 p-4 shadow rounded">
                <h2 class="font-bold text-green-700">Published</h2>
                <p class="text-2xl">{{ $published ?? 0 }}</p>
            </div>

            <div class="bg-yellow-100 p-4 shadow rounded">
                <h2 class="font-bold text-yellow-700">Pending Review</h2>
                <p class="text-2xl">{{ $pending ?? 0 }}</p>
            </div>

            <div class="bg-red-100 p-4 shadow rounded">
                <h2 class="font-bold text-red-700">Breaking News</h2>
                <p class="text-2xl">{{ $breaking ?? 0 }}</p>
            </div>

            <div class="bg-purple-50 p-4 shadow rounded">
                <h2 class="font-bold text-purple-700">Advertisements</h2>
                <p class="text-2xl">{{ $ads ?? 0 }}</p>
            </div>

            <div class="bg-indigo-50 p-4 shadow rounded">
                <h2 class="font-bold text-indigo-700">Tenders</h2>
                <p class="text-2xl">{{ $tenders ?? 0 }}</p>
            </div>

            <div class="bg-pink-50 p-4 shadow rounded">
                <h2 class="font-bold text-pink-700">Announcements</h2>
                <p class="text-2xl">{{ $announcements ?? 0 }}</p>
            </div>

            <div class="bg-gray-50 p-4 shadow rounded">
                <h2 class="font-bold">Total Views</h2>
                <p class="text-2xl">{{ $views ?? 0 }}</p>
            </div>

        </div>

        <!-- QUICK ACTIONS -->
        <div class="mt-8 bg-white p-5 shadow rounded">

            <h2 class="text-xl font-bold mb-4">⚡ Quick Actions</h2>

            <div class="flex flex-wrap gap-3">

                <a href="{{ route('articles.create') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    + New Article
                </a>

                <a href="{{ route('advertisements.create') }}"
                   class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
                    + New Ad
                </a>

                <a href="{{ route('tenders.create') }}"
                   class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    + New Tender
                </a>

                <a href="{{ route('announcements.create') }}"
                   class="bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700">
                    + Announcement
                </a>

                <a href="{{ route('users.index') }}"
                   class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800">
                    Manage Users
                </a>

                <a href="{{ route('articles.index') }}"
                   class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Manage Articles
                </a>

            </div>
        </div>

        <!-- LATEST ACTIVITY -->
        <div class="mt-8 bg-white p-5 shadow rounded">

            <h2 class="text-xl font-bold mb-4">📰 Latest Activity</h2>

            <ul class="space-y-2 text-sm">

                @forelse($latestArticles ?? [] as $article)
                    <li class="border-b pb-2">
                        📝 New article:
                        <strong>{{ $article->title }}</strong>
                        <span class="text-gray-500">
                            ({{ $article->created_at->diffForHumans() }})
                        </span>
                    </li>
                @empty
                    <li class="text-gray-500">No recent activity.</li>
                @endforelse

            </ul>

        </div>

    </div>

</x-app-layout>
<x-app-layout>
<div class="min-h-screen bg-gray-100 p-6">

    <!-- Header -->
    <div class="bg-white shadow rounded-lg p-6 mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Journalist Dashboard</h1>
            <p class="text-gray-500">Manage articles, profile, and newsroom activities</p>
        </div>
        @php
            $articlesCount = $articles->count();
            $publishedCount = $articles->where('status', 'published')->count();
            $draftCount = $articles->where('status', 'draft')->count();
            $viewsCount = $articles->sum('views');
            $articles = $articles->sortByDesc('updated_at')->take(5);
        @endphp

        <a href="{{ route('articles.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Create Article
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

        <div class="bg-white shadow rounded-lg p-5">
            <h3 class="text-gray-500">My Articles</h3>
            <p class="text-3xl font-bold">{{ $articlesCount }}</p>
        </div>

        <div class="bg-white shadow rounded-lg p-5">
            <h3 class="text-gray-500">Published</h3>
            <p class="text-3xl font-bold text-green-600">{{ $publishedCount }}</p>
        </div>

        <div class="bg-white shadow rounded-lg p-5">
            <h3 class="text-gray-500">Drafts</h3>
            <p class="text-3xl font-bold text-yellow-600">{{ $draftCount }}</p>
        </div>

        <div class="bg-white shadow rounded-lg p-5">
            <h3 class="text-gray-500">Total Views</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $viewsCount }}</p>
        </div>

    </div>

    <!-- Management Options -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <a href="{{ route('articles.index') }}" class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
            <h2 class="text-xl font-bold mb-2">Manage Articles</h2>
            <p class="text-gray-600">View, edit, delete and publish your articles.</p>
        </a>

        <a href="{{ route('articles.create') }}" class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
            <h2 class="text-xl font-bold mb-2">Write News</h2>
            <p class="text-gray-600">Create breaking news and new stories.</p>
        </a>

        <a href="{{ route('profile.edit') }}" class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
            <h2 class="text-xl font-bold mb-2">Profile Settings</h2>
            <p class="text-gray-600">Update your account profile and password.</p>
        </a>

    </div>

    <!-- Recent Articles -->
    <div class="bg-white shadow rounded-lg p-6">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Recent Articles</h2>
            <a href="{{ route('articles.index') }}" class="text-blue-600">View All</a>
        </div>

        <table class="w-full border-collapse">

            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-3">Title</th>
                    <th class="p-3">Category</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($recentArticles as $article)

                    <tr class="border-b">
                        <td class="p-3">{{ $article->title }}</td>

                        <td class="p-3">
                            {{ $article->category?->name ?? 'N/A' }}
                        </td>

                        <td class="p-3">
                            <span class="px-2 py-1 rounded text-sm 
                                {{ $article->status === 'published'
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-yellow-100 text-yellow-700' }}">
                                {{ ucfirst($article->status) }}
                            </span>
                        </td>

                        <td class="p-3 space-x-2">

                            <a href="{{ route('articles.edit', $article->id) }}"
                               class="text-blue-600">Edit</a>

                            <a href="{{ route('articles.show', $article->slug) }}"
                               class="text-green-600">View</a>

                            <form action="{{ route('articles.destroy', $article->id) }}"
                                  method="POST"
                                  class="inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="text-red-600"
                                        onclick="return confirm('Delete this article?')">
                                    Delete
                                </button>

                            </form>

                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="p-4 text-center text-gray-500">
                            No articles found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>
</x-app-layout>
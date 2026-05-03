<x-app-layout>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Journalist Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-7xl mx-auto p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold">📝 Journalist Studio</h1>
            <p class="text-gray-600 mt-1">
                Create, manage, and submit your stories for editorial review.
            </p>
        </div>

        <a href="{{ route('articles.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded">
            + New Article
        </a>
    </div>

    <!-- STATS -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">

        <div class="bg-white p-4 shadow rounded">
            <h2 class="font-bold">Drafts</h2>
            <p class="text-2xl">{{ $drafts ?? 0 }}</p>
        </div>

        <div class="bg-yellow-50 p-4 shadow rounded">
            <h2 class="font-bold text-yellow-700">Submitted</h2>
            <p class="text-2xl">{{ $submitted ?? 0 }}</p>
        </div>

        <div class="bg-green-50 p-4 shadow rounded">
            <h2 class="font-bold text-green-700">Published</h2>
            <p class="text-2xl">{{ $published ?? 0 }}</p>
        </div>

        <div class="bg-red-50 p-4 shadow rounded">
            <h2 class="font-bold text-red-700">Needs Revision</h2>
            <p class="text-2xl">{{ $revision ?? 0 }}</p>
        </div>

    </div>

    <!-- QUICK ACTIONS -->
    <div class="mt-8 bg-white p-5 shadow rounded">

        <h2 class="text-xl font-bold mb-4">⚡ Quick Actions</h2>

        <div class="flex flex-wrap gap-3">

            <a href="{{ route('articles.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded">
                Write Article
            </a>

            <a href="{{ route('articles.index') }}"
               class="bg-gray-700 text-white px-4 py-2 rounded">
                My Articles
            </a>

            <a href="{{ route('articles.index', ['status' => 'draft']) }}"
               class="bg-yellow-600 text-white px-4 py-2 rounded">
                Drafts
            </a>

        </div>

    </div>

    <!-- ARTICLES LIST -->
    <div class="mt-8">

        <h2 class="text-xl font-bold mb-4">📄 My Articles</h2>

        @forelse($my_articles ?? [] as $article)

            <div class="bg-white p-5 shadow rounded mb-4">

                <div class="flex justify-between items-start">

                    <div>
                        <h3 class="font-bold text-lg">
                            {{ $article->title }}
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            {{ Str::limit($article->content, 120) }}
                        </p>

                        <div class="mt-2 text-xs text-gray-500">
                            Views: {{ $article->views ?? 0 }} |
                            Updated: {{ $article->updated_at->diffForHumans() }}
                        </div>
                    </div>

                    <!-- STATUS BADGE -->
                    <div>
                        <span class="px-3 py-1 text-xs rounded
                            @if($article->status == 'draft') bg-gray-500 text-white
                            @elseif($article->status == 'submitted') bg-blue-500 text-white
                            @elseif($article->status == 'under_review') bg-yellow-500 text-white
                            @elseif($article->status == 'needs_revision') bg-red-500 text-white
                            @elseif($article->status == 'published') bg-green-500 text-white
                            @endif
                        ">
                            {{ ucfirst($article->status) }}
                        </span>
                    </div>

                </div>

                <!-- ACTIONS -->
                <div class="mt-4 flex gap-2">

                    <a href="{{ route('articles.edit', $article->slug) }}"
                       class="bg-blue-600 text-white px-3 py-1 rounded text-xs">
                        Edit
                    </a>

                    <a href="{{ route('articles.show', $article->slug) }}"
                       class="bg-gray-700 text-white px-3 py-1 rounded text-xs">
                        View
                    </a>

                    <form method="POST"
                          action="{{ route('articles.submit', $article->id) }}">
                        @csrf
                        <button class="bg-green-600 text-white px-3 py-1 rounded text-xs">
                            Submit
                        </button>
                    </form>

                </div>

            </div>

        @empty
            <p class="text-gray-500">You have not written any articles yet.</p>
        @endforelse

    </div>

</div>

</body>
</html>
</x-app-layout>
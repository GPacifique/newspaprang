<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editor Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-7xl mx-auto p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold">🖊️ Editor Control Panel</h1>

        <div class="text-sm text-gray-600">
            {{ now()->format('d M Y') }}
        </div>
    </div>

    <!-- STATS -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">

        <div class="bg-white p-4 shadow rounded">
            <h2 class="font-bold">Pending Review</h2>
            <p class="text-2xl">{{ $pending ?? 0 }}</p>
        </div>

        <div class="bg-yellow-50 p-4 shadow rounded">
            <h2 class="font-bold text-yellow-700">Under Review</h2>
            <p class="text-2xl">{{ $under_review ?? 0 }}</p>
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

    <!-- ARTICLES TABLE -->
    <div class="mt-8 bg-white shadow rounded p-5">

        <h2 class="text-xl font-bold mb-4">📄 Articles Queue</h2>

        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 text-left">Title</th>
                    <th class="p-2 text-left">Author</th>
                    <th class="p-2 text-left">Status</th>
                    <th class="p-2 text-left">Date</th>
                    <th class="p-2 text-left">Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($articles ?? [] as $article)

                    <tr class="border-b">

                        <td class="p-2 font-semibold">
                            {{ $article->title }}
                        </td>

                        <td class="p-2">
                            {{ $article->author->name ?? 'Unknown' }}
                        </td>

                        <td class="p-2">
                            <span class="px-2 py-1 text-xs rounded
                                @if($article->status == 'submitted') bg-blue-500 text-white
                                @elseif($article->status == 'under_review') bg-yellow-500 text-white
                                @elseif($article->status == 'needs_revision') bg-red-500 text-white
                                @elseif($article->status == 'approved') bg-green-500 text-white
                                @endif
                            ">
                                {{ ucfirst($article->status) }}
                            </span>
                        </td>

                        <td class="p-2 text-gray-500">
                            {{ $article->created_at->diffForHumans() }}
                        </td>

                        <!-- ACTIONS -->
                        <td class="p-2 flex gap-2">

                            <a href="{{ route('articles.show', $article->slug) }}"
                               class="bg-gray-700 text-white px-3 py-1 rounded text-xs">
                                View
                            </a>

                            <!-- Approve -->
                            <form method="POST" action="{{ route('articles.approve', $article->id) }}">
                                @csrf
                                <button class="bg-green-600 text-white px-3 py-1 rounded text-xs">
                                    Approve
                                </button>
                            </form>

                            <!-- Request Revision -->
                            <form method="POST" action="{{ route('articles.revision', $article->id) }}">
                                @csrf
                                <button class="bg-yellow-600 text-white px-3 py-1 rounded text-xs">
                                    Revise
                                </button>
                            </form>

                            <!-- Reject -->
                            <form method="POST" action="{{ route('articles.reject', $article->id) }}">
                                @csrf
                                <button class="bg-red-600 text-white px-3 py-1 rounded text-xs">
                                    Reject
                                </button>
                            </form>

                        </td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-500 p-4">
                            No articles in queue
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>

    </div>

    <!-- QUICK ACTIONS -->
    <div class="mt-8 bg-white p-5 shadow rounded">

        <h2 class="text-xl font-bold mb-4">⚡ Editor Tools</h2>

        <div class="flex flex-wrap gap-3">

            <a href="{{ route('articles.index') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded">
                All Articles
            </a>

            <a href="{{ route('articles.create') }}"
               class="bg-green-600 text-white px-4 py-2 rounded">
                + Write Article
            </a>

            <a href="{{ route('categories.index') }}"
               class="bg-purple-600 text-white px-4 py-2 rounded">
                Manage Categories
            </a>

        </div>

    </div>

</div>

</body>
</html>
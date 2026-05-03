<x-app-layout>
@section('content')

<div class="container mx-auto px-6 py-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Manage Articles</h1>

        <a href="{{ route('articles.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            + New Article
        </a>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Image</th>
                    <th class="p-3 text-left">Title</th>
                    <th class="p-3 text-left">Category</th>
                    <th class="p-3 text-left">Author</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Views</th>
                    <th class="p-3 text-left">Published</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($articles as $article)
                    <tr class="border-b">

                        <!-- Image -->
                        <td class="p-3">
                            @if($article->featured_image)
                                <img src="{{ asset('storage/' . $article->featured_image) }}"
                                     class="w-20 h-14 object-cover rounded">
                            @else
                                <span class="text-gray-400">No image</span>
                            @endif
                        </td>

                        <!-- Title -->
                        <td class="p-3">
                            <h2 class="font-semibold">
                                {{ $article->title }}
                            </h2>

                            @if($article->is_breaking)
                                <span class="bg-red-500 text-white px-2 py-1 text-xs rounded">
                                    Breaking
                                </span>
                            @endif

                            @if($article->is_featured)
                                <span class="bg-yellow-500 text-white px-2 py-1 text-xs rounded">
                                    Featured
                                </span>
                            @endif
                        </td>

                        <!-- Category -->
                        <td class="p-3">
                            {{ $article->category->name ?? 'N/A' }}
                        </td>

                        <!-- Author -->
                        <td class="p-3">
                            {{ $article->author->name }}
                        </td>

                        <!-- Status -->
                        <td class="p-3">
                            <span class="px-2 py-1 rounded text-white
                                @if($article->status == 'published') bg-green-500
                                @elseif($article->status == 'draft') bg-gray-500
                                @elseif($article->status == 'under_review') bg-yellow-500
                                @else bg-blue-500
                                @endif
                            ">
                                {{ ucfirst($article->status) }}
                            </span>
                        </td>

                        <!-- Views -->
                        <td class="p-3">
                            {{ $article->views }}
                        </td>

                        <!-- Published Date -->
                        <td class="p-3">
                            {{ $article->published_at 
                                ? $article->published_at->format('d M Y') 
                                : 'Not published'
                            }}
                        </td>

                        <!-- Actions -->
                        <td class="p-3 flex gap-2">

                            <a href="{{ route('articles.show', $article) }}"
                               class="bg-green-500 text-white px-3 py-1 rounded">
                                View
                            </a>

                            <a href="{{ route('articles.edit', $article) }}"
                               class="bg-blue-500 text-white px-3 py-1 rounded">
                                Edit
                            </a>

                            <form action="{{ route('articles.destroy', $article) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this article?')">
                                @csrf
                                @method('DELETE')

                                <button class="bg-red-500 text-white px-3 py-1 rounded">
                                    Delete
                                </button>
                            </form>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="p-4 text-center text-gray-500">
                            No articles found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $articles->links() }}
    </div>

</div>

@endsection
</x-app-layout>
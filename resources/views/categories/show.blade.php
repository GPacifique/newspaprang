<x-app-layout>

<div class="max-w-6xl mx-auto mt-6 px-4">

    <!-- Category Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold capitalize">
            {{ $category->name }}
        </h1>

        <p class="text-gray-500">
            Latest articles in {{ $category->name }}
        </p>
    </div>

    <!-- Articles Grid -->
    <div class="grid md:grid-cols-3 gap-6">

        @forelse($articles as $article)
            <div class="bg-white shadow rounded overflow-hidden">

                @if($article->featured_image)
                    <img src="{{ asset('storage/'.$article->featured_image) }}"
                         class="w-full h-40 object-cover">
                @endif

                <div class="p-4">

                    <h2 class="font-semibold text-lg">
                        {{ $article->title }}
                    </h2>

                    <p class="text-sm text-gray-500 mt-2">
                        {{ Str::limit($article->excerpt ?? $article->content, 100) }}
                    </p>

                    <a href="{{ route('articles.show', $article->slug) }}"
                       class="text-red-600 text-sm mt-3 inline-block">
                        Read More →
                    </a>

                </div>

            </div>
        @empty
            <p class="text-gray-500 col-span-3">
                No articles found in this category.
            </p>
        @endforelse

    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $articles->links() }}
    </div>

</div>

</x-app-layout>
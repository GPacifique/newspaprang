<x-app-layout>

<div class="max-w-7xl mx-auto p-6">

    <h2 class="text-xl font-bold mb-4">
        Search results for: "{{ $query }}"
    </h2>

    @if($articles->count())
        <div class="grid md:grid-cols-3 gap-6">

            @foreach($articles as $article)
                <div class="bg-white shadow rounded overflow-hidden">

                    {{-- IMAGE --}}
                    @if($article->image_url)
                        <img src="{{ $article->image_url }}"
                             class="w-full h-40 object-cover">
                    @endif

                    <div class="p-3">

                        <h3 class="font-semibold text-sm">
                            {{ Str::limit($article->title, 80) }}
                        </h3>

                        <p class="text-xs text-gray-500 mt-1">
                            {{ $article->created_at->diffForHumans() }}
                        </p>

                        <a href="{{ route('articles.show', $article->slug) }}"
                           class="text-red-600 text-xs mt-2 inline-block">
                            Read more →
                        </a>

                    </div>

                </div>
            @endforeach

        </div>
    @else
        <p class="text-gray-500">No articles found.</p>
    @endif

</div>
</x-app-layout>
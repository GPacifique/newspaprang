<x-app-layout>

@section('content')
<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Main Article Content -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">

                <!-- Featured Image -->
                @if($article->featured_image)
                    <img
                        src="{{ asset('storage/' . $article->featured_image) }}"
                        alt="{{ $article->title }}"
                        class="w-xl h-[450px] object-cover"
                    >
                @endif

                <div class="p-6">

                    <!-- Category + Breaking Badge -->
                    <div class="flex items-center gap-3 mb-4">
                        @if($article->category)
                            <span class="bg-red-600 text-white px-3 py-1 text-sm rounded">
                                {{ $article->category->name }}
                            </span>
                        @endif

                        @if($article->is_breaking)
                            <span class="bg-black text-white px-3 py-1 text-sm rounded animate-pulse">
                                BREAKING
                            </span>
                        @endif
                    </div>

                    <!-- Title -->
                    <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                        {{ $article->title }}
                    </h1>

                    <!-- Meta Info -->
                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 border-b pb-4 mb-6">
                        <span>
                            By <strong>{{ $article->author->name ?? 'Admin' }}</strong>
                        </span>

                        <span>
                            {{ $article->created_at->format('d M Y') }}
                        </span>

                        <span>
                            👁 {{ number_format($article->views) }} Views
                        </span>
                    </div>

                    <!-- Excerpt -->
                    @if($article->excerpt)
                        <div class="text-lg font-medium text-gray-700 mb-6 italic border-l-4 border-red-500 pl-4">
                            {{ $article->excerpt }}
                        </div>
                    @endif

                    <!-- Article Body -->
                    <div class="prose max-w-none prose-lg">
                        {!! nl2br(e($article->content)) !!}
                    </div>

                    <!-- Share Buttons -->
                    <div class="mt-8 border-t pt-6">
                        <h3 class="font-bold mb-3">Share this article</h3>

                        <div class="flex gap-3">
                            <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded">Facebook</a>
                            <a href="#" class="bg-sky-500 text-white px-4 py-2 rounded">Twitter</a>
                            <a href="#" class="bg-green-600 text-white px-4 py-2 rounded">WhatsApp</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Sidebar -->
        <div class="space-y-6">

            <!-- Related News -->
            <div class="bg-white rounded-lg shadow-sm p-5">
                <h2 class="text-xl font-bold border-b pb-3 mb-4 text-red-600">
                    Related News
                </h2>

                @forelse($relatedArticles as $related)
                    <div class="mb-4 pb-4 border-b last:border-none">

                        @if($related->featured_image)
                            <img
                                src="{{ asset('storage/' . $related->featured_image) }}"
                                class="w-full h-40 object-cover rounded mb-3"
                                alt="{{ $related->title }}"
                            >
                        @endif

                        <a href="{{ route('articles.show', $related->slug) }}"
                           class="font-semibold text-gray-800 hover:text-red-600">
                            {{ $related->title }}
                        </a>

                        <p class="text-sm text-gray-500 mt-2">
                            {{ $related->created_at->format('d M Y') }}
                        </p>
                    </div>
                @empty
                    <p class="text-gray-500">No related articles found.</p>
                @endforelse
            </div>


            <!-- Trending News -->
            <div class="bg-white rounded-lg shadow-sm p-5">
                <h2 class="text-xl font-bold border-b pb-3 mb-4 text-red-600">
                    Trending News
                </h2>

                @foreach($trendingArticles ?? [] as $trend)
                    <div class="mb-3 pb-3 border-b last:border-none">
                        <a href="{{ route('articles.show', $trend->slug) }}"
                           class="font-medium hover:text-red-600">
                            {{ $trend->title }}
                        </a>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
@endsection
</x-app-layout>
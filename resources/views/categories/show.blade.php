<x-app-layout>
    <div class="min-h-screen bg-gray-50">

    <!-- Category Header -->
    <section class="bg-gradient-to-r from-red-600 to-red-800 text-white py-14">
        <div class="max-w-7xl mx-auto px-4">

            <!-- Breadcrumb -->
            <div class="mb-6 text-sm">
                <a href="/" class="text-red-100 hover:text-white transition">
                    Home
                </a>
                <span class="mx-2">/</span>
                <span class="font-semibold">{{ $category->name }}</span>
            </div>

            <!-- Category Title -->
            <h1 class="text-4xl md:text-5xl font-bold capitalize mb-3">
                {{ $category->name }}
            </h1>

            <p class="text-red-100 text-lg max-w-2xl">
                Explore insightful stories and latest updates in 
                {{ strtolower($category->name) }}
            </p>
        </div>
    </section>


    <!-- Main Content -->
    <section class="max-w-7xl mx-auto px-4 py-12">

        <!-- Stats -->
        @if($articles->total() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">

            <div class="bg-white shadow-md rounded-xl p-6 flex items-center gap-4">
                <div class="bg-red-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                    </svg>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Total Articles</p>
                    <h3 class="text-2xl font-bold">{{ $articles->total() }}</h3>
                </div>
            </div>

            <div class="bg-white shadow-md rounded-xl p-6 flex items-center gap-4">
                <div class="bg-blue-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 11h4v5H2z"/>
                    </svg>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Current Page</p>
                    <h3 class="text-2xl font-bold">{{ $articles->currentPage() }}</h3>
                </div>
            </div>

        </div>
        @endif


        <!-- Articles Grid -->
        @if($articles->count() > 0)

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            @foreach($articles as $article)
            <article class="bg-white rounded-2xl shadow-md hover:shadow-xl hover:-translate-y-2 transition duration-300 overflow-hidden">

                <!-- Image -->
                <div class="relative h-56 overflow-hidden group">

                    @if($article->featured_image)
                        <img 
                            src="{{ asset('storage/' . $article->featured_image) }}"
                            alt="{{ $article->title }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                        >
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500">No Image</span>
                        </div>
                    @endif

                    @if($article->is_breaking)
                    <span class="absolute top-4 right-4 bg-red-600 text-white px-3 py-1 rounded-full text-xs font-bold animate-pulse">
                        Breaking
                    </span>
                    @endif
                </div>


                <!-- Content -->
                <div class="p-6 flex flex-col h-full">

                    <!-- Category Badge -->
                    @if($article->category)
                    <span class="inline-block bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-semibold mb-3 w-fit">
                        {{ $article->category->name }}
                    </span>
                    @endif

                    <!-- Title -->
                    <h2 class="text-xl font-bold text-gray-900 mb-3 hover:text-red-600 transition">
                        {{ $article->title }}
                    </h2>

                    <!-- Excerpt -->
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                        {{ Str::limit($article->excerpt ?? strip_tags($article->content), 120) }}
                    </p>

                    <!-- Meta -->
                    <div class="border-t pt-4 mt-auto text-sm text-gray-500 space-y-2">

                        <div class="flex justify-between">
                            <span>{{ $article->author->name ?? 'Anonymous' }}</span>
                            <span>{{ $article->created_at->format('M d, Y') }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span>{{ number_format($article->views ?? 0) }} views</span>
                        </div>
                    </div>

                    <!-- Read Button -->
                    @if($article->slug)
                    <a 
                        href="{{ route('articles.show', $article->slug) }}"
                        class="mt-5 w-full text-center bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg font-semibold transition"
                    >
                        Read Full Article
                    </a>
                    @endif

                </div>
            </article>
            @endforeach

        </div>


        <!-- Pagination -->
        @if($articles->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $articles->links('pagination::tailwind') }}
        </div>
        @endif


        @else

        <!-- Empty State -->
        <div class="bg-white rounded-2xl shadow-lg p-12 text-center">

            <div class="mb-6">
                <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto">
                    <span class="text-red-600 text-3xl">📰</span>
                </div>
            </div>

            <h3 class="text-2xl font-bold text-gray-900 mb-3">
                No Articles Found
            </h3>

            <p class="text-gray-600 mb-6">
                No articles available in 
                <span class="font-semibold text-red-600">
                    {{ $category->name }}
                </span>
            </p>

            <a 
                href="/"
                class="inline-block bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold transition"
            >
                Back Home
            </a>
        </div>

        @endif

    </section>
</div>
</x-app-layout>
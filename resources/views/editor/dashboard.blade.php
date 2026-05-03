<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editor Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- STATS -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">

                        <div class="bg-yellow-100 p-4 rounded">
                            <p class="text-sm">Pending Articles</p>
                            <h2 class="text-xl font-bold">{{ $pendingArticles }}</h2>
                        </div>

                        <div class="bg-blue-100 p-4 rounded">
                            <p class="text-sm">Under Review</p>
                            <h2 class="text-xl font-bold">{{ $underReview }}</h2>
                        </div>

                        <div class="bg-green-100 p-4 rounded">
                            <p class="text-sm">Published Today</p>
                            <h2 class="text-xl font-bold">{{ $publishedToday }}</h2>
                        </div>

                    </div>

                    <!-- RECENT SUBMISSIONS -->
                    <h2 class="text-xl font-bold mb-3">Recent Submissions</h2>

                    @foreach($recentSubmissions as $article)
                        <div class="border-b py-2 flex justify-between">
                            <div>
                                <p class="font-semibold">{{ $article->title }}</p>
                                <p class="text-sm text-gray-500">
                                    by {{ $article->author->name ?? 'Unknown' }}
                                </p>
                            </div>

                            <a href="#" class="text-blue-600 text-sm">Review →</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
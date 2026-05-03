<div class="bg-green-600 text-white py-2 overflow-hidden">

    <div class="max-w-7xl mx-auto px-4 flex items-center gap-3">

        <span class="font-bold whitespace-nowrap">
            🔴 Breaking:
        </span>

        <div class="overflow-hidden w-full relative">

            <div id="ticker" class="flex gap-10 whitespace-nowrap animate-scroll">

                @foreach($articles as $article)
                    <a href="{{ route('articles.show', $article->slug) }}"
                       class="hover:underline text-sm">
                        {{ $article->title }}
                    </a>
                @endforeach

            </div>

        </div>

    </div>
</div>
<style>
@keyframes scroll {
    0% { transform: translateX(100%); }
    100% { transform: translateX(-100%); }
}

.animate-scroll {
    display: inline-flex;
    animation: scroll 25s linear infinite;
}
</style>
<header class="bg-black text-white sticky top-0 z-50 shadow">
    <div class="max-w-7xl mx-auto flex justify-between items-center p-4">
        <h1 class="text-2xl font-bold">Rwanda Fiesta</h1>

        <nav class="space-x-4 text-sm hidden md:block">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ route('category.show','politics') }}">Politics</a>
            <a href="{{ route('category.show','sports') }}">Sports</a>
            <a href="{{ route('category.show','entertainment') }}">Entertainment</a>
            <a href="{{ route('category.show','health') }}">Health</a>
            <a href="{{ route('category.show','education') }}">Education</a>
            <a href="{{ route('category.show','business') }}">Business</a>
        </nav>
    </div>
</header>

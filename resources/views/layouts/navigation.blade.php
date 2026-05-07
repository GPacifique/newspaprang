<nav class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo -->
            <a href="{{ url('/') }}" class="text-xl font-bold">
                NewsPortal
            </a>

            <!-- Main Links -->
            <div class="hidden sm:flex space-x-6">
                <a href="{{ url('/') }}" class="text-gray-700">Home</a>
                <a href="{{ route('categories.show', 'politics') }}" class="text-gray-700">Politics</a>
                <a href="{{ route('categories.show', 'sports') }}" class="text-gray-700">Sports</a>
                <a href="{{ route('categories.show', 'business') }}" class="text-gray-700">Business</a>
                <a href="{{ route('categories.show', 'tech') }}" class="text-gray-700">Tech</a>
            </div>

            <!-- Auth (optional) -->
            <div>
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm text-blue-600">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-blue-600">Login</a>
                @endauth
            </div>

        </div>
    </div>
</nav>
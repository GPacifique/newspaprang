<nav class="bg-white shadow p-4">

    <div class="max-w-7xl mx-auto flex justify-between items-center">

        <!-- LOGO -->
        <a href="/" class="text-2xl font-bold text-red-600">
            NewsPortal
        </a>

        <!-- PUBLIC LINKS -->
        <div class="hidden md:flex space-x-6">

            <x-nav-link href="/" :active="request()->is('/')">
                Home
            </x-nav-link>

            <x-nav-link href="/category/politics" :active="request()->is('category/politics')">
                Politics
            </x-nav-link>

            <x-nav-link href="/category/sports" :active="request()->is('category/sports')">
                Sports
            </x-nav-link>

            <x-nav-link href="/category/business" :active="request()->is('category/business')">
                Business
            </x-nav-link>

        </div>

        <!-- ADMIN ONLY LINKS -->
        @role('admin')
        <div class="hidden md:flex space-x-4 border-l pl-4 ml-4">

            <x-nav-link href="/admin/dashboard" :active="request()->is('admin/dashboard')">
                Admin
            </x-nav-link>

            <x-nav-link href="{{ route('articles.create') }}">
                + Article
            </x-nav-link>

            <x-nav-link href="{{ route('advertisements.create') }}">
                Ads
            </x-nav-link>

            <x-nav-link href="{{ route('announcements.create') }}">
                Announcements
            </x-nav-link>

            <x-nav-link href="{{ route('tenders.create') }}">
                Tenders
            </x-nav-link>

            <x-nav-link href="{{ route('users.index') }}">
                Users
            </x-nav-link>

        </div>
        @endrole

        <!-- AUTH -->
        <div class="space-x-3">

            @auth
                <x-nav-link href="{{ route('dashboard') }}">
                    Dashboard
                </x-nav-link>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button class="text-red-600 hover:underline">
                        Logout
                    </button>
                </form>
            @else
                <x-nav-link href="{{ route('login') }}">Login</x-nav-link>
                <x-nav-link href="{{ route('register') }}">Register</x-nav-link>
            @endauth

        </div>

    </div>
</nav>
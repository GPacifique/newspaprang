<div x-data="{ open: false }" class="bg-white shadow">

    {{-- TOP BAR --}}
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-14">

          

            {{-- SEARCH BAR (DESKTOP) --}}
            <form action="{{ route('articles.search') }}"
                  method="GET"
                  class="hidden md:flex items-center border rounded overflow-hidden">

                <input type="text"
                       name="q"
                       placeholder="Search news..."
                       class="px-96 py-1 text-sm outline-none w-48">

                <button type="submit"
                        class="bg-red-600 text-white px-3 py-1 text-sm">
                    Search
                </button>
            </form>

            {{-- DESKTOP MENU --}}
            <div class="hidden md:flex items-center space-x-6 text-sm">

                <a href="{{ url('/') }}" class="hover:text-red-600">
                    Home
                </a>

                <a href="{{ url('/contact') }}" class="hover:text-red-600">
                    Contact Us
                </a>

                @guest
                    <a href="{{ route('login') }}" class="hover:text-red-600">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                       class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                        Register
                    </a>
                @endguest

                @auth
                    <a href="{{ url('/dashboard') }}" class="hover:text-red-600">
                        Dashboard
                    </a>
                @endauth

            </div>

            {{-- MOBILE TOGGLE --}}
            <button @click="open = !open"
                    class="md:hidden text-gray-700">

                <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>

                <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>

            </button>

        </div>
    </div>

    {{-- MOBILE MENU --}}
    <div x-show="open" class="md:hidden border-t bg-white px-4 py-3 space-y-3">

        {{-- MOBILE SEARCH --}}
        <form action="{{ route('articles.search') }}" method="GET"
              class="flex border rounded overflow-hidden">

            <input type="text"
                   name="q"
                   placeholder="Search..."
                   class="w-full px-3 py-1 text-sm outline-none">

            <button class="bg-red-600 text-white px-3 text-sm">
                Go
            </button>
        </form>

        <a href="{{ url('/') }}" class="block">Home</a>
        <a href="{{ url('/contact') }}" class="block">Contact Us</a>

        @guest
            <a href="{{ route('login') }}" class="block">Login</a>
            <a href="{{ route('register') }}" class="block text-red-600 font-semibold">
                Register
            </a>
        @endguest

        @auth
            <a href="{{ url('/dashboard') }}" class="block">Dashboard</a>
        @endauth

    </div>

</div>
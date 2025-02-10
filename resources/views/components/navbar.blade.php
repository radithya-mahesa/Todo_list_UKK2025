<header class="bg-blue-600 z-50  shadow-lg rounded-md fixed top-6 left-6 sm:left-20 p-2 right-6 sm:right-20 z-999">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="text-xl font-bold text-gray-800 flex gap-1">
            <span class="text-gray-200" id="digital-clock"></span>
            <span class="text-yellow-300">|</span>
            <i id="time-icon" class="fa-solid fa-sun"></i>
            <h1 class="text-gray-200">{{ $greeting }}</h1>
            <h1 class="text-yellow-300">
                @auth
                    {{ ucfirst(strtolower(Auth::user()->username)) }}
                @else
                    Guest
                @endauth
            </h1>

        </div>

        <nav class="hidden sm:block">
            <ul class="flex gap-3 text-gray-600">
                <li>
                    <button onclick="sortTasksByPriority()" class="text-gray-300 hover:text-red-500">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </button>
                </li>
                <li>
                    <button onclick="restoreOriginalOrder()" class="text-gray-300 hover:text-yellow-300">
                        <i class="fa-solid fa-list-ul"></i>
                    </button>
                </li>
                <li>
                    <button class="text-gray-300 hover:text-green-400">
                        <i class="fa-solid fa-circle-check"></i>
                    </button>
                </li>
            </ul>
        </nav>

        <div class="sm:hidden">
            <button id="hamburger" class="text-gray-800 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>

    <div id="mobile-menu" class="sm:hidden hidden bg-white shadow-md py-4 mt-2">
        <ul class="space-y-4 text-gray-600 text-center">
            <li><a href="#" class="hover:text-blue-500">Home</a></li>
            <li><a href="#" class="hover:text-blue-500">About</a></li>
            <li><a href="#" class="hover:text-blue-500">Projects</a></li>
            <li><a href="#" class="hover:text-blue-500">Contact</a></li>
        </ul>
    </div>
</header>
@push('time')
    <script src="{{ asset('js/time.js') }}"></script>
@endpush

<header class="bg-blue-600 dark:bg-blue-950 z-50  shadow-lg rounded-md fixed top-6 left-6 sm:left-20 p-2 right-6 sm:right-20 z-999">
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

        <nav class="block">
            <ul class="flex gap-4">
                <li>
                    <button data-tooltip-target="tooltip-priority" type="button" onclick="sortTasksByPriority()"
                        class="text-gray-200 hover:text-red-500">
                        <i class="fa-solid text-lg fa-triangle-exclamation"></i>
                    </button>
                    <div id="tooltip-priority" role="tooltip"
                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 rounded-lg shadow-sm opacity-0 !bg-red-500">
                        Sort by priority
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </li>
                <li>
                    <button data-tooltip-target="tooltip-restore" type="button" onclick="restoreOriginalOrder()"
                        class="text-gray-200 hover:text-yellow-300">
                        <i class="fa-solid text-lg fa-rotate-left"></i>
                    </button>
                    <div id="tooltip-restore" role="tooltip"
                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 rounded-lg shadow-sm opacity-0 !bg-amber-500">
                        Restore original order
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </li>
                <li>
                    <button data-tooltip-target="tooltip-completed" type="button" onclick="showCompletedTasks()"
                        class="text-gray-200 hover:text-green-400">
                        <i class="fa-solid text-lg fa-circle-check"></i>
                    </button>
                    <div id="tooltip-completed" role="tooltip"
                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 rounded-lg shadow-sm opacity-0 !bg-green-500">
                        Restore by completed task
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </li>
            </ul>

        </nav>
    </div>
</header>
@push('time')
    <script src="{{ asset('js/time.js') }}"></script>
@endpush

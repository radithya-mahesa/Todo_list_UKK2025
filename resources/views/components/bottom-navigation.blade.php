<div
    class="fixed bottom-0 left-0 z-50 w-full h-16 bg-blue-600 border-t dark:bg-blue-950 border-sky-600 dark:border-none">
    <div class="flex h-full max-w-lg mx-auto font-medium items-center">
        <form action="{{ route('logout') }}" method="POST" class="h-full flex-1 flex">
            @csrf
            <button type="submit"
                class="w-full h-full inline-flex flex-col items-center justify-center px-2 border-x hover:bg-blue-700">
                <svg class="w-6 h-6 text-gray-100" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 12H4m12 0-4 4m4-4-4-4m3-4h2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-2" />
                </svg>
                <span class="text-sm text-gray-100 group-hover:text-white">Logout</span>
            </button>
        </form>

        <button type="button" data-modal-target="create-modal" data-modal-toggle="create-modal"
            class="h-full flex-1 inline-flex flex-col items-center justify-center px-2 border-e hover:bg-blue-700">
            <svg class="w-6 h-6 text-gray-100" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M18 9V4a1 1 0 0 0-1-1H8.914a1 1 0 0 0-.707.293L4.293 7.207A1 1 0 0 0 4 7.914V20a1 1 0 0 0 1 1h4M9 3v4a1 1 0 0 1-1 1H4m11 6v4m-2-2h4m3 0a5 5 0 1 1-10 0 5 5 0 0 1 10 0Z" />
            </svg>
            <span class="text-sm text-gray-100 group-hover:text-white">Create</span>
        </button>

        <button type="button" x-data="{ darkMode: localStorage.getItem('theme') === 'dark' }"
            @click="darkMode = !darkMode; document.documentElement.classList.toggle('dark', darkMode); localStorage.setItem('theme', darkMode ? 'dark' : 'light')"
            class="h-full flex-1 inline-flex flex-col items-center justify-center px-2 border-e hover:bg-blue-700">
            <template x-if="!darkMode">
                <svg class="w-6 h-6 text-gray-100 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M11.675 2.015a.998.998 0 0 0-.403.011C6.09 2.4 2 6.722 2 12c0 5.523 4.477 10 10 10 4.356 0 8.058-2.784 9.43-6.667a1 1 0 0 0-1.02-1.33c-.08.006-.105.005-.127.005h-.001l-.028-.002A5.227 5.227 0 0 0 20 14a8 8 0 0 1-8-8c0-.952.121-1.752.404-2.558a.996.996 0 0 0 .096-.428V3a1 1 0 0 0-.825-.985Z"
                        clip-rule="evenodd" />
                </svg>
            </template>
            <template x-if="darkMode">
                <svg class="w-6 h-6 text-gray-100 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 5V3m0 18v-2M7.05 7.05 5.636 5.636m12.728 12.728L16.95 16.95M5 12H3m18 0h-2M7.05 16.95l-1.414 1.414M18.364 5.636 16.95 7.05M16 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z" />
                </svg>
            </template>
            <span class="text-sm text-gray-100 group-hover:text-white">Theme</span>
        </button>
    </div>
</div>
<x-create-to-do />

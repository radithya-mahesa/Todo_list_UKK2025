<div class="fixed bottom-0 left-0 z-50 w-full h-16 bg-blue-600 border-t border-sky-600">
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

        <button type="button"
            class="h-full flex-1 inline-flex flex-col items-center justify-center px-2 border-e hover:bg-blue-700">
            <svg class="w-6 h-6 text-gray-100" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 7h.01m3.486 1.513h.01m-6.978 0h.01M6.99 12H7m9 4h2.706a1.957 1.957 0 0 0 1.883-1.325A9 9 0 1 0 3.043 12.89 9.1 9.1 0 0 0 8.2 20.1a8.62 8.62 0 0 0 3.769.9 2.013 2.013 0 0 0 2.03-2v-.857A2.036 2.036 0 0 1 16 16Z" />
            </svg>
            <span class="text-sm text-gray-100 group-hover:text-white">Theme</span>
        </button>
    </div>
</div>
<x-create-to-do />

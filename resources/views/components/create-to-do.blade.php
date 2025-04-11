<div id="create-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div
                class="flex items-center justify-between p-3 md:p-3 border-b rounded-t dark:border-gray-600 border-gray-200">
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('assets/to-do.png') }}" class="h-10" alt="todo">
                    <a href="#" class="text-4xl font-bold text-sky-500">List</a>
                </div>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="create-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>

            <!-- Modal body -->
            <form action="{{ route('tasks.store') }}" method="POST" class="p-4 md:p-5">
                @csrf
                <div class="grid gap-4 mb-4">
                    <!-- Task Input -->
                    <div class="col-span-2">
                        <input type="text" name="name" maxlength="30"
                            class="bg-transparent border border-t-transparent border-r-transparent border-l-transparent border-gray-300 text-gray-900 dark:text-gray-200 text-sm focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Input Task Here - (30 characters max)" required>
                    </div>

                    <!-- Date Range -->
                    <div class="flex items-center">
                        <div class="relative flex-1">
                            <input name="start_date" type="date" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <span class="mx-4 text-gray-500">to</span>
                        <div class="relative flex-1">
                            <input name="end_date" type="date" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>

                    <!-- Priority Select -->
                    <div class="col-span-2">
                        <label for="task-priority-input" class="text-sm font-semibold block mb-2">Priority</label>
                        <select id="task-priority-input" name="priority" required
                            class="border border-gray-300 dark:border-gray-400 dark:bg-gray-800 rounded-lg w-full p-2 text-sm" required>
                            <option value="" disabled selected>Select Priority</option>
                            <option value="normal">Normal</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>

                    <!-- Notes Textarea -->
                    <div class="col-span-2">
                        <textarea id="description" rows="4" name="description" maxlength="80"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-white border-x-transparent border-t-transparent border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Note...(80 characters max)"></textarea>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="text-white w-full inline-flex justify-center items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Create Task
                </button>
            </form>
        </div>
    </div>
</div>

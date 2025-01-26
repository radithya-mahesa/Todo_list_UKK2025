<a class="fixed text-left max-w-sm my-[14vh] md:my-[13vh] p-5 bg-purple-200 border rounded-lg shadow-xl">
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">kerja kerja kerja.</h5>
    <p class="font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of
        2021 so far, in reverse chronological order.</p>
    <hr class="my-4 border-gray-400">
    <div class="flex items-center justify-between">
        <!-- Checkbox -->
        <div class="flex items-center">
            <input checked id="green-checkbox" type="checkbox" value=""
                class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="green-checkbox"
                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Completed</label>
        </div>

        <!-- Edit and Trash bin -->
        <div class="flex items-center space-x-4">
            <!-- Edit -->
            <button type="button" data-modal-target="crud-modal" data-modal-toggle="crud-modal">
                <i class="fa-regular fa-pen-to-square"></i>
            </button>

            <!-- Trash bin -->
            <button type="button">
                <i class="fa-regular fa-trash-can text-red-500"></i>
            </button>
        </div>
    </div>
</a>
<x-modal-to-do />

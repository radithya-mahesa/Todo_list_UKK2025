<div class="flex flex-col md:flex-row max-h-full min-h-full w-full z-40 mx-auto justify-between gap-14 py-28 px-20">
    <div class="w-full md:w-1/2 lg:w-1/2 h-[73vh] overflow-y-auto scrollable-div pr-2">
        <div class="flex flex-col gap-4" id="task-list">
            @if ($tasks->isEmpty())
                <div class="text-center text-gray-500 my-4">Tidak ada task yang tersedia</div>
            @else
                @foreach ($tasks as $task)
                    <div onclick="fetchTaskDetail({{ $task->id }})" data-priority="{{ $task->priority }}"
                        data-completed="{{ $task->completed }}"
                        class="task w-full p-5 bg-white border rounded-lg shadow-xl cursor-pointer hover:shadow-2xl transition-shadow">
                        <div class="flex flex-row justify-between">
                            <div class="flex flex-row gap-2">
                                <span class="text-xl">{{ $task->completed ? '✅' : '📃' }}</span>
                                <div class="flex items-center justify-between">
                                    <div class="relative inline-block">
                                        <span
                                            class="text-2xl font-bold tracking-tight 
                                            {{ $task->completed ? 'text-red-700' : 'text-gray-900' }}">
                                            {{ $task->name }}
                                        </span>
                                        <div
                                            class="{{ $task->completed ? 'absolute bottom-[0.7rem] w-full border-2 border-red-700 border-t' : '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <i
                                    class="fa-solid fa-circle {{ $task->priority == 'high' ? 'text-red-600' : ($task->priority == 'medium' ? 'text-yellow-400' : 'text-green-500') }}"></i>
                            </div>
                        </div>

                        <p class="font-normal text-gray-700 mt-2">{{ $task->description }}</p>
                        <hr class="my-4 border-gray-300">
                        <div class="flex justify-between items-center text-sm text-gray-600">
                            <p> ⌛
                                <span class="text-green-800 font-bold">{{ $task->start_date }}</span>
                                <b class="text-xl">→</b>
                                <span class="text-red-500 font-bold">{{ $task->end_date }}</span>
                            </p>
                            <div class="flex gap-3 items-baseline">
                                <form id="delete-form-{{ $task->id }}"
                                    action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <!-- Tombol Delete -->
                                <button data-tooltip-target="tooltip-delete-{{ $task->id }}" type="button"
                                    class="text-red-500 hover:text-red-700 delete-btn"
                                    data-task-id="{{ $task->id }}">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                                <div id="tooltip-delete-{{ $task->id }}" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 rounded-lg shadow-sm opacity-0 !bg-red-500">
                                    Delete task
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>

                                <!-- Tombol Edit -->
                                <button data-tooltip-target="tooltip-edit-{{ $task->id }}" type="button">
                                    <i class="fa-solid fa-pen-to-square text-blue-500 hover:text-blue-700"
                                        style="{{ $task->completed ? 'display: none;' : '' }}"
                                        data-modal-target="edit-modal-{{ $task->id }}"
                                        data-modal-toggle="edit-modal-{{ $task->id }}">
                                    </i>
                                </button>
                                <div id="tooltip-edit-{{ $task->id }}" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 rounded-lg shadow-sm opacity-0 !bg-blue-600">
                                    Edit task
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="w-full md:w-1/2 lg:w-1/2 h-[73vh] bg-white rounded-lg shadow-xl p-6 overflow-hidden">
        <div class="h-full flex flex-col" id="task-detail" data-task-id="{{-- $task->id ?? '' --}}"
            data-completed="{{ $task->completed ? 'true' : 'false' }}">
            <div class="flex flex-col justify-center gap-2 mb-2">
                <div id="priority-label"
                    class="px-4 py-2 bg-blue-500 text-white rounded-sm text-sm text-center font-medium">
                    No task selected</div>
                <h1 class="text-3xl font-bold mb-1" id="task-name">Select the task</h1>
                <p id="task-description">No description</p>
            </div>
            <hr class="py-1">
            <div class="flex-1">
                <div class="space-y-3" id="subtasks"></div>
                <!-- Subtasks List -->
                <h4 class="text-lg font-semibold">Subtasks :</h4>
                <div class="my-4 max-h-[27vh] overflow-y-auto scrollable-div pr-2">
                    <ul id="subtasks-list" class="space-y-2">
                        <!-- Subtasks will be loaded here -->
                    </ul>
                </div>
                <!-- Form Tambah Subtask -->
                <form onsubmit="addSubtask(event)" class="mb-4 flex">
                    <input type="text" id="new-subtask-name" class="border border-gray-300 rounded-lg p-2 flex-grow"
                        placeholder="Add subtask..." required />
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg ml-2 hover:bg-blue-500">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </form>

            </div>

            <div class="pt-3 border-t border-gray-300">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-2">
                        <button type="button" id="mark-as-complete"
                            class="focus:outline-none text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                            Save as completed
                        </button>
                    </div>
                    <form id="task-form">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        {{-- <div class="space-y-3" id="subtasks"></div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('sort')
    <script src="{{ asset('js/sort.js') }}"></script>
@endpush
@push('tasks')
    <script src="{{ asset('js/tasks.js') }}"></script>
@endpush
@push('subtasks')
    <script src="{{ asset('js/subtasks.js') }}"></script>
@endpush
@push('toastr')
    <script src="{{ asset('js/toastr.js') }}"></script>
@endpush
@push('sweetalert')
    <script src="{{ asset('js/sweetalert.js') }}"></script>
@endpush

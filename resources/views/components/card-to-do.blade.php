<div class="flex flex-col md:flex-row max-h-full min-h-full w-full z-40 mx-auto justify-between gap-14 py-28 px-20">
    <div class="w-full md:w-1/2 lg:w-1/2 h-[73vh] overflow-y-auto scrollable-div pr-2">
        <div class="flex flex-col gap-4" id="task-list">
            @if ($tasks->isEmpty())
                <div class="text-center text-gray-500 my-4">Tidak ada task yang tersedia</div>
            @else
                @foreach ($tasks as $task)
                    <div onclick="fetchTaskDetail({{ $task->id }})" data-priority="{{ $task->priority }}"
                        class="task w-full p-5 bg-white border rounded-lg shadow-xl cursor-pointer hover:shadow-2xl transition-shadow">
                        <div class="flex items-center justify-between">
                            <h5
                                class="text-2xl font-bold tracking-tight text-gray-900 {{ $task->completed ? 'line-through' : '' }}">
                                {{ $task->name }}
                            </h5>
                            <div class="flex gap-2">
                                <i
                                    class="fa-solid fa-circle {{ $task->priority == 'high' ? 'text-red-600' : ($task->priority == 'medium' ? 'text-yellow-400' : 'text-green-500') }}"></i>
                            </div>
                        </div>
                        <p class="font-normal text-gray-700 mt-2">{{ $task->description }}</p>
                        <hr class="my-4 border-gray-300">
                        <div class="flex justify-between items-center text-sm text-gray-600">
                            <p>{{ $task->start_date }} | {{ $task->end_date }}</p>
                            <div class="flex gap-3 items-baseline">
                                <form  action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                                <i class="fa-solid fa-pen-to-square text-blue-500 hover:text-blue-700"
                                    data-modal-target="edit-modal-{{ $task->id }}"
                                    data-modal-toggle="edit-modal-{{ $task->id }}"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="w-full md:w-1/2 lg:w-1/2 h-[73vh] bg-white rounded-lg shadow-xl p-6 overflow-hidden">
        <div class="h-full flex flex-col" id="task-detail">
            <div class="flex flex-col justify-center gap-2 mb-2">
                <div id="priority-label"
                    class="px-4 py-2 bg-blue-500 text-white rounded-sm text-sm text-center font-medium">Tidak Ada Task
                    Yang Dipilih</div>
                <h1 class="text-3xl font-bold mb-1" id="task-name">Pilih task</h1>
                <p id="task-description">Tidak ada deskripsi</p>
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
                        <div>
                            <i id="task-completed"
                                class="fa-regular fa-circle text-blue-600 text-lg cursor-pointer"></i>
                        </div>
                        <span class="text-sm text-gray-600">Mark as Completed</span>
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
<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
    };
</script>

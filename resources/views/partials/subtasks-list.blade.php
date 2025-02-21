<ul id="subtasks-list">
    @foreach ($task->subtasks as $subtask)
        <li data-id="{{ $subtask->id }}" class="flex items-center border rounded-lg p-4 bg-white">
            <input disabled ="checkbox" class="mr-3"
                onchange="toggleSubtaskCompletion({{ $task->id }}, {{ $subtask->id }}, this)" 
                {{ $subtask->is_completed ? 'checked' : '' }} />

                <div class=" {{ $subtask->is_completed ? 'relative inline-block' : '' }} ">
                    <span class="text-lg {{ $subtask->is_completed ? 'text-gray-400' : 'text-gray-700' }}">
                        {{ $subtask->name }}
                    </span>
                    <div class="{{ $subtask->is_completed ? 'absolute bottom-[0.6rem] w-full border-2 border-gray-400 border-t' : '' }}"></div>
                </div>
            <button class="ml-auto text-red-500" onclick="deleteSubtask({{ $subtask->id }}, {{ $task->id }})">
                <i class="fa-solid fa-trash"></i>
            </button>
        </li>
    @endforeach
</ul>

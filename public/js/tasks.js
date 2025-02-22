async function fetchTaskDetail(taskId) {
    if (!taskId) {
        console.warn("Task ID tidak valid.");
        return;
    }

    try {
        let response = await fetch(`/tasks/${taskId}`);
        let task = await response.json();

        console.log("Task Data:", task);
        document.getElementById("task-name").innerText = task.name;
        document.getElementById("task-description").innerText = task.description || "Tidak ada deskripsi";

        let priorityLabel = document.getElementById("priority-label");
        priorityLabel.innerText = task.priority.charAt(0).toUpperCase() + task.priority.slice(1);
        priorityLabel.className = `px-4 py-2 text-white rounded-sm text-sm text-center font-medium ${
            task.priority === "high" ? "bg-red-500" :
            task.priority === "medium" ? "bg-yellow-400" : "bg-green-500"
        }`;

        let subtaskList = document.getElementById("subtasks-list");
        subtaskList.innerHTML = "";

        if (task.subtasks && task.subtasks.length > 0) {
            task.subtasks.forEach(subtask => {
                let subtaskItem = document.createElement("li");
                subtaskItem.setAttribute("data-id", subtask.id);
                subtaskItem.classList.add("flex", "items-center", "border", "rounded-lg", "p-4", "bg-white", "dark:bg-gray-700", "dark:border-gray-500");

                subtaskItem.innerHTML = `
                    <input type="checkbox" ${subtask.is_completed ? "checked disabled" : ""} class="mr-3" 
                        onchange="toggleSubtaskCompletion(${taskId}, ${subtask.id}, this)" />
                    
                    <div class=" ${subtask.is_completed ? "relative inline-block" : ""} ">
                        <span class="text-lg ${subtask.is_completed ? "text-lg text-gray-300" : "text-gray-700 dark:text-white"}">
                            ${subtask.name}
                        </span>
                        <div class=" ${subtask.is_completed ? "absolute bottom-[0.6rem] w-full border-2 border-gray-300 border-t" : ""} "></div>
                    </div>

                    ${task.completed ? "" : `
                        <button class="ml-auto text-red-500" onclick="deleteSubtask(${subtask.id}, ${taskId})">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    `}
                `;
                subtaskList.appendChild(subtaskItem);
            });
        }

        document.getElementById("task-detail").setAttribute("data-task-id", taskId);
        document.getElementById("task-detail").setAttribute("data-completed", task.completed ? "true" : "false");

    } catch (error) {
        toastr.error("Gagal mengambil detail task");
    }
}

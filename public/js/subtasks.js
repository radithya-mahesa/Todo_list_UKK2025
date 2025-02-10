function addSubtask(event) {
    event.preventDefault();

    let taskId = document.getElementById("task-detail").getAttribute("data-task-id");
    let subtaskName = document.getElementById("new-subtask-name").value.trim();

    if (!taskId || subtaskName === "") {
        toastr.warning("Pilih task terlebih dahulu dan isi nama subtask.");
        return;
    }

    fetch(`/tasks/${taskId}/subtasks`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
            body: JSON.stringify({
                name: subtaskName
            })
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById("new-subtask-name").value = "";

            let subtaskList = document.getElementById("subtasks-list");
            let subtaskItem = document.createElement("li");
            subtaskItem.classList.add("flex", "items-center", "border", "rounded-lg", "p-4", "bg-white");

            subtaskItem.innerHTML = `
            <input type="checkbox" onchange="toggleSubtaskCompletion(${taskId}, ${data.id}, this)" class="mr-3" />
            
            <div class="relative inline-block">
                <span class="text-lg text-gray-700">${data.name}</span>
                <div class="absolute bottom-[0.6rem] w-full border-2 border-gray-400 border-t opacity-0 invisible"></div>
            </div>

            <button class="ml-auto text-red-500" onclick="deleteSubtask(${data.id}, ${taskId})">
                <i class="fa-solid fa-trash"></i>
            </button>
        `;

            subtaskList.appendChild(subtaskItem);
            toastr.success("Subtask berhasil ditambahkan!");
        })
        .catch(error => toastr.error("Gagal menambahkan subtask"));
}



function toggleSubtaskCompletion(taskId, subtaskId, checkbox) {
    let isCompleted = checkbox.checked; // Cek apakah checkbox dicentang

    fetch(`/subtasks/${subtaskId}/status`, {
            method: "PATCH",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
            body: JSON.stringify({
                is_completed: isCompleted
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let wrapperDiv = checkbox.nextElementSibling; // Div pembungkus span
                if (!wrapperDiv) return;

                let textElement = wrapperDiv.querySelector("span"); // Ambil teks
                let lineElement = wrapperDiv.querySelector("div"); // Ambil garis bawah

                if (textElement) {
                    textElement.classList.toggle("text-gray-400", isCompleted);
                    textElement.classList.toggle("text-gray-700", !isCompleted);
                }

                if (lineElement) {
                    lineElement.classList.toggle("hidden", !isCompleted);
                }
            }
        })
        .catch(error => console.error("Error updating subtask status:", error));
}


// Fungsi untuk memuat ulang daftar subtasks
function loadSubtasks(taskId) {
    fetch(`/tasks/${taskId}/subtasks`)
        .then(response => response.text())
        .then(html => {
            document.getElementById("subtasks-list").innerHTML = html;
        })
        .catch(error => console.error('Error:', error));
}

function toggleSubtaskCompletion(taskId, subtaskId, checkbox) {
    let isCompleted = checkbox.checked; // Cek apakah checkbox dicentang

    fetch(`/subtasks/${subtaskId}/status`, {
            method: "PATCH",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
            body: JSON.stringify({
                is_completed: isCompleted
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let wrapperDiv = checkbox.nextElementSibling; // Div pembungkus span
                if (!wrapperDiv) return;

                let textElement = wrapperDiv.querySelector("span"); // Ambil teks
                let lineElement = wrapperDiv.querySelector("div"); // Ambil garis bawah

                if (textElement) {
                    textElement.classList.toggle("text-gray-400", isCompleted);
                    textElement.classList.toggle("text-gray-700", !isCompleted);
                }

                if (lineElement) {
                    if (isCompleted) {
                        lineElement.style.opacity = "1";
                        lineElement.style.visibility = "visible";
                    } else {
                        lineElement.style.opacity = "0";
                        lineElement.style.visibility = "hidden";
                    }
                }
            }
        })
        .catch(error => console.error("Error updating subtask status:", error));
}
function deleteSubtask(subtaskId, taskId) {
    if (!subtaskId || !taskId) {
        console.warn("Subtask ID atau Task ID tidak valid.");
        return;
    }

    fetch(`/subtasks/${subtaskId}`, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
        })
        .then(response => {
            if (!response.ok) throw new Error("Gagal menghapus subtask.");
            return response.json();
        })
        .then(() => {
            toastr.success("Subtask berhasil dihapus!");
            // Hapus elemen subtask dari UI
            const subtaskElement = document.querySelector(`li[data-id='${subtaskId}']`);
            if (subtaskElement) {
                subtaskElement.remove();
            }
        })
        .catch(error => {
            console.error("Error deleting subtask:", error);
            toastr.error("Subtask telah dihapus");
        });
}

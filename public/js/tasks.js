function fetchTaskDetail(taskId) {
    if (!taskId) {
        console.warn("Task ID tidak valid.");
        return;
    }
    fetch(`/tasks/${taskId}`)
        .then(response => response.json())
        .then(task => {
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
                    subtaskItem.classList.add("flex", "items-center", "border", "rounded-lg", "p-4",
                        "bg-white");

                    subtaskItem.innerHTML = `
                        <input type="checkbox" ${subtask.is_completed ? "checked" : ""} class="mr-3"} 
                            onchange="toggleSubtaskCompletion(${taskId}, ${subtask.id}, this)" />
                        
                        <div class=" ${subtask.is_completed ? "relative inline-block" : ""} ">
                            <span class="text-lg ${subtask.is_completed ? "text-lg text-gray-400" : "text-gray-700"}">
                                ${subtask.name}
                            </span>
                            <div class=" ${subtask.is_completed ? "absolute bottom-[0.6rem] w-full border-2 border-gray-400 border-t" : "" } "></div>
                        </div>
                        <button class="ml-auto text-red-500" onclick="deleteSubtask(${subtask.id}, ${taskId})">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    `;
                    subtaskList.appendChild(subtaskItem);
                });
            }

            document.getElementById("task-detail").setAttribute("data-task-id", taskId);
        })
        .catch(error => toastr.error("Gagal mengambil detail task"));
}

// document.addEventListener("DOMContentLoaded", function() {
//     document.querySelectorAll(".fa-trash-can").forEach((trashIcon) => {
//         trashIcon.addEventListener("click", function() {
//             let taskId = this.getAttribute("data-task-id");
//             let deleteUrl = this.getAttribute("data-delete-url");

//             if (!taskId) {
//                 toastr.error("Task tidak ditemukan!");
//                 return;
//             }

//             if (!confirm("Apakah Anda yakin ingin menghapus task ini?")) {
//                 return;
//             }

//             fetch(`/tasks/${taskId}`, {
//                     method: "DELETE",
//                     headers: {
//                         "X-CSRF-TOKEN": document.querySelector(
//                             'meta[name="csrf-token"]').content,
//                         "Content-Type": "application/json",
//                     },
//                 })
//                 .then((response) => {
//                     if (response.ok) {
//                         toastr.success("Task berhasil dihapus!");
//                         this.closest(".task").remove(); // Hapus elemen task dari DOM
//                     } else {
//                         toastr.error("Gagal menghapus task.");
//                     }
//                 })
//                 .catch((error) => {
//                     console.error("Error:", error);
//                     toastr.error("Terjadi kesalahan saat menghapus task.");
//                 });
//         });
//     });
// });

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
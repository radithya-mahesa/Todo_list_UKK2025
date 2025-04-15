async function addSubtask(event) {
    event.preventDefault();

    let taskDetail = document.getElementById("task-detail");
    let taskId = taskDetail.getAttribute("data-task-id");
    let taskCompleted = taskDetail.getAttribute("data-completed") === "true";
    let subtaskName = document.getElementById("new-subtask-name").value.trim();

    if (!taskId) {
        toastr.warning("Pilih task terlebih dahulu!");
        return;
    }

    if (taskCompleted) {
        toastr.warning("Task ini sudah selesai!");
        return;
    }

    if (subtaskName === "") {
        toastr.warning("Isi nama subtask terlebih dahulu!");
        return;
    }

    try {
        let response = await fetch(`/tasks/${taskId}/subtasks`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
            body: JSON.stringify({ name: subtaskName })
        });

        let data = await response.json();
        console.log("Response dari server:", data);

        if (!data.success) {
            toastr.error("Gagal menambahkan subtask.");
            return;
        }

        document.getElementById("new-subtask-name").value = "";

        let subtaskList = document.getElementById("subtasks-list");
        let subtaskItem = document.createElement("li");
        subtaskItem.classList.add("flex", "items-center", "border", "rounded-lg", "p-4", "bg-white", "dark:bg-gray-700", "dark:border-gray-500");
        subtaskItem.setAttribute("data-id", data.subtask.id);


        let subtaskDisabled = taskCompleted ? "disabled" : "";

        subtaskItem.innerHTML = `
            <input type="checkbox" ${subtaskDisabled} onchange="toggleSubtaskCompletion(${taskId}, ${data.subtask.id}, this)" class="mr-3" />
            
            <div class="relative inline-block">
                <span class="text-lg text-gray-700 dark:text-white">
                    ${data.subtask.name}
                </span>
                <div class="hidden absolute bottom-[0.6rem] w-full border-2 border-gray-400 border-t"></div>
            </div>

            <button class="ml-auto text-red-500" onclick="deleteSubtask(${data.subtask.id}, ${taskId})">
                <i class="fa-solid fa-trash"></i>
            </button>
        `;

        subtaskList.appendChild(subtaskItem);
        toastr.success("Subtask berhasil ditambahkan!");

    } catch (error) {
        console.error("Error:", error);
        toastr.error("Terjadi kesalahan dalam menghubungi server.");
    }
}

async function toggleSubtaskCompletion(taskId, subtaskId, checkbox) {
    let isCompleted = checkbox.checked;

    try {
        let response = await fetch(`/subtasks/${subtaskId}/status`, {
            method: "PATCH",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
            body: JSON.stringify({ is_completed: isCompleted })
        });

        let data = await response.json();

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

            wrapperDiv.classList.add("opacity-50");
            setTimeout(() => {
                wrapperDiv.classList.remove("opacity-50");
            }, 300);
        }
    } catch (error) {
        console.error("Error updating subtask status:", error);
    }
}

// Fungsi untuk memuat ulang daftar subtasks
async function loadSubtasks(taskId) {
    try {
        let response = await fetch(`/tasks/${taskId}/subtasks`);
        let html = await response.text();
        document.getElementById("subtasks-list").innerHTML = html;
    } catch (error) {
        console.error('Error:', error);
    }
}

async function deleteSubtask(subtaskId, taskId) {
    if (!subtaskId || !taskId) {
        console.warn("Subtask ID atau Task ID tidak valid.");
        return;
    }

    try {
        let response = await fetch(`/subtasks/${subtaskId}`, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
        });

        if (!response.ok) throw new Error("Gagal menghapus subtask.");

        await response.json();

        toastr.success("Subtask berhasil dihapus!");
        // Hapus elemen subtask dari UI
        const subtaskElement = document.querySelector(`li[data-id='${subtaskId}']`);
        if (subtaskElement) {
            subtaskElement.remove();
        }
    } catch (error) {
        console.error("Error deleting subtask:", error);
        toastr.error("Terjadi kesalahan saat menghapus subtask.");
    }
}

document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("mark-as-complete").addEventListener("click", async function () {
        let taskDetail = document.getElementById("task-detail");
        let taskId = taskDetail.getAttribute("data-task-id");
        let isCompleted = taskDetail.getAttribute("data-completed") === "true"; // Pastikan nilainya boolean

        if (!taskId) {
            toastr.warning("Pilih task terlebih dahulu!");
            return;
        }

        if (isCompleted) {
            toastr.warning("Task ini sudah selesai!");
            return;
        }

        try {
            let response = await fetch(`/tasks/${taskId}/complete`, {
                method: "PATCH",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                },
            });

            let data = await response.json();

            if (data.success) {
                taskDetail.setAttribute("data-completed", "true"); // Update status agar tidak bisa diklik lagi
                document.getElementById("task-name").classList.add("line-through");
                toastr.success(data.message);
                setTimeout(() => {
                    location.reload(); // Reload halaman setelah sukses
                }, 5000);
            } else {
                toastr.error("Gagal menyelesaikan task.");
            }
        } catch (error) {
            toastr.error("Terjadi kesalahan.");
        }
    });
});

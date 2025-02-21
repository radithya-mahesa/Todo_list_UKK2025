const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
function sortTasksByPriority() {
    const taskList = document.getElementById('task-list');
    const tasks = Array.from(taskList.getElementsByClassName('task'));

    tasks.sort((a, b) => {
        const priorityA = a.getAttribute('data-priority');
        const priorityB = b.getAttribute('data-priority');

        const priorityOrder = {
            'high': 3,
            'medium': 2,
            'normal': 1
        };

        return priorityOrder[priorityB] - priorityOrder[priorityA];
    });

    taskList.innerHTML = ''; // clear content dengan id tasks-list
    tasks.forEach(task => taskList.appendChild(task)); // Tambahkan tasks yang sudah disortir
}

function restoreOriginalOrder() {
    location.reload(); // refresh page (tampilan semula)
}

function showCompletedTasks() {
    const taskList = document.getElementById('task-list');
    const tasks = Array.from(taskList.getElementsByClassName('task'));

    let hasCompleted = false;

    tasks.forEach(task => {
        const isCompleted = task.getAttribute('data-completed') === "1" || task.getAttribute('data-completed') === "true";
        if (isCompleted) {
            task.style.display = "block"; // Tampilkan task yang completed
            hasCompleted = true;
        } else {
            task.style.display = "none"; // Sembunyikan task yang belum completed
        }
    });

    // Kalau tidak ada task completed, tampilkan pesan
    if (!hasCompleted) {
        taskList.innerHTML = `<div class="text-center text-gray-500 my-4">Tidak ada task yang selesai</div>`;
    }
}

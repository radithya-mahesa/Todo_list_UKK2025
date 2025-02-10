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
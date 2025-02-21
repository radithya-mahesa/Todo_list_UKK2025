document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault(); // Mencegah form langsung terkirim

            let taskId = this.getAttribute("data-task-id");

            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Task yang dihapus tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${taskId}`).submit();
                }
            });
        });
    });
});
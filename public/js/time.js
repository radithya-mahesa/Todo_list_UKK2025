function updateClockAndIcon() {
    const clock = document.getElementById('digital-clock');
    const icon = document.getElementById('time-icon');
    const now = new Date();

    // Ambil jam, menit, dan detik
    const hours = now.getHours().toString().padStart(2, '0');
    const minutes = now.getMinutes().toString().padStart(2, '0');
    const seconds = now.getSeconds().toString().padStart(2, '0');

    // HH:MM:SS
    clock.textContent = `${hours}:${minutes}:${seconds}`;

    // set ikon berdasarkan waktu
    if (hours >= 5 && hours < 11) {
        // Pagi (5 AM - 11 AM)
        icon.className = "fa-solid fa-sun text-white";
    } else if (hours >= 11 && hours < 15) {
        // Siang (11 AM - 5 PM)
        icon.className = "fa-solid fa-cloud-sun text-white";
    } else if (hours >= 15 && hours < 18) {
        // Sore (5 PM - 8 PM)
        icon.className = "fa-solid fa-sun text-white";
    } else {
        // Malam (8 PM - 5 AM)
        icon.className = "fa-solid fa-cloud-moon text-white";
    }
}

// Jalankan fungsi updateClockAndIcon setiap detik
setInterval(updateClockAndIcon, 1000);

// Panggil langsung saat halaman pertama kali diload
updateClockAndIcon();
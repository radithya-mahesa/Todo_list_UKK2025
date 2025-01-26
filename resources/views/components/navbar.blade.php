<header class="bg-[#578E7E] shadow-lg rounded-md fixed top-6 left-6 sm:left-20 p-2 right-6 sm:right-20 z-999">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="text-xl font-bold text-gray-800 flex gap-1">
            <span id="digital-clock"></span> |
            <i id="time-icon" class="fa-solid fa-sun"></i>
            <h1>{{ $greeting }}</h1>
        </div>
        
        <nav class="hidden sm:block">
            <ul class="flex space-x-6 text-gray-600">
                <li><a href="#" class="text-gray-300 hover:text-blue-400"><i class="fa-solid fa-list-check"></i></a></li>
                <li><a href="#" class="text-gray-300 hover:text-gray-500"><i class="fa-solid fa-gear"></i></a></li>
                <li><a href="#" class="text-gray-300 hover:text-red-400"><i class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
            </ul>
        </nav>

        <div class="sm:hidden">
            <button id="hamburger" class="text-gray-800 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>

    <div id="mobile-menu" class="sm:hidden hidden bg-white shadow-md py-4 mt-2">
        <ul class="space-y-4 text-gray-600 text-center">
            <li><a href="#" class="hover:text-blue-500">Home</a></li>
            <li><a href="#" class="hover:text-blue-500">About</a></li>
            <li><a href="#" class="hover:text-blue-500">Projects</a></li>
            <li><a href="#" class="hover:text-blue-500">Contact</a></li>
        </ul>
    </div>
  </header>
  <script>
    function updateClockAndIcon() {
        const clock = document.getElementById('digital-clock');
        const icon = document.getElementById('time-icon');
        const now = new Date();

        // Ambil jam, menit, dan detik
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');

        // Format waktu (HH:MM:SS)
        clock.textContent = `${hours}:${minutes}:${seconds}`;

        // Tentukan ikon berdasarkan waktu
        if (hours >= 5 && hours < 11) {
            // Pagi (5 AM - 11 AM)
            icon.className = "fa-solid fa-sun text-[#FFFAEC]";
        } else if (hours >= 11 && hours < 15) {
            // Siang (11 AM - 5 PM)
            icon.className = "fa-solid fa-cloud-sun text-[#FFFAEC]";
        } else if (hours >= 15 && hours < 18) {
            // Sore (5 PM - 8 PM)
            icon.className = "fa-solid fa-sun text-orange-[#FFFAEC]";
        } else {
            // Malam (8 PM - 5 AM)
            icon.className = "fa-solid fa-cloud-moon text-[#FFFAEC]";
        }
    }

    // Jalankan fungsi updateClockAndIcon setiap detik
    setInterval(updateClockAndIcon, 1000);

    // Panggil langsung saat halaman pertama kali diload
    updateClockAndIcon();
</script>

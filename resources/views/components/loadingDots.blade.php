<div id="loading-dots" class="fixed inset-0 z-[100] flex items-center justify-center bg-black bg-opacity-50">
    <div class="flex space-x-2">
        <div class="w-6 h-6 mr-0 bg-red-500 rounded-full animate-bounce [animation-delay:-0.3s]"></div>
        <div class="w-6 h-6 bg-amber-300 rounded-full animate-bounce [animation-delay:-0.15s]"></div>
        <div class="w-6 h-6 bg-lime-500 rounded-full animate-bounce"></div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const loadingDots = document.getElementById("loading-dots");

        // dots muncul ketika web sedang load
        window.addEventListener("beforeunload", function() {
            loadingDots.classList.remove("hidden");
        });

        // dots hilang setelah di-load
        window.addEventListener("pageshow", function() {
            loadingDots.classList.add("hidden");
        });
    });
</script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('icon.png') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <title>To Do</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <x-loadingDots />
    <div
        class="relative h-screen bg-gray-700 bg-blend-multiply overflow-hidden lg:flex lg:flex-col lg:items-center lg:justify-center"">
        <div class="absolute bg-gray-500 bg-blend-multiply inset-0 bg-[url('/assets/dashboard.png')] bg-center bg-no-repeat bg-cover filter blur-md"></div>
            <div class="relative z-40 h-full w-full">
                <nav class="absolute bg-transparent w-full flex items-center justify-end mx-auto px-6 pt-6">
                    <x-navbar-landing />
                </nav>
                <div class="flex items-center content-center justify-center h-screen">
                    <x-login />
                </div>
        </div>
        <img src="{{ asset('svg/waves.svg') }}" alt="Wave"
                    class="w-full absolute bottom-0 pointer-events-none select-none" draggable="false">
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    @if (session('error'))
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-center",
                };
                toastr.error("{{ session('error') }}");
            });
        </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
{{-- login-page.blade.php --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.css" rel="stylesheet">
    <title>To Do</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="h-screen bg-[#34626C]">
        <img src="{{ asset('svg/wave-solid.svg') }}" class="absolute" alt="waves-solid">
        @include('components.navbar')

        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 py-8">
            <x-card-to-do />
        </div>
        <x-bottom-navigation />
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
    <script src="https://kit.fontawesome.com/0be59eadaf.js" crossorigin="anonymous"></script>
</body>

</html>

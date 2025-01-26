<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.css" rel="stylesheet">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <nav class="absolute bg-transparent">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto px-6 pt-6">
            <x-header />
        </div>
    </nav>
    <div class="h-screen bg-center bg-no-repeat bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/conference.jpg')] bg-gray-700 bg-blend-multiply overflow-hidden">>
        <div class="flex items-center content-center justify-center h-screen">
            <x-login />
        </div>
    </div>
    <img src="{{ asset('svg/wave.svg') }}" alt="Wave" class="w-full absolute bottom-0">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
</body>
</html>

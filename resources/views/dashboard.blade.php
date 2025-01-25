<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To Do</title>
    <script src="https://kit.fontawesome.com/0be59eadaf.js" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-[#FFFAEC]">
    @include('components.navbar')
    <x-bottom-navigation/>
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 py-8">
        <x-card-to-do/>
    </div>
</body>
</html>

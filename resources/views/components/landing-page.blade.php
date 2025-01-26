<section
    class="h-screen bg-center bg-no-repeat bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/conference.jpg')] bg-gray-700 bg-blend-multiply overflow-hidden">
    <nav class="border-gray-200 bg-transparent">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto px-6 pt-6">
            <x-header />
        </div>
    </nav>
    <div class=" w-full mb-[100px] ustify-normal md:flex md:flex-row md:justify-around flex flex-col items-center">
        <div class="px-4 md:w-[50%] z-10 max-w-screen-xl text-left py-10 lg:py-[10rem]">
            <x-title />
        </div>
        <div class="hidden md:block w-full h-full z-10px-1 md:w-1/4 text-left py-10 lg:py-[10rem]">
            <x-login />
        </div>
    </div>
    <img src="{{ asset('svg/wave.svg') }}" alt="Wave" class="w-full absolute bottom-0">
</section>

{{-- landing-page.blade.php --}}
<section class="relative h-screen bg-gray-700 bg-blend-multiply overflow-hidden lg:flex lg:flex-col lg:items-center lg:justify-center">
    <div class="absolute bg-gray-500 bg-blend-multiply inset-0 bg-[url('/assets/dashboard.png')] bg-center bg-no-repeat bg-cover filter blur-sm"></div>
    <div class="relative z-10 h-full">
        <nav class="border-gray-200 bg-transparent">
            <nav class="fixed z-40 bg-transparent w-full flex items-center justify-end mx-auto px-6 pt-6">
                <x-navbar-landing />
            </nav>
        </nav>
        <div
            class="w-full h-full mb-[100px] md:flex md:flex-row md:justify-around flex flex-col items-center justify-center">
            <div class="px-4 md:w-[60%] z-10 max-w-screen-xl text-left py-10 lg:py-[10rem]">
                <x-title />
            </div>
            <div class="hidden lg:block w-full h-full z-10 px-1 lg:w-1/4 text-left py-10 lg:py-[10rem]">
                <x-register />
            </div>
        </div>
    </div>
    <img src="{{ asset('svg/waves.svg') }}" alt="Wave" class="w-full absolute bottom-0">
</section>

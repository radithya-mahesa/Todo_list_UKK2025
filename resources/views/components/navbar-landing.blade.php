<div class="flex-row w-full flex md:w-auto flex-grow justify-between" id="navbar-solid-bg">
  <div class="flex">
      <a href="#" class="text-4xl font-bold text-sky-400">My</a>
      <img src="{{ asset('assets/to-do.png') }}" class="h-10" alt="todo">
  </div>
  <div class="flex gap-7">
    <a href="/" class="content-baseline group relative">
      <h1 class="text-white text-xl font-medium mt-1">
        Home
        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-yellow-400 group-hover:w-full transition-all duration-300"></span>
      </h1>
    </a>

    {{-- Tombol dinamis Login/Register --}}
    <a 
      href="{{ Request::is('/') ? route('login') : route('home') }}" {{-- Logic href --}}
      class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">
      @if (Request::is('/'))
        Login {{-- Teks Login untuk Home --}}
      @elseif (Request::is('login'))
        Register {{-- Teks Register untuk Halaman Login --}}
      @endif
    </a>
  </div>
</div>

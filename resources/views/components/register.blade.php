<div class="bg-white min-w-[40vh] z-50 p-4 rounded-lg border-4 border-[#578E7E] shadow-[0_10px_0_0_#578E7E]" data-aos="fade-left" data-aos-duration="1000">
    <form action="{{ route('register') }}" method="POST" class="max-w-sm mx-auto">
        @csrf
        <div class="mb-5">
            <label for="name" class="block mt-5 mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                Username</label>
            <input type="text" name="username" id="username"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="e.g Ellen Joe" required />
        </div>
        <div class="mb-5">
            <label for="email" class="block mt-5 mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                email</label>
            <input type="email" name="email" id="email"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="example@email.com" required />
        </div>
        <div class="mb-5">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                password</label>
            <input type="password" name="password" id="password" minlength="8"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required />
        </div>
        <div class="mb-5">
            <label for="password_confirmation"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" minlength="8"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required />
        </div>
        <div class="!mt-8">
            <button type="submit"
                class="w-full py-3 px-4 text-sm tracking-wide rounded-lg text-white bg-green-500 hover:bg-blue-700 focus:outline-none">
                Sign up
            </button>
        </div>
        <p class="text-gray-800 text-sm !mt-8 text-center">Have an account? <a href="/login"
                class="text-blue-600 hover:underline ml-1 whitespace-nowrap font-semibold">Login here</a></p>
    </form>
    </form>
</div>

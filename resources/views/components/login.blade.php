<div class="bg-white z-50 p-4 rounded-lg border-4 border-[#578E7E] shadow-[0_10px_0_0_#578E7E]" data-aos="fade-down" data-aos-duration="1000">
    <form action="{{ route('login') }}" method="POST" class="max-w-sm mx-auto">
        @csrf
        <div class="mb-5">
            <label for="email" class="block mt-5 mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                email</label>
            <input type="email" name="email" id="email"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="name@jillvalentine.com" required />
        </div>
        <div class="mb-5">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                password</label>
            <input type="password" name="password" id="password" minlength="8"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required />
        </div>
        <div class="flex items-start mb-5">
            <div class="flex items-center h-5">
                <input id="remember" type="checkbox" name="remember"
                    class="w-4 h-4 border border-gray-300 rounded-sm bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                    />
            </div>
            <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember
                me</label>
        </div>
        <div class="!mt-8">
            <button type="submit"
                class="w-full py-3 px-4 text-sm tracking-wide rounded-lg text-white bg-green-500 hover:bg-blue-700 focus:outline-none">
                Sign in
            </button>
        </div>
        <p class="text-gray-800 text-sm !mt-8 text-center">Don't have an account? <a href="/"
                class="text-blue-600 hover:underline ml-1 whitespace-nowrap font-semibold">Register here</a></p>
    </form>
    </form>
</div>
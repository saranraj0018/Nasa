<x-layouts.auth>
    <div class="min-h-screen flex items-center justify-center bg-cover bg-center relative"
        style="background-image: url('{{ asset('login.png') }}'); background-size: cover;">

        {{-- Optional Overlay --}}
        <div class="absolute inset-0 bg-purple-900/40"></div>

        {{-- Main Content --}}
        <div
            class="relative z-10 flex flex-col md:flex-row items-center justify-center bg-white/5 backdrop-blur-sm rounded-3xl shadow-lg overflow-hidden w-11/12 md:w-4/5 lg:w-3/4 p-4">

            {{-- Left Section --}}
            <div class="md:w-1/2 text-center md:text-left text-white p-4 md:p-6">
                <h1 class="text-2xl font-bold mb-2 text-pink-400">NON ACADEMIC STUDENT ACTIVITY</h1>
                <h2 class="text-xl font-semibold text-pink-400 mb-4">NASA Student Portal</h2>
                <p class="text-sm leading-relaxed">
                    Embark on your journey to explore the courses and expand your
                    knowledge beyond boundaries
                </p>
            </div>

            {{-- Right Section - Login Card (Reduced Height) --}}
            <div class="bg-white rounded-2xl shadow-xl w-full md:w-2/5 p-6 md:p-8 relative z-20">

                {{-- Logo --}}
                <div class="flex items-center justify-center mb-3">
                    <img src="{{ asset('login_header.png') }}" alt="Rathinam" class="h-8">
                </div>

                <h2 class="text-center text-lg font-bold text-purple-700 mb-1">LOGIN</h2>
                <p class="text-center text-gray-600 text-xs mb-4">login to Stay Connected</p>

                <form method="POST" action="{{ route('login') }}" class="space-y-3">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-700">Email</label>
                        <input type="email" name="email" required
                            class="w-full mt-1 px-3 py-1.5 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-purple-500"
                            placeholder="you@example.com">
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-700">Password</label>
                        <input type="password" name="password" required
                            class="w-full mt-1 px-3 py-1.5 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-purple-500"
                            placeholder="••••••••">
                    </div>

                    {{-- Remember Me --}}
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember"
                            class="w-3.5 h-3.5 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                        <label for="remember" class="ml-2 text-xs text-gray-700">Remember me</label>
                    </div>

                    {{-- Login Button --}}
                    <button type="submit"
                        class="w-full py-1.5 bg-gradient-to-r from-purple-600 to-pink-500 text-white text-sm font-semibold rounded-full shadow-md hover:opacity-90 transition">
                        Login
                    </button>

                    <div class="text-center mt-2">
                        <a href="#" class="text-xs text-purple-600 hover:underline">Forget Password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.auth>

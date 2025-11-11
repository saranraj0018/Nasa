<x-layouts.auth>
    <div class="p-5 bg-cover bg-no-repeat h-[100vh] flex flex-col justify-center"
        style="background-image: url('{{ asset('/images/login.png') }}');">
        <div class="px-[1em] lg:px-[5em] xl:px-[5em] 2xl:px-[10em]">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                {{-- ADMIN CARD --}}
                <div class="text-center flex justify-center">
                    <div class="bg-white p-10 rounded-3xl w-full max-w-sm shadow-lg flex flex-col items-center space-y-6">
                        <div class="w-28 h-28 rounded-full bg-[#FFC8FA] border-4 border-white flex items-center justify-center shadow-md">
                            <img src="{{ asset('/images/admin.png') }}" alt="Admin"
                                class="w-16 h-16 rounded-full object-contain bg-white p-2">
                        </div>
                        <h1 class="text-2xl text-primary font-bold">ADMIN</h1>
                        <button type="submit"
                            class="w-40 py-2 bg-gradient-to-r from-primary to-pink-500 text-white text-sm font-semibold rounded-full shadow-md hover:opacity-90 transition">
                            Select Role <i class="fa-solid fa-arrow-right ml-1"></i>
                        </button>
                    </div>
                </div>

                {{-- SUPER ADMIN CARD --}}
                <div class="text-center flex justify-center">
                    <div class="bg-white p-10 rounded-3xl w-full max-w-sm shadow-lg flex flex-col items-center space-y-6">
                        <div class="w-28 h-28 rounded-full bg-[#FFC8FA] border-4 border-white flex items-center justify-center shadow-md">
                            <img src="{{ asset('/images/super_admin.png') }}" alt="Super Admin"
                                class="w-16 h-16 rounded-full object-contain bg-white p-2">
                        </div>
                        <h1 class="text-2xl text-primary font-bold">SUPER ADMIN</h1>
                        <button type="submit"
                            class="w-40 py-2 bg-gradient-to-r from-primary to-pink-500 text-white text-sm font-semibold rounded-full shadow-md hover:opacity-90 transition">
                            Select Role <i class="fa-solid fa-arrow-right ml-1"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.auth>

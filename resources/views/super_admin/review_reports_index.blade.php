<x-layouts.app>
    <!-- Header -->
    <div class="bg-[#F5E8F5] w-full h-[90px] rounded-full shadow-sm px-8 py-3 flex flex-col justify-center">
        <h3 class="font-semibold text-primary">Review Report</h3>
        <p class="text-sm text-gray-700">Submit comprehensive reports for completed events</p>
    </div>

    <!-- Overview Cards -->
    <section class="p-3 mt-4">
        <!-- Filters Section -->
        <h1 class="text-primary mt-8 font-semibold">Filters & Actions</h1>
        <div class="bg-white rounded-2xl shadow p-5 mt-3">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Search -->
                <div class="flex items-center bg-[#F2E8F5] rounded-full px-3">
                    <i class="fa fa-search"></i>
                    <input type="text" placeholder="Search admin reports"
                        class="w-full bg-transparent rounded-full px-4 py-2 focus:outline-none focus:ring-0">
                </div>
            </div>
        </div>


    </section>
</x-layouts.app>

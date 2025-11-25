<x-layouts.app>
    <!-- Header -->
    <div class="bg-[#F5E8F5] w-full h-[90px] rounded-full shadow-sm px-8 py-3 flex flex-col justify-center">
        <h3 class="font-semibold text-primary">Student Approval Management</h3>
        <p class="text-sm text-gray-700">Review and manage student event applications</p>
    </div>

    <!-- Overview Cards -->
    <section class="p-3 mt-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Total Applications -->
            <div class="bg-[#F3EDFF] rounded-2xl shadow p-5 flex flex-col justify-between">
                <p class="font-semibold text-gray-700 text-sm">Total Applications</p>
                <div class="flex items-center justify-between py-4">
                    <h3 class="text-3xl font-bold text-[#FF4757]">5</h3>
                    <img src="{{ asset('/images/total_applications.png') }}" alt="Total Applications" class="w-14 h-14">
                </div>
            </div>

            <!-- Pending -->
            <div class="bg-[#FFECE4] rounded-2xl shadow p-5 flex flex-col justify-between">
                <p class="font-semibold text-gray-700 text-sm">Pending</p>
                <div class="flex items-center justify-between py-4">
                    <h3 class="text-3xl font-bold text-[#F9C539]">3</h3>
                    <img src="{{ asset('/images/task_pending.png') }}" alt="Pending" class="w-14 h-14">
                </div>
            </div>

            <!-- Approved -->
            <div class="bg-[#DAECFF] rounded-2xl shadow p-5 flex flex-col justify-between">
                <p class="font-semibold text-gray-700 text-sm">Approved</p>
                <div class="flex items-center justify-between py-4">
                    <h3 class="text-3xl font-bold text-[#21FFD4]">7</h3>
                    <img src="{{ asset('/images/approved.png') }}" alt="Approved" class="w-14 h-14">
                </div>
            </div>

            <!-- Rejected -->
            <div class="bg-[#FFF6DE] rounded-2xl shadow p-5 flex flex-col justify-between">
                <p class="font-semibold text-gray-700 text-sm">Rejected</p>
                <div class="flex items-center justify-between py-4">
                    <h3 class="text-3xl font-bold text-[#FF683D]">2</h3>
                    <img src="{{ asset('/images/rejected.png') }}" alt="Rejected" class="w-14 h-14">
                </div>
            </div>
        </div>

        <!-- Filters Section -->
        <h1 class="text-primary mt-8 font-semibold">Filters & Actions</h1>
        <div class="bg-white rounded-2xl shadow p-5 mt-3">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Search -->
                <div class="flex items-center bg-[#F2E8F5] rounded-full px-3">
                    <i class="fa fa-search text-gray-500"></i>
                    <input type="text" placeholder="Search Students"
                        class="w-full bg-transparent rounded-full px-4 py-2 focus:outline-none focus:ring-0">
                </div>

                <!-- Status Filter -->
                <div class="bg-[#F2E8F5] rounded-full">
                    <select class="bg-[#F2E8F5] w-full rounded-full px-4 py-2 focus:outline-none">
                        <option>All Status</option>
                    </select>
                </div>

                <!-- Event Filter -->
                <div class="bg-[#F2E8F5] rounded-full">
                    <select class="bg-[#F2E8F5] w-full rounded-full px-4 py-2 focus:outline-none">
                        <option>All Events</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Student Applications -->
        <h1 class="text-primary mt-8 font-semibold">Student Applications</h1>
        <p class="text-gray-600 text-sm mb-3">Review and process student event applications</p>

        <!-- Verified Students -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-5">
            @foreach ($registeredEvents as $event)
                <div class="bg-white rounded-2xl shadow hover:shadow-lg transition p-5">
                    <!-- Header -->
                    <div class="flex items-center justify-between">
                        <p class="font-semibold text-lg text-gray-800">Shailaja</p>
                        <span class="text-sm bg-[#21C45D] text-white px-3 py-1 rounded-full">Verified</span>
                    </div>

                    <!-- ID -->
                    <p class="text-sm mt-1 border border-primary px-2 py-1 rounded-full inline-block">ID: 20240030</p>
                    <p class="text-sm mt-1"><span class="text-primary">•</span> Submitted: 2025-06-14</p>

                    <!-- Image -->
                    <div class="relative mt-3">
                        <img src="{{ $event->event->banner_image }}" class="rounded-xl w-full object-cover">
                        <span
                            class="absolute top-3 left-3 bg-[rgba(0,0,0,0.5)] text-white text-xs px-3 py-1 rounded-full">
                            {{ $event->event->title }}
                        </span>
                    </div>

                    <!-- Buttons -->
                    <div class="grid grid-cols-2 gap-3 mt-4">
                        <button class="w-full bg-gradient-to-r from-primary to-pink-600 text-white font-medium py-1 rounded-full">
                            <i class="fa fa-check-circle mr-1"></i> Present
                        </button>
                        <button class="w-full bg-gradient-to-r from-primary to-pink-600 text-white font-medium py-1 rounded-full">
                            <i class="fa fa-times-circle mr-1"></i> Absent
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Not Verified Students -->
        <h1 class="text-primary mt-10 font-semibold">Not Verified Students</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-5">
            @foreach ($registeredEvents as $event)
                <div class="bg-white rounded-2xl shadow hover:shadow-lg transition p-5">
                    <div class="flex items-center justify-between">
                        <p class="font-semibold text-lg text-gray-800">Shailaja</p>
                        <span class="text-sm bg-[#FF5050] text-white px-3 py-1 rounded-full">Not Verified</span>
                    </div>
                    <!-- ID -->
                    <p class="text-sm mt-1 border border-primary px-2 py-1 rounded-full inline-block">ID: 20240030</p>
                    <p class="text-sm mt-1"><span class="text-primary">•</span> Not Submitted: 2025-06-14</p>

                    <!-- Image Placeholder -->
                    <div class="bg-[#EDEDED] mt-3 flex flex-col justify-center items-center h-[180px] rounded-xl">
                        <img src="{{ asset('/images/not_uploaded.png') }}" class="w-16 h-16 opacity-70 mb-2">
                        <p class="text-red-600 text-sm">No image uploaded</p>
                    </div>

                    <!-- Buttons -->
                    <div class="grid grid-cols-2 gap-3 mt-4">
                        <button
                            class="w-full bg-gradient-to-r from-primary to-pink-600 text-white font-medium py-1 rounded-full">
                            <i class="fa fa-check-circle mr-1"></i> Present
                        </button>
                        <button
                            class="w-full bg-gradient-to-r from-primary to-pink-600 text-white font-medium py-1 rounded-full">
                            <i class="fa fa-times-circle mr-1"></i> Absent
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-layouts.app>

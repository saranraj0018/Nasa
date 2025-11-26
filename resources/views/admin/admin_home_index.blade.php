<x-layouts.app>
    <!-- Header -->
    <div class="bg-[#F5E8F5] w-full h-[90px] rounded-full shadow-sm px-8 py-3 flex flex-col justify-center">
        <h3 class="font-semibold text-primary">Mission Control Dashboard</h3>
        <p class="text-sm text-gray-700">Welcome Back Adminstrator!, Here is your mission overview</p>
    </div>

    <!-- Overview Cards -->
    <section class="p-3 mt-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Total Applications -->
            <div class="rounded-2xl shadow p-5 flex flex-col justify-between bg-cover bg-center"
                style="background-image: url('{{ asset('/images/admin_total_event.png') }}');">
                <div class="flex items-center justify-between py-4">
                    <p class="font-bold text-[#4E0E4D] text-sm">Total Events Created</p>
                    <div class="w-10 h-10 rounded-full bg-[#F7E9F7] flex items-center justify-center shadow-md">
                        <img src="{{ asset('/images/tot_event.png') }}" alt="Admin"
                            class="w-10 h-10 rounded-full object-contain p-2">
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-[#4E0E4D]">{{  isset($events) ? count($events) : 0 }}</h3>
                <div class="flex items-center justify-between">
                    {{-- <p class="text-[#4E0E4D] bg-[#F7E9F7] rounded-full px-2 text-xs py-1 mt-2">This Month</p> --}}
                </div>
            </div>

            <!-- Upcomimg -->
            <div class="rounded-2xl shadow p-5 flex flex-col justify-between bg-cover bg-center"
                style="background-image: url('{{ asset('/images/admin_upcoming_event.png') }}');">
                <div class="flex items-center justify-between py-4">
                    <p class="font-bold text-[#4E0E4D] text-sm">Upcoming Events</p>
                    <div class="w-10 h-10 rounded-full bg-[#D3F4FF] flex items-center justify-center shadow-md">
                        <img src="{{ asset('/images/up_event.png') }}" alt="Admin"
                            class="w-10 h-10 rounded-full object-contain p-2">
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-[#4E0E4D]">{{  isset($upcoming_events) ? count($upcoming_events) : 0 }}</h3>
                <div class="flex items-center justify-between">
                    {{-- <p class="text-[#4E0E4D] bg-[#94DAF4] rounded-full px-2 text-xs py-1 mt-2">This Month</p> --}}
                </div>
            </div>

            <!-- Pending -->
            <div class="rounded-2xl shadow p-5 flex flex-col justify-between bg-cover bg-center"
                style="background-image: url('{{ asset('/images/admin_pending_approvals.png') }}');">
                <div class="flex items-center justify-between py-4">
                    <p class="font-bold text-[#4E0E4D] text-sm">Pending Approvals</p>
                    <div class="w-10 h-10 rounded-full bg-[#FFCDD1] flex items-center justify-center shadow-md">
                        <img src="{{ asset('/images/pending_approval.png') }}" alt="Admin"
                            class="w-10 h-10 rounded-full object-contain p-2">
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-[#4E0E4D]">{{ isset($pending_approvals) ? count($pending_approvals) : 0   }}</h3>
                <div class="flex items-center justify-between">
                    <p class="text-[#4E0E4D] bg-[#FFB8C0] rounded-full px-2 py-1 text-xs mt-2">Student Applications</p>
                </div>
            </div>

            <!-- Submitted Reports -->
            <div class="rounded-2xl shadow p-5 flex flex-col justify-between bg-cover bg-center"
                style="background-image: url('{{ asset('/images/admin_submitted_reports.png') }}');">
                <div class="flex items-center justify-between py-4">
                    <p class="font-bold text-[#4E0E4D] text-sm">Submitted Reports</p>
                    <div class="w-10 h-10 rounded-full bg-[#636363] flex items-center justify-center shadow-md">
                        <img src="{{ asset('/images/submitted_reports.png') }}" alt="Admin"
                            class="w-10 h-10 rounded-full object-contain p-2">
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-[#4E0E4D]">{{ isset($submitted_reports) ? count($submitted_reports) : 0 }}</h3>
                <div class="flex items-center justify-between">
                    <p class="text-[#4E0E4D] bg-[#DEE2E9] rounded-full px-2 text-xs mt-2 py-1">This Month</p>
                </div>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="bg-white rounded-2xl shadow py-8 px-7 mt-3">
            <h1 class="text-[#4E0E4D]">Recent Events</h1>
            <div class="bg-[#F3DDF3] p-5 rounded-2xl mt-5">
                <h1 class="font-bold">AI Workshop</h1>
                <div class="flex items-center justify-between">
                    <p>05-09-2025</p>
                    <div class="flex items-center justify-between">
                        <p class="px-5 text-gray-700">45 Participants</p>
                        <p class="bg-[#B3FFAF] px-3 py-1 rounded-full">Completed</p>
                    </div>
                </div>
            </div>
            <div class="bg-[#F3DDF3] p-5 rounded-2xl mt-5">
                <h1 class="font-bold">Photography seminar</h1>
                <div class="flex items-center justify-between">
                    <p>05-09-2025</p>
                    <div class="flex items-center justify-between">
                        <p class="px-5 text-gray-700">32 Participants</p>
                        <p class="bg-[#FFD59A] px-5 py-1 rounded-full">Ongoing</p>
                    </div>
                </div>
            </div>
            <div class="bg-[#F3DDF3] p-5 rounded-2xl mt-5">
                <h1 class="font-bold">Photography seminar</h1>
                <div class="flex items-center justify-between">
                    <p>05-09-2025</p>
                    <div class="flex items-center justify-between">
                        <p class="px-5 text-gray-700">12 Participants</p>
                        <p class="bg-[#C4E2FF] px-4 py-1 rounded-full">Upcoming</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>

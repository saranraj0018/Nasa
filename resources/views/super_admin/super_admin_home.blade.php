<x-layouts.app>
    <!-- Section Header -->
    <div class="bg-[#F5E8F5] w-full h-[70px] rounded-full shadow-sm px-8 py-3">
        <!-- Left side -->
        <h3 class="font-semibold text-primary">Mission Control Dashboard</h3>
        <p>NASA Event Management System - Super Admin View</p>
    </div>
    <section class="p-2 mt-3">
        <!-- Top Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-[#F3EDFF] rounded-2xl shadow p-5 flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <p class="text-[#7D3CFF] font-medium">UPCOMING EVENTS</p>
                    <div class="rounded-full border-4 border-[#7D3CFF] flex items-center justify-center shadow-md">
                        <img src="{{ asset('/images/upcoming_event.png') }}" alt=""
                            class="p-2">
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-[#7D3CFF]">{{ $upcomingEvents ?? 0 }}</h3>
                <span class="text-[#7D3CFF] text-xs">+{{ $upcomingEventsThisWeek }} in this week</span>
            </div>

            <div class="bg-[#FFEBE4] rounded-2xl shadow p-5 flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <p class="text-[#FF6833] font-medium">ONGOING EVENTS</p>
                    <div class="rounded-full border-4 border-[#FF6833] flex items-center justify-center shadow-md">
                        <img src="{{ asset('/images/ongoing_event.png') }}" alt="Super Admin" class="p-2">
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-[#FF6833]">{{ $ongoingEvents ?? 0 }}</h3>
                <span class="text-[#FF6833] text-xs">Live Now</span>
            </div>

            <div class="bg-[#DAECFF] rounded-2xl shadow p-5 flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <p class="text-[#02AC8B] font-medium">TOTAL ADMINS</p>
                    <div class="rounded-full border-4 border-[#02AC8B] flex items-center justify-center shadow-md">
                        <img src="{{ asset('/images/total_admins.png') }}" alt=""
                            class="p-2">
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-[#02AC8B]">{{ $totalAdmins ?? 0 }}</h3>
                <span class="text-[#02AC8B] text-xs">+{{ $adminsThisMonth  }} in this month</span>
            </div>

            <div class="bg-[#FFF6DE] rounded-2xl shadow p-5 flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <p class="text-[#C79000] font-medium">TOTAL STUDENTS</p>
                    <div class="rounded-full border-4 border-[#C79000] flex items-center justify-center shadow-md">
                        <img src="{{ asset('/images/total_students.png') }}" alt=""
                            class="p-2">
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-[#C79000]">{{ $totalStudents ?? 0 }}</h3>
                <span class="text-[#C79000] text-xs">+{{ $studentsThisMonth }} this month</span>
            </div>

            <div class="bg-[#EDFFF2] rounded-2xl shadow p-5 flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <p class="text-[#02A830] font-medium">PENDING REPORTS</p>
                    <div class="rounded-full border-4 border-[#02A830] flex items-center justify-center shadow-md">
                        <img src="{{ asset('/images/pending_reports.png') }}" alt=""
                            class="p-2">
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-[#02A830]">{{ $pendingReports }}</h3>
                <span class="text-[#02A830] text-xs">+{{ $thisweeksubmittedReports }} in this week</span>
            </div>

            <div class="bg-[#FBEDFF] rounded-2xl shadow p-5 flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <p class="text-[#72059C] font-medium">SUBMITTED REPORTS</p>
                    <div class="rounded-full border-4 border-[#72059C] flex items-center justify-center shadow-md">
                        <img src="{{ asset('/images/submitted_reports.png') }}" alt=""
                            class="p-2">
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-[#72059C]">{{ $submittedReports }}</h3>
                <span class="text-[#72059C] text-xs">+{{ $thisweeksubmittedReports }} in this week</span>
            </div>
        </div>
    </section>

    <h1 class="text-primary font-semibold mt-4">Recent Activity</h1>

{{-- <div class="bg-[#F6F6F6] w-full h-[70px] rounded-2xl shadow-sm px-8 py-3 mt-3">
    <h3 class="font-semibold">New Admin Registered</h3>
    <div class="flex items-center justify-between mt-1">
        <p class="text-gray-700">Dr. Sarah Chen</p>
        <span class="text-gray-600 text-sm">2 minutes ago</span>
    </div>
</div>

<div class="bg-[#F6F6F6] w-full h-[70px] rounded-2xl shadow-sm px-8 py-3 mt-3">
    <h3 class="font-semibold">Event Approved</h3>
    <div class="flex items-center justify-between mt-1">
        <p class="text-gray-700">Albert Johnson</p>
        <span class="text-gray-600 text-sm">2 minutes ago</span>
    </div>
</div>

<div class="bg-[#F6F6F6] w-full h-[70px] rounded-2xl shadow-sm px-8 py-3 mt-3">
    <h3 class="font-semibold">Student Application</h3>
    <div class="flex items-center justify-between mt-1">
        <p class="text-gray-700">Alex</p>
        <span class="text-gray-600 text-sm">2 minutes ago</span>
    </div>
</div>

<div class="bg-[#F6F6F6] w-full h-[70px] rounded-2xl shadow-sm px-8 py-3 mt-3">
    <h3 class="font-semibold">Report Submitted</h3>
    <div class="flex items-center justify-between mt-1">
        <p class="text-gray-700">Robotics Alpha</p>
        <span class="text-gray-600 text-sm">2 minutes ago</span>
    </div>
</div>

<div class="bg-[#F6F6F6] w-full h-[70px] rounded-2xl shadow-sm px-8 py-3 mt-3">
    <h3 class="font-semibold">System Update</h3>
    <div class="flex items-center justify-between mt-1">
        <p class="text-gray-700">Dr. Sarah Chen</p>
        <span class="text-gray-600 text-sm">2 minutes ago</span>
    </div>
</div> --}}
    @foreach ($activities as $activity)
        <div class="bg-[#F6F6F6] w-full h-[70px] rounded-2xl shadow-sm px-8 py-3 mt-3">
            <h3 class="font-semibold">{{ $activity->title }}</h3>
            <div class="flex items-center justify-between mt-1">
                <p class="text-gray-700">{{ ucfirst($activity->user_name) }}</p>
                <span class="text-gray-600 text-sm">{{ $activity->created_at->diffForHumans() }}</span>
            </div>
        </div>
    @endforeach
</x-layouts.app>



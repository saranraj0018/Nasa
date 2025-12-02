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
                <h3 class="text-3xl font-bold text-[#4E0E4D]">{{ isset($events) ? count($events) : 0 }}</h3>
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
                <h3 class="text-3xl font-bold text-[#4E0E4D]">
                    {{ isset($upcoming_events) ? count($upcoming_events) : 0 }}</h3>
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
                <h3 class="text-3xl font-bold text-[#4E0E4D]">
                    {{ isset($pending_approvals) ? count($pending_approvals) : 0 }}</h3>
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
                <h3 class="text-3xl font-bold text-[#4E0E4D]">
                    {{ isset($submitted_reports) ? count($submitted_reports) : 0 }}</h3>
                <div class="flex items-center justify-between">
                    {{-- <p class="text-[#4E0E4D] bg-[#DEE2E9] rounded-full px-2 text-xs mt-2 py-1">This Month</p> --}}
                </div>
            </div>

            <!-- created Tasks -->
             <div class="bg-[#F3EDFF] rounded-2xl shadow p-5 flex flex-col justify-between">
                <p class="font-semibold text-gray-700 text-sm">Total Tasks</p>
                <div class="flex items-center justify-between py-4">
                    <h3 class="text-3xl font-bold text-[#FF4757]">{{ $total_tasks ?? '' }}</h3>
                    <img src="{{ asset('/images/total_applications.png') }}" alt="Total Applications" class="w-14 h-14">
                </div>
            </div>

            <!-- Pending -->
            <div class="bg-[#FFECE4] rounded-2xl shadow p-5 flex flex-col justify-between">
                <p class="font-semibold text-gray-700 text-sm">Pending Tasks</p>
                <div class="flex items-center justify-between py-4">
                    <h3 class="text-3xl font-bold text-[#F9C539]">{{ $pending_tasks ?? '' }}</h3>
                    <img src="{{ asset('/images/task_pending.png') }}" alt="Pending" class="w-14 h-14">
                </div>
            </div>

            <!-- Approved -->
            <div class="bg-[#DAECFF] rounded-2xl shadow p-5 flex flex-col justify-between">
                <p class="font-semibold text-gray-700 text-sm">Completed Tasks</p>
                <div class="flex items-center justify-between py-4">
                    <h3 class="text-3xl font-bold text-[#21FFD4]">{{ $completed_tasks ?? '' }}</h3>
                    <img src="{{ asset('/images/approved.png') }}" alt="Approved" class="w-14 h-14">
                </div>
            </div>
            <div class="bg-[#FFF6DE] rounded-xl shadow p-4 flex flex-col justify-between">
                <p class="font-semibold">Approved Tasks</p>
                <div class="flex items-center justify-between py-2">
                    <h3 class="text-3xl font-bold text-[#4CAF50]">{{ $approved_tasks }}</h3>
                    <img src="{{ asset('/images/task_completed.png') }}" alt="Completed" class="w-14 h-14">
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow py-5 px-5 mt-3">
            <h1 class="text-[#4E0E4D]">Recent Events</h1>
            @foreach ($events as $event)
                @php
                    $participate = $event->registrations->groupBy('student_id');
                    $today = now();
                    if ($event->event_date > $today) {
                        $status = 'Upcoming';
                        $statusClass = 'bg-[#C4E2FF]';
                    } elseif ($event->event_date <= $today && $event->end_registration >= $today) {
                        $status = 'Ongoing';
                        $statusClass = 'bg-[#FFD59A]';
                    } else {
                        $status = 'Completed';
                        $statusClass = 'bg-[#B3FFAF]';
                    }
                @endphp
                <div class="bg-[#F3DDF3] p-5 rounded-2xl mt-3">
                    <h1 class="font-bold">{{ $event->title ?? '' }}</h1>
                    <div class="flex items-center justify-between">
                        <p>{{ \Carbon\Carbon::parse($event->event_date)->format('d-m-Y') }}</p>
                        <div class="flex items-center justify-between">
                            <p class="px-5 text-gray-700">{{ $participate->count() }} Participants</p>
                            <p class="{{ $statusClass }} px-4 py-1 rounded-full">{{ $status }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-layouts.app>

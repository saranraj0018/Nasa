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
        <div class="bg-white rounded-2xl shadow py-8 px-7 mt-3">
            @foreach ($reports as $report)
            <div class="shadow p-5 rounded-2xl mt-5">
               <div class="flex items-center justify-between">
                   <h1 class="font-bold">{{ $report->get_event->title ?? '' }}</h1>
                    <a href="{{ route('reports_view_pdf', $report->id) }}" target="_blank"
                        class="text-center bg-[#F5F7F9] font-medium py-1 rounded-full">
                        <i class="fa fa-eye" aria-hidden="true"></i> View Pdf
                    </a>
               </div>
                   <p>{{ $report->creator->name ?? '' }}</p>
                   <p class="text-xs mt-2"><i class="fa fa-calendar text-primary "></i> Events : {{ \Carbon\Carbon::parse($report->get_event->event_date)->format('d/m/Y') }}    <i class="fa fa-calendar text-primary"></i> Submitted :  {{ \Carbon\Carbon::parse($report->created_at)->format('d/m/Y') }}</p>
             </div>
             @endforeach
            </div>
    </section>
</x-layouts.app>

<x-layouts.app>
    <!-- Header -->
    <div class="bg-[#F5E8F5] w-full h-[70px] rounded-full shadow-sm px-8 py-3">
        <h3 class="font-semibold text-primary">Event Report Submission</h3>
        <p>Submit comprehensive reports for completed events</p>
    </div>
    <div class="flex justify-end">
        <a href="{{ route('create_report') }}"
            class="px-2 w-40 mt-5 bg-gradient-to-r from-primary to-pink-600 text-white font-medium py-1 rounded-full">
            <i class="fa fa-plus" aria-hidden="true"></i>Create Report</a>
    </div>

    <!-- Filters Section -->
    <section class="mt-5">
        <div class="bg-white rounded-xl shadow-md p-4">
            <form method="GET" action="{{ route('reports') }}"
                class="flex flex-col md:flex-row md:items-center gap-3">
                <div class="w-full md:flex-1">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search event name"
                        class="w-full border border-gray-300 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div class="w-full md:w-64">
                    <select name="programme_id"
                        class="w-full border border-gray-300 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary choice-select">
                        <option value="">All Programmes</option>
                        @foreach ($programmes as $programme)
                            <option value="{{ $programme->id }}"
                                {{ request('programme_id') == $programme->id ? 'selected' : '' }}>
                                {{ $programme->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full md:w-56">
                    <input type="date" name="event_date" value="{{ request('event_date') }}"
                        class="w-full border border-gray-300 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div class="flex gap-2">
                    <button type="submit"
                        class="px-6 py-2 bg-gradient-to-r from-primary to-pink-600 text-white text-sm rounded-full hover:opacity-90 transition">
                        <i class="fa fa-search mr-1"></i> Search
                    </button>
                    @if (request()->hasAny(['search', 'programme_id', 'event_date']))
                        <a href="{{ route('reports') }}"
                            class="px-5 py-2 bg-gray-400 text-white text-sm rounded-full hover:bg-gray-500 transition">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </section>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6 mt-5">
        @foreach ($reports as $report)
            @php
                if ($report->schedule->is_reserve_date == 'y') {
                    $start_time = $report->get_event->reserve_start_time;
                    $end_time = $report->get_event->reserve_end_time;
                } else {
                    $start_time = $report->get_event->start_time;
                    $end_time = $report->get_event->end_time;
                }
            @endphp
            <div class="bg-white rounded-2xl shadow hover:shadow-lg transition p-5">
                <!-- Header -->
                <p class="font-semibold text-lg">{{ $report->get_event->title ?? '' }} -
                    {{ $report->get_programme->name ?? '' }} - {{ $report->event_date ?? '' }}</p>
                <p class="text-xs mt-2">
                    <i class="fa fa-calendar text-primary" aria-hidden="true"></i>
                    Event -
                    {{ \Carbon\Carbon::parse($report->schedule->event_date)->format('F d, Y') }}
                    ({{ $start_time ? \Carbon\Carbon::parse($start_time)->format('h.iA') : '' }})
                </p>
                <p class="mt-2 text-xs">
                    <i class="fa fa-clock text-primary" aria-hidden="true"></i>
                    Submitted :
                    {{ \Carbon\Carbon::parse($report->created_at)->format('F d, Y (h.iA)') }}
                </p>
                <div class="flex items-center justify-between py-2">
                    <p class="mt-2 text-xs bg-[#F2E8F5] py-1 px-3 rounded-full text-primary">
                        {{ $report->get_event->title ?? '' }}</p>
                </div>
                <!-- Image -->
                <div class="grid grid-cols-2 gap-3 mt-4">
                    <!-- View PDF -->
                    <a href="{{ route('reports_view_pdf', $report->id) }}" target="_blank"
                        class="w-full inline-block text-center bg-[#E27258] text-white font-medium py-1 rounded-full">
                        <i class="fa fa-eye" aria-hidden="true"></i> View PDF
                    </a>

                    <!-- Download PDF -->
                    <a href="{{ route('reports_download_pdf', $report->id) }}"
                        class="w-full inline-block text-center bg-gradient-to-r from-primary to-pink-600 text-white font-medium py-1 rounded-full">
                        <i class="fa fa-download" aria-hidden="true"></i> Download
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</x-layouts.app>

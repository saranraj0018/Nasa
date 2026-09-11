<x-layouts.app>
    <!-- Header -->
    <div class="bg-[#F5E8F5] w-full h-[90px] rounded-full shadow-sm px-8 py-3 flex flex-col justify-center">
        <h3 class="font-semibold text-primary">Review Report</h3>
        <p class="text-sm text-gray-700">Submit comprehensive reports for completed events</p>
    </div>
    <!-- Overview Cards -->
    <section class="p-3">
        <!-- Filters Section -->
        <h1 class="text-primary mt-3 font-semibold">Review Reports</h1>
        <div class="bg-white rounded-xl shadow-md p-4 mt-3">
            <form method="GET" action="{{ route('review_reports') }}"
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
                        <a href="{{ route('review_reports') }}"
                            class="px-5 py-2 bg-gray-400 text-white text-sm rounded-full hover:bg-gray-500 transition">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>
        <div class="bg-white rounded-2xl shadow py-8 px-7 mt-3">
            @if ($reports->isNotEmpty())
                @foreach ($reports as $report)
                    <div class="shadow p-5 rounded-2xl mt-5">
                        <div class="flex items-center justify-between">
                            <h1 class="font-bold">{{ $report->get_event->title ?? '' }}</h1>
                            <a href="{{ route('reports_view_pdf', $report->id) }}" target="_blank"
                                class="text-center bg-[#F5F7F9] font-medium py-1 rounded-full px-4">
                                <i class="fa fa-eye" aria-hidden="true"></i> View Pdf
                            </a>
                        </div>
                        <p><b>{{ $report->schedule?->department?->name ?? '' }} - {{ \Carbon\Carbon::parse($report->schedule->event_date)->format('d/m/Y') }}</b></p>
                        <p>{{ $report->creator->name ?? '' }}</p>
                        <p class="text-xs mt-2"><i class="fa fa-calendar text-primary "></i> Events :
                            {{ \Carbon\Carbon::parse($report->schedule->event_date)->format('d/m/Y') }} <i
                                class="fa fa-calendar text-primary"></i> Submitted :
                            {{ \Carbon\Carbon::parse($report->created_at)->format('d/m/Y') }}</p>
                    </div>
                @endforeach
            @else
                <p class="text-center">No reports available</p>
            @endif
        </div>
    </section>
</x-layouts.app>

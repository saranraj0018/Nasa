@php
    $fmt = fn ($v) => \App\Http\Controllers\CreditSummaryReportController::formatCredits($v);
@endphp
<x-layouts.app>
    {{-- Header --}}
    <div
        class="bg-[#F5E8F5] w-full rounded-full shadow-sm px-6 py-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
        <h3 class="font-semibold text-primary text-lg sm:text-xl">Credit Reports</h3>
    </div>

    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                showToast("{{ session('success') }}", "success");
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                showToast("{{ session('error') }}", "error");
            });
        </script>
    @endif

    @if ($errors->any())
        <div class="mt-6 rounded-lg bg-red-100 border border-red-200 p-4 text-red-800">
            <strong class="block mb-1">Please fix the following errors:</strong>
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="GET" action="{{ route('credit_summary') }}" id="credit-filter-form" class="mt-4">
        <div class="bg-white p-4 rounded-2xl shadow">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <div>
                    <label class="block text-sm font-medium mb-1">Programme <span class="text-red-500">*</span></label>
                    <select name="programme_id" id="programme_id"
                        class="border rounded-lg px-3 py-2 w-full choice-select">
                        <option value="">-- Select Programme --</option>
                        @foreach ($programmes as $prog)
                            <option value="{{ $prog->id }}"
                                {{ request('programme_id') == $prog->id ? 'selected' : '' }}>
                                {{ $prog->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Semester <span class="text-red-500">*</span></label>
                    <select name="semester" id="semester"
                        class="border rounded-lg px-3 py-2 w-full choice-select">
                        <option value="" {{ request('semester') ? '' : 'selected' }} disabled>Select Semester</option>
                        @for ($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}" {{ request('semester') == (string) $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Section</label>
                    <select name="section" id="section" class="border rounded-lg px-3 py-2 w-full choice-select">
                        <option value="">All Sections</option>
                        @foreach (['a', 'b', 'c', 'd', 'r'] as $sec)
                            <option value="{{ $sec }}" {{ request('section') == $sec ? 'selected' : '' }}>{{ strtoupper($sec) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="cr-filter-actions">
            <button type="submit" class="bg-gradient-to-r from-primary to-pink-600 text-white rounded-full shadow">
                <i class="fa fa-search mr-1"></i> Search
            </button>
            <a href="{{ route('credit_summary') }}"
                class="bg-gray-400 text-white rounded-full hover:bg-gray-500 transition">
                Reset
            </a>
        </div>
    </form>

    @if (isset($rows))
        @php
            $exportParams = array_filter([
                'programme_id' => request('programme_id'),
                'semester' => request('semester'),
                'section' => request('section'),
            ]);
        @endphp
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mt-8 p-5">
            <div class="cr-head">
                <div class="text-sm space-y-1">
                    <div><b>Programme:</b> {{ $progm->name ?? '' }}</div>
                    <div><b>Semester:</b> {{ $semester }} &nbsp; | &nbsp; <b>Section:</b> {{ $section ? strtoupper($section) : 'All' }}</div>
                    <div><b>Required Credits for Semester:</b>
                        @if ($credit_points)
                            {{ $fmt($required) }}
                        @else
                            <span class="text-red-600">Not configured (set it in Credit Point Assign)</span>
                        @endif
                    </div>
                </div>
                <div class="cr-actions">
                    <a href="{{ route('credit_summary_excel', $exportParams) }}"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </a>
                    <a href="{{ route('credit_summary_pdf', $exportParams) }}"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                        <i class="fas fa-file-pdf"></i> Export PDF
                    </a>
                </div>
            </div>

            <div class="cr-stats">
                <div class="rounded-lg bg-blue-50 border border-blue-200 p-3">
                    <div class="text-xs text-blue-700 uppercase">Total Students</div>
                    <div class="text-xl font-semibold text-blue-800">{{ $summary['students'] }}</div>
                </div>
                <div class="rounded-lg bg-green-50 border border-green-200 p-3">
                    <div class="text-xs text-green-700 uppercase">Credits Completed</div>
                    <div class="text-xl font-semibold text-green-800">{{ $summary['completed'] }}</div>
                </div>
                <div class="rounded-lg bg-red-50 border border-red-200 p-3">
                    <div class="text-xs text-red-700 uppercase">Credits Pending</div>
                    <div class="text-xl font-semibold text-red-800">{{ $summary['pending'] }}</div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y text-sm">
                    <thead>
                        <tr class="bg-primary text-white uppercase tracking-wider">
                            <th class="px-2 py-3 text-left font-semibold">S.No</th>
                            <th class="px-2 py-3 text-left font-semibold">Register Number</th>
                            <th class="px-2 py-3 text-left font-semibold">Student Name</th>
                            <th class="px-2 py-3 text-left font-semibold">Section</th>
                            <th class="px-2 py-3 text-left font-semibold">Attended Events</th>
                            <th class="px-2 py-3 text-center font-semibold">Required</th>
                            <th class="px-2 py-3 text-center font-semibold">Earned</th>
                            <th class="px-2 py-3 text-center font-semibold">Remaining</th>
                            <th class="px-2 py-3 text-center font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse ($rows->values() as $index => $row)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-2 py-3">{{ $index + 1 }}</td>
                                <td class="px-2 py-3">{{ $row['student']->register_number ?? '' }}</td>
                                <td class="px-2 py-3">{{ $row['student']->name ?? '' }}</td>
                                <td class="px-2 py-3">{{ strtoupper((string) $row['student']->section) }}</td>
                                <td class="px-2 py-3">
                                    @if ($row['events']->count())
                                        <div class="flex flex-col gap-2">
                                            @foreach ($row['events'] as $event)
                                                <div class="px-3 py-2 rounded-lg border {{ $event['counted'] ? 'bg-blue-50 border-blue-200' : 'bg-gray-50 border-gray-200' }}">
                                                    <div class="font-medium {{ $event['counted'] ? 'text-blue-800' : 'text-gray-600' }}">
                                                        {{ $event['title'] }}
                                                    </div>
                                                    <div class="text-sm {{ $event['counted'] ? 'text-blue-600' : 'text-gray-500' }}">
                                                        {{ $fmt($event['credits']) }} Credits
                                                        @if ($event['note'])
                                                            <span class="italic">({{ $event['note'] }})</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-400">No Events</span>
                                    @endif
                                </td>
                                <td class="px-2 py-3 text-center">{{ $fmt($required) }}</td>
                                <td class="px-2 py-3 font-semibold text-green-600 text-center">{{ $fmt($row['earned']) }}</td>
                                <td class="px-2 py-3 font-semibold text-red-600 text-center">{{ $fmt($row['remaining']) }}</td>
                                <td class="px-2 py-3 text-center">
                                    @if ($row['completed'])
                                        <span class="px-2 py-1 rounded-full bg-green-100 text-green-700 text-xs">Completed</span>
                                    @else
                                        <span class="px-2 py-1 rounded-full bg-red-100 text-red-700 text-xs">Pending</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-gray-500 py-4">No students found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="mt-6 text-center text-gray-500">
            Please select <b>Programme</b> and <b>Semester</b> to view student credits.
        </div>
    @endif
</x-layouts.app>
<script>
    $(document).ready(function() {
        $("#credit-filter-form").on("submit", function(e) {
            let error = false;
            $(".error-text").remove();
            $(".border-red-500").removeClass("border-red-500");

            [
                ["#programme_id", "Programme is required"],
                ["#semester", "Semester is required"],
            ].forEach(function([selector, message]) {
                if (!$(selector).val()) {
                    $(selector).addClass("border-red-500")
                        .after("<span class='error-text text-red-500 text-sm'>" + message + "</span>");
                    error = true;
                }
            });

            if (error) {
                e.preventDefault();
            }
        });
    });
</script>

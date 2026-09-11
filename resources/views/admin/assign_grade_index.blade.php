<x-layouts.app>

    <!-- Header -->
    <div class="bg-[#F5E8F5] w-full h-[90px] rounded-full shadow-sm px-8 py-3 flex flex-col justify-center">
        <h3 class="font-semibold text-primary">Assign Grades</h3>
    </div>

    <!-- Filters Section -->
    <section class="p-3 mt-4">
        <div class="bg-white rounded-xl shadow-md p-4">
            <form method="GET" action="{{ route('assign_grades') }}"
                class="flex flex-col md:flex-row md:items-center gap-3">
                <div class="w-full md:flex-1">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search event name / contact person / email"
                        class="w-full border border-gray-300 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div class="w-full md:w-64">
                    <select name="club_id"
                        class="w-full border border-gray-300 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary choice-select">
                        <option value="">All Clubs</option>
                        @foreach ($clubs as $club)
                            <option value="{{ $club->id }}" {{ request('club_id') == $club->id ? 'selected' : '' }}>
                                {{ $club->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit"
                        class="px-6 py-2 bg-gradient-to-r from-primary to-pink-600 text-white text-sm rounded-full hover:opacity-90 transition">
                        <i class="fa fa-search mr-1"></i> Search
                    </button>
                    @if (request()->hasAny(['search', 'club_id']))
                        <a href="{{ route('assign_grades') }}"
                            class="px-5 py-2 bg-gray-400 text-white text-sm rounded-full hover:bg-gray-500 transition">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </section>

    <!-- Overview Cards -->
    <section class="p-3 mt-4">
        <!-- Attendance Table -->
        <div class="mt-4 bg-white rounded-2xl shadow overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-primary text-white text-sm uppercase tracking-wider">
                    <tr>
                        <th class="px-4 py-3">S.No</th>
                        <th class="px-4 py-3">Event Name</th>
                        <th class="px-4 py-3">Event Date</th>
                        <th class="px-4 py-3">Contact Person</th>
                        <th class="px-4 py-3">Contact Email</th>
                        <th class="px-4 py-3">Club Name</th>
                        <th class="px-4 py-3 text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($events as  $event)
                        <tr class="border-t">
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 font-medium">{{ $event->title ?? '' }}</td>
                            <td class="px-4 py-3">{{ $event->event_date ?? '' }}</td>
                            <td class="px-4 py-3">{{ $event->contact_person ?? '' }}</td>
                            <td class="px-4 py-3">{{ $event->contact_email ?? '' }}</td>
                            <td class="px-4 py-3">{{ $event->get_club?->name ?? '' }}</td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex gap-2 justify-center">
                                    <a href="{{ route('assign_grade_entry', ['event_id' => $event->id]) }}"
                                        data-event_id="{{ $event->id }}"
                                        class="bg-[#DA70D6] text-white px-3 py-1 rounded-full text-xs">
                                        Assign Grade
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-6 text-gray-500">
                                No records found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
         <div class="p-4">
                {{ $events->links() }}
        </div>
    </section>

</x-layouts.app>

<script src="{{ asset('admin/js/student_attendance.js') }}?v={{ time() }}"></script>

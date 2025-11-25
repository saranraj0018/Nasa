<x-layouts.app>
    <div class="bg-[#F5E8F5] w-full rounded-full shadow-sm px-8 py-3">
        <h3 class="font-semibold text-primary">Events</h3>
    </div>
    <div class="flex justify-end">
        <a href="{{ route('create_event') }}"
                class="px-2 w-40 mt-3 bg-gradient-to-r from-primary to-pink-600 text-white font-medium py-1 rounded-full">
                <i class="fa fa-plus" aria-hidden="true"></i>Create Event</a>
    </div>
    <!-- Dashboard Header -->
    <section class="p-2 mt-3">
        <div class="mt-6">
            <h4 class="font-semibold text-gray-800 mb-4">Event Lists</h4>
             <div class="overflow-x-auto bg-white rounded-xl shadow-md">
            <table class="w-full text-sm text-left text-gray-700 border-collapse">
                <thead>
                <tr class="bg-primary text-white text-sm uppercase tracking-wider">
                    <th class="px-3 py-2">ID</th>
                    <th class="px-3 py-2">Banner Image</th>
                    <th class="px-3 py-2">Event Name</th>
                    <th class="px-3 py-2">Programme Officer</th>
                    <th class="px-3 py-2">Event Date</th>
                    <th class="px-3 py-2">Start Time</th>
                    <th class="px-3 py-2">End Time</th>
                    <th class="px-3 py-2">Registration End Date</th>
                    <th class="px-3 py-2">Action</th>
                 </tr>
                </thead>
                <tbody id="categoryTableBody" class="divide-y divide-gray-200">
                @foreach($events as $event)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">
                            @if($event->banner_image)
                                <img src="{{ asset('storage/'.$event->banner_image) }}"
                                     class="h-10 w-10 object-cover rounded-lg shadow-sm border" />
                            @else
                                <span class="text-gray-400 italic">No Image</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">{{ $event->title ?? ''}}</td>
                        <td class="px-4 py-3">{{ $event->get_faculty->name }}</td>
                        <td class="px-4 py-3">{{ $event->event_date ?? ''}}</td>
                        <td class="px-4 py-3">{{ $event->start_time ? \Carbon\Carbon::parse($event->start_time )->format('h:i A') : '-' }}</td>
                        <td class="px-4 py-3">{{ $event->end_time ? \Carbon\Carbon::parse($event->end_time )->format('h:i A') : '-' }}</td>
                        <td class="px-4 py-3">{{ $event->end_registration ?? '' }}</td>
                        <td class="px-4 py-3 flex justify-center gap-4">
                            <!-- Edit -->
                        <a href="{{ route('create_event', ['event_id' => encrypt($event->id)]) }}">
                             <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
         <div class="p-4">
            {{ $events->links() }}
        </div>
        </div>
    </section>
</x-layouts.app>

<script src="{{ asset('admin/js/events.js') }}"></script>

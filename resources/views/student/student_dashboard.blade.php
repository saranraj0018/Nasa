<x-layouts.app>
    <x-partials.navbar />
    <!-- Dashboard Header -->
    <section class="p-2 mt-3">
        <!-- Top Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-[#BF9CFF] rounded-2xl shadow p-5 flex flex-col justify-between">
                <p class="text-[#230060] font-medium">Total Events</p>
                <div class="flex items-center justify-between">
                    <h3 class="text-3xl font-bold text-[#230060]">{{ isset($events) ? count($events) : 0 }}</h3>
                    <img src="{{ asset('/images/calender.png') }}" alt="" class="mx-auto mt-[-40px] mb-[-40px]">
                </div>
                <div class="relative">
                    <span class="bg-white text-xs px-4 py-1 rounded-full">Available this Semester</span>
                </div>
            </div>

            <div class="bg-[#FF8F6B] rounded-2xl shadow p-5 flex flex-col justify-between">
                <p class="text-[#992B07] font-medium">Register Events</p>
                <div class="flex items-center justify-between mt-2">
                    <h3 class="text-3xl font-bold text-[#992B07]">{{ isset($registered_count) ? count($registered_count) : 0 }}</h3>
                    <img src="{{ asset('/images/register_event.png') }}" alt="" class="mx-auto">
                </div>
                <div class="relative">
                    <span class="bg-white text-xs px-4 py-1 rounded-full">Upcoming & Ongoing</span>
                </div>
            </div>

            <div class="bg-[#B5DAFF] rounded-2xl shadow p-5 flex flex-col justify-between">
                <p class=" text-[#0756A6] font-medium">Completed Events</p>
                <div class="flex items-center justify-between mt-2">
                    <h3 class="text-3xl font-bold text-[#0756A5]">{{ isset($completed_events) ? count($completed_events) : 0 }}</h3>
                    <img src="{{ asset('/images/completed.png') }}" alt="" class="mx-auto">
                </div>
                <div class="relative">
                    <span class="bg-white text-xs px-4 py-1 rounded-full">This Academic Year</span>
                </div>
            </div>

            <div class="bg-[#FFCB4B] rounded-2xl shadow p-5 flex flex-col justify-between">
                <p class="text-[#D48C28] font-medium">Certificates Earned</p>
                <div class="flex items-center justify-between mt-2">
                    <h3 class="text-3xl font-bold text-[#D48C28]">{{ isset($completed_events) ? count($completed_events) : 0 }}</h3>
                    <img src="{{ asset('/images/certificates.png') }}" alt="" class="mx-auto">
                </div>
                <div class="relative">
                    <span class="bg-white text-xs px-4 py-1 rounded-full">This Academic Year</span>
                </div>
            </div>
        </div>

        <!-- Section Header -->
        <div class="bg-[#F2E8F5] rounded-full px-5 py-3 mt-8 flex justify-between items-center">
            <!-- Left side -->
            <h3 class="font-semibold text-primary">Events</h3>
        </div>
        <!-- Upcoming Event Section -->
        <div class="mt-6">
            <h4 class="font-semibold text-gray-800 mb-4">Upcoming Events</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($upcomingEvents as $event)
                    <div class="bg-white rounded-2xl shadow hover:shadow-lg transition">
                        <div class="relative">
                            <img src="{{ asset('storage/' . $event['banner_image']) }}" alt="Event" class="rounded-t-2xl w-full">
                            @if ($event['event_type'] == 'paid')
                            <span class= "absolute top-3 right-3 bg-[#FFC31F] text-white px-3 text-sm py-1 rounded-full">
                                Premium
                            </span>
                            @endif
                            <span class="absolute @if($event['event_type'] == 'paid') mt-2 top-10 @else top-3 @endif  right-3 bg-gradient-to-r from-primary to-pink-600 text-white px-3 text-sm py-1 rounded-full">
                                <span class="text-2xl">25 </span><span>Seats
                                    <pre> Available</span></pre>
                                </span>
                            </span>
                            <span
                                class="absolute bottom-3 left-3 bg-[rgba(128,128,128,0.4)] text-white text-xs px-3 py-1 rounded-full">
                                {{ $event['title'] }}
                            </span>
                        </div>
                        <div class="p-2 details">
                            <div class="grid grid-cols-1 gap-1 md:grid-cols-2 text-xs">
                                <div class="flex items-center bg-[#F2E8F5] rounded-full px-1 py-1">
                                      <i class="fa fa-clock text-primary" aria-hidden="true"></i>
                                    <p class="px-2">{{ $event->start_time ? \Carbon\Carbon::parse($event->start_time)->format('h:i A') : '-' }} - {{ $event->end_time ? \Carbon\Carbon::parse($event->end_time)->format('h:i A') : '-' }}</p>
                                </div>
                                <div class="flex items-center bg-[#F2E8F5] rounded-full px-1 py-1">
                                     <i class="fa fa-calendar text-primary" aria-hidden="true"></i>
                                    <p class="px-2">{{ \Carbon\Carbon::parse($event['event_date'])->format('F j, Y') }}</p>
                                </div>
                                <div class="flex items-center bg-[#F2E8F5] rounded-full px-1 py-1">
                                    <i class="fa fa-map-marker text-primary" aria-hidden="true"></i>
                                    <p class="px-2">{{ $event['location'] }}</p>
                                </div>
                            </div>
                            @if ($event->registrations->isEmpty())
                            <button onclick="document.querySelector('.registerModal').classList.remove('hidden')" class="student_register mt-4 w-full bg-primary text-white font-medium py-2 rounded-full" data-event_id={{ $event->id }}>
                                Register Now
                            </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mt-6">
            <h4 class="font-semibold text-gray-800 mb-4">Ongoing Events</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($ongoingEvents as $ongoing_event)
                    <div class="bg-white rounded-2xl shadow hover:shadow-lg transition">
                        <div class="relative">
                            <img src="{{ asset('storage/' . $ongoing_event['banner_image']) }}"  alt="Event" class="rounded-t-2xl w-full">
                            @if ($ongoing_event['event_type'] == 'paid')
                            <span class= "absolute top-3 right-3 bg-[#FFC31F] text-white px-3 text-sm py-1 rounded-full">
                                Premium
                            </span>
                            @endif
                            <span class="absolute @if($ongoing_event['event_type'] == 'paid') mt-2 top-10 @else top-3 @endif  right-3 bg-gradient-to-r from-primary to-pink-600 text-white px-3 text-sm py-1 rounded-full">
                                <span class="text-2xl">25 </span><span>Seats
                                    <pre> Available</span></pre>
                                </span>
                            </span>
                            <span
                                class="absolute bottom-3 left-3 bg-[rgba(128,128,128,0.4)] text-white text-xs px-3 py-1 rounded-full">
                                {{ $ongoing_event['title'] }}
                            </span>
                        </div>
                        <div class="p-2 details">
                            <div class="grid grid-cols-1 gap-1 md:grid-cols-2 text-xs">
                                <div class="flex items-center bg-[#F2E8F5] rounded-full px-1 py-1">
                                    <i class="fa fa-clock text-primary" aria-hidden="true"></i>
                                    <p class="px-2">{{ $ongoing_event->start_time ? \Carbon\Carbon::parse($ongoing_event->start_time)->format('h:i A') : '-' }} - {{ $ongoing_event->end_time ? \Carbon\Carbon::parse($ongoing_event->end_time)->format('h:i A') : '-' }}</p>
                                </div>
                                <div class="flex items-center bg-[#F2E8F5] rounded-full px-1 py-1">
                                    <i class="fa fa-calendar text-primary" aria-hidden="true"></i>
                                    <p class="px-2">{{ \Carbon\Carbon::parse($ongoing_event['event_date'])->format('F j, Y') }}</p>
                                </div>
                                <div class="flex items-center bg-[#F2E8F5] rounded-full px-1 py-1">
                                   <i class="fa fa-map-marker text-primary" aria-hidden="true"></i>
                                    <p class="px-2">{{ $ongoing_event['location'] }}</p>
                                </div>
                            </div>
                            @if ($ongoing_event->registrations->isEmpty())
                            <button onclick="document.querySelector('.registerModal').classList.remove('hidden')" class="student_register mt-4 w-full bg-primary text-white font-medium py-2 rounded-full" data-event_id={{ $ongoing_event->id }}>
                                Register Now
                            </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mt-6">
            <h4 class="font-semibold text-gray-800 mb-4">Register Events</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                  @foreach ($registeredEvents as $register_event)
                    <div class="bg-white rounded-2xl shadow hover:shadow-lg transition">
                        <div class="relative">
                            <img src="{{ asset('storage/' . $register_event->event->banner_image) }}"  alt="Event" class="rounded-t-2xl w-full">
                            @if ($register_event->event->event_type == 'paid')
                            <span class= "absolute top-3 right-3 bg-[#FFC31F] text-white px-3 text-sm py-1 rounded-full">
                                Premium
                            </span>
                            @endif
                            <span class="absolute @if($register_event->event->event_type) mt-2 top-10 @else top-3 @endif  right-3 bg-gradient-to-r from-primary to-pink-600 text-white px-3 text-sm py-1 rounded-full">
                                <span class="text-2xl">25 </span><span>Seats
                                    <pre> Available</span></pre>
                                </span>
                            </span>
                            <span
                                class="absolute bottom-3 left-3 bg-[rgba(128,128,128,0.4)] text-white text-xs px-3 py-1 rounded-full">
                                {{ $register_event->event->title }}
                            </span>
                        </div>
                        <div class="p-2 details">
                            <div class="grid grid-cols-1 gap-1 md:grid-cols-2 text-xs">
                                <div class="flex items-center bg-[#F2E8F5] rounded-full px-1 py-1">
                                     <i class="fa fa-clock text-primary" aria-hidden="true"></i>
                                    <p class="px-2">{{ $register_event->event->start_time ? \Carbon\Carbon::parse($register_event->event->start_time )->format('h:i A') : '-' }} - {{ $register_event->event->end_time ? \Carbon\Carbon::parse($register_event->event->end_time)->format('h:i A') : '-' }}</p>
                                </div>
                                <div class="flex items-center bg-[#F2E8F5] rounded-full px-1 py-1">
                                   <i class="fa fa-calendar text-primary" aria-hidden="true"></i>
                                    <p class="px-2">{{ \Carbon\Carbon::parse($register_event->event->event_date)->format('F j, Y') }}</p>
                                </div>
                                <div class="flex items-center bg-[#F2E8F5] rounded-full px-1 py-1">
                                     <i class="fa fa-map-marker text-primary" aria-hidden="true"></i>
                                    <p class="px-2">{{ $register_event->event->location }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
      @include('components.register.register-modal')
</x-layouts.app>

<script src="{{ asset('admin/js/registration_form.js') }}"></script>

<x-layouts.app>
    <div class="bg-[#F5E8F5] w-full  rounded-full shadow-sm px-8 py-3">
        <!-- Left side -->
        <h3 class="font-semibold text-primary">Assign Tasks</h3>
    </div>
    <section class="p-3 mt-5">
        <!-- Top Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <!-- Pending -->
            <div class="bg-[#FFF6DE] rounded-xl shadow p-4 flex flex-col justify-between">
                <p class="font-semibold">Pending</p>
                <div class="flex items-center justify-between py-2">
                    <h3 class="text-3xl font-bold text-[#FF683D]">2</h3>
                    <img src="{{ asset('/images/task_pending.png') }}" alt="Pending" class="w-14 h-14">
                </div>
            </div>

            <!-- Ongoing -->
            <div class="bg-[#FFEBE4] rounded-xl shadow p-4 flex flex-col justify-between">
                <p class="font-semibold">Ongoing</p>
                <div class="flex items-center justify-between py-2">
                    <h3 class="text-3xl font-bold text-[#F9C539]">3</h3>
                    <img src="{{ asset('/images/task_ongoing.png') }}" alt="Ongoing" class="w-14 h-14">
                </div>
            </div>

            <!-- Completed -->
            <div class="bg-[#DAECFF] rounded-xl shadow p-4 flex flex-col justify-between">
                <p class="font-semibold">Completed</p>
                <div class="flex items-center justify-between py-2">
                    <h3 class="text-3xl font-bold text-[#4CAF50]">3</h3>
                    <img src="{{ asset('/images/task_completed.png') }}" alt="Completed" class="w-14 h-14">
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow p-5 mt-3">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Search -->
                <div class="flex items-center bg-[#F2E8F5] rounded-full px-3">
                    <i class="fa fa-search text-gray-500"></i>
                    <input type="text" placeholder="Search Task"
                        class="w-full bg-transparent rounded-full px-4 py-2 focus:outline-none focus:ring-0">
                </div>

                <!-- Status Filter -->
                <div class="bg-[#F2E8F5] rounded-full">
                    <select class="bg-[#F2E8F5] w-full rounded-full px-4 py-2 focus:outline-none">
                        <option>All Status</option>
                    </select>
                </div>

                <!-- Event Filter -->
                <div class="bg-[#F2E8F5] rounded-full">
                    <select class="bg-[#F2E8F5] w-full rounded-full px-4 py-2 focus:outline-none">
                        <option>All Events</option>
                    </select>
                </div>
            </div>
        </div>
       <div class="flex justify-end">
        <a href="{{ route('create_assign_task') }}"
                class="px-2 w-40 mt-3 bg-gradient-to-r from-primary to-pink-600 text-white font-medium py-1 rounded-full">
                <i class="fa fa-plus" aria-hidden="true"></i>Create Task</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-5">
            @foreach ($tasks as $task)
            <div class="bg-white rounded-2xl shadow hover:shadow-lg transition p-5">
                <!-- Header -->
                <div class="flex items-center justify-between">
                    <p class="font-semibold text-lg text-primary">{{ $task->title ?? '' }}</p>
                    <span class="text-sm bg-primary text-white px-5 py-1 rounded-full">
                        {{ ucfirst($task->priority ?? '') }}</span>
                </div>
                <!-- ID -->
                <p class="text-sm mt-1  px-2 py-1 rounded-full inline-block">By : {{ $task->get_admin->name ?? '' }}</p>
                <p class="text-sm mt-1">{{ $task->description ?? '' }}</p>
                <!-- Image -->
                <div class="grid grid-cols-1 gap-1 md:grid-cols-2 text-xs mt-2">
                    @if ($task->status == 'completed')
                    <div class="flex items-center bg-gradient-to-r from-primary to-pink-600 rounded-full px-10 text-white">
                      Accept
                    </div>
                    @else
                      <div class="flex items-center bg-[#F2E8F5] rounded-full px-2">
                        <i class="fa fa-hourglass-half text-primary" aria-hidden="true"></i>
                        <p class="px-2">
                            @if ($task->status == 'pending')
                             Pending
                            @elseif($task->status == 'completed')
                             <span class="bg-primary text-white">Accept</span>
                            @elseif ($task->status == 'accepted')
                             Accepted
                            @else
                             In progress
                            @endif
                        </p>
                    </div>
                    @endif
                    <div class="flex items-center bg-[#F2E8F5] rounded-full px-2 py-2">
                        <i class="fa fa-calendar text-primary" aria-hidden="true"></i>
                        <p class="px-2">Jan 12, 01 : 30 PM</p>
                    </div>
                </div>
                  <div class="grid grid-cols-1 gap-1 md:grid-cols-2 mt-2">
                    <div>
                        <p class="mt-2 text-xs"><span class="text-primary">•</span><span class="px-2">{{ isset($task->get_task_images) ? count($task->get_task_images) : 0 }} Attachments</span></p>
                    </div>
                     <div class="flex justify-end">
                    <a href="{{ route('create_assign_task', ['task_id' => encrypt($task->id)]) }}">
                                <i class="text-primary fa-solid fa-pen-to-square"></i>
                           </a>
                     </div>
                  </div>
            </div>
            @endforeach
        </div>
    </section>
</x-layouts.app>

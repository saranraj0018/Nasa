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

         <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-5">
                 <div class="bg-white rounded-2xl shadow hover:shadow-lg transition p-5">
                    <!-- Header -->
                    <div class="flex items-center justify-between">
                        <p class="font-semibold text-lg text-primary">AI Smart Automation</p>
                        <span class="text-sm bg-primary text-white px-5   rounded-full">Fast</span>
                    </div>

                    <!-- ID -->
                    <p class="text-sm mt-1  px-2 py-1 rounded-full inline-block">By : Dr. Elen Vasu</p>
                    <p class="text-sm mt-1"> Prepare comprehensive documentation and safety protocols for the upcomig</p>

                    <!-- Image -->
                    <div class="grid grid-cols-1 gap-1 md:grid-cols-2 text-xs">
                                <div class="flex items-center bg-[#F2E8F5] rounded-full px-1 py-1">
                                    <i class="fa fa-clock text-primary" aria-hidden="true"></i>
                                    <p class="px-2"></p>
                                </div>
                                <div class="flex items-center bg-[#F2E8F5] rounded-full px-1 py-1">
                                     <i class="fa fa-calendar text-primary" aria-hidden="true"></i>
                                    <p class="px-2"></p>
                                </div>
                            </div>

                    <!-- Buttons -->
                    <div class="grid grid-cols-2 gap-3 mt-4">
                        <button
                            class="w-full bg-gradient-to-r from-primary to-pink-600 text-white font-medium py-2 rounded-full">
                            <i class="fa fa-check-circle mr-1"></i> Present
                        </button>
                        <button
                            class="w-full bg-gradient-to-r from-primary to-pink-600 text-white font-medium py-2 rounded-full">
                            <i class="fa fa-times-circle mr-1"></i> Absent
                        </button>
                    </div>
                </div>
        </div>

        <h3 class="font-semibold text-primary mt-8">Assign Task to Admin</h3>

        <form id="eventForm" action="{{ route('student_register_event') }}" method="POST" enctype="multipart/form-data"
            class="space-y-4 mt-8">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="col-span-2">
                    <label class="block text-sm font-medium">Select Admin<span class="text-red-600">*</span></label>
                    <select name="club_id" id="club"
                        class="bg-[#D9D9D9] w-full rounded-full px-4 py-3 mt-1 focus:outline-none focus:ring focus:ring-primary/40">
                        <option value="">Select Club</option>
                    </select>
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium">Task Title<span class="text-red-500">*</span></label>
                    <input type="text" name="contact_person" required placeholder="Enter Task Title"
                        class="w-full bg-[#D9D9D9] rounded-full px-4 py-2 mt-1 focus:outline-none focus:ring focus:ring-primary/40">
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium">Description<span class="text-red-600">*</span></label>
                    <textarea name="description" required
                        class="bg-[#D9D9D9] w-full p-3 border border-gray-300 rounded-2xl focus:outline-none focus:ring focus:ring-primary/40"
                        rows="4" placeholder="Describe the task details"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium">Priority Level<span class="text-red-500">*</span></label>
                    <select name="priority_level" id="club"
                        class="bg-[#D9D9D9] w-full rounded-full py-3 px-3 focus:outline-none focus:ring focus:ring-primary/40">
                        <option value="">Select Club</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium">Deadline Date<span class="text-red-500">*</span></label>
                    <input type="date" name="deadline_date" required placeholder="Pick a date"
                        class="w-full bg-[#D9D9D9] rounded-full px-4 py-2 mt-1 focus:outline-none focus:ring focus:ring-primary/40">
                </div>
                <div class="bg-[#F0F0F0] rounded-3xl p-10 text-center relative col-span-2">
                    <div id="uploadBox" class="space-y-8">
                        <div id="dropArea" class="border-2 border-dashed border-primary rounded-2xl p-8 relative">
                            <div id="previewArea" class="grid grid-cols-2 gap-4"></div>
                            <div id="uploadText">
                                <img src="{{ asset('/images/upload.png') }}" class="mx-auto w-14 mb-3" />
                                <p class="text-primary font-semibold">Upload event banner image</p>
                                <p class="text-primary text-sm mt-2">PNG, JPG up to 5MB</p>
                            </div>
                            <input type="file" id="fileInput" name="banner_image" accept="image/*" class="hidden" />
                        </div>
                    </div>
                </div>
            </div>
            <!-- Center-Aligned Button -->
            <div class="flex justify-center mt-10">
                <button type="submit"
                    class="px-10 bg-gradient-to-r from-primary to-pink-600 text-white font-semibold py-3 rounded-full hover:opacity-90 transition">
                    Assign Task
                </button>
            </div>
        </form>
    </section>
</x-layouts.app>

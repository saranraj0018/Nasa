<x-layouts.app>
    <div class="bg-[#F5E8F5] w-full h-[70px] rounded-full shadow-sm px-8 py-3">
        <h3 class="font-semibold text-primary">Create New Event</h3>
        <p>Set up a new mission event for student participation</p>
    </div>
    <h1 class="text-primary font-semibold mt-10 px-3">Event Information</h1>
    <p class="px-3">Basic Details about your event</p>
    <form id="eventForm" action="{{ route('student_register_event') }}" method="POST" enctype="multipart/form-data" class="space-y-4 mt-8 px-3">
        @csrf
        <!-- Event Info Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium">Event Title<span class="text-red-500">*</span></label>
                <input type="text" name="title" required
                    class="w-full bg-[#D9D9D9] rounded-full px-4 py-2 mt-1 focus:outline-none focus:ring focus:ring-primary/40">
            </div>
            <div>
                <label class="block text-sm font-medium">Select Club<span class="text-red-600">*</span></label>
                <select name="club_id" id="club"
                    class="bg-[#D9D9D9] w-full rounded-full py-3 px-3 focus:outline-none focus:ring focus:ring-[#ab5f00]">
                    <option value="">Select Club</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium">Programme Officer<span class="text-red-600">*</span></label>
                <select name="programme_officer" id="programme_officer"
                    class="bg-[#D9D9D9] w-full rounded-full py-3 px-3 focus:outline-none focus:ring-2 focus:ring-[#ab5f00]">
                    <option value="">Select Programme Officer</option>
                </select>
            </div>
            <div class="col-span-2">
                <label class="block text-sm font-medium">Event Description<span class="text-red-600">*</span></label>
                <textarea name="description" required
                    class="bg-[#D9D9D9] w-full p-3 border border-gray-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                    rows="4" placeholder="Provide a detailed description of the event objective, activities, and learning outcomes"></textarea>
            </div>
        </div>

        <!-- Schedule Section -->
        <h1 class="text-primary font-semibold mt-10 px-3">Schedule & Location</h1>
        <p class="px-3">When and where the event will take place</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-medium">Event Date<span class="text-red-500">*</span></label>
                <input type="date" name="event_date" required
                    class="w-full bg-[#D9D9D9] rounded-full px-4 py-2 mt-1 focus:outline-none focus:ring focus:ring-primary/40">
            </div>

            <div>
                <label class="block text-sm font-medium">Start Time<span class="text-red-600">*</span></label>
                <input type="time" name="start_time" required
                    class="w-full bg-[#D9D9D9] rounded-full px-4 py-2 mt-1 focus:outline-none focus:ring focus:ring-primary/40">
            </div>

            <div>
                <label class="block text-sm font-medium">End Time<span class="text-red-600">*</span></label>
                <input type="time" name="end_time" required
                    class="w-full bg-[#D9D9D9] rounded-full px-4 py-2 mt-1 focus:outline-none focus:ring focus:ring-primary/40">
            </div>

            <div class="col-span-2">
                <label class="block text-sm font-medium">Location / Virtual Link<span class="text-red-600">*</span></label>
                <textarea name="location" required
                    class="bg-[#D9D9D9] w-full p-3 border border-gray-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                    rows="3" placeholder="Enter the event venue or virtual meeting link"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium">Session<span class="text-red-600">*</span></label>
                <input type="text" name="session" required
                    class="w-full bg-[#D9D9D9] rounded-full px-4 py-2 mt-1 focus:outline-none focus:ring focus:ring-primary/40">
            </div>
        </div>

        <!-- Registration Details -->
        <h1 class="text-primary font-semibold mt-10 px-3">Registration Details</h1>
        <p class="px-3">Eligibility and registration requirements</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium">Eligibility Criteria<span class="text-red-600">*</span></label>
                <textarea name="eligibility" required
                    class="bg-[#D9D9D9] w-full p-3 border border-gray-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                    rows="4" placeholder="e.g., Engineering students, Grade 10-12, Previous workshop attendance required."></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium">Registration Deadline<span class="text-red-500">*</span></label>
                <input type="date" name="registration_deadline" required
                    class="w-full bg-[#D9D9D9] rounded-full px-4 py-2 mt-1 focus:outline-none focus:ring focus:ring-primary/40">
            </div>

            <div>
                <label class="block text-sm font-medium">Contact Person<span class="text-red-500">*</span></label>
                <input type="text" name="contact_person" required placeholder="Full name of Contact Person"
                    class="w-full bg-[#D9D9D9] rounded-full px-4 py-2 mt-1 focus:outline-none focus:ring focus:ring-primary/40">
            </div>

            <div>
                <label class="block text-sm font-medium">Contact Email<span class="text-red-500">*</span></label>
                <input type="email" name="contact_email" required placeholder="contact@example.com"
                    class="w-full bg-[#D9D9D9] rounded-full px-4 py-2 mt-1 focus:outline-none focus:ring focus:ring-primary/40">
            </div>
        </div>

        <!-- Additional Details -->
        <h1 class="text-primary font-semibold mt-10 px-3">Additional Details</h1>
        <p class="px-3">Banner image and additional notes</p>

        <div class="grid grid-cols-1">
            <div class="bg-[#F0F0F0] rounded-3xl p-10 text-center relative">
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
                Create Event
            </button>
        </div>
    </form>
</x-layouts.app>



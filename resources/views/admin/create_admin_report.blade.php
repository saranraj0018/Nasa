<x-layouts.app>
    <!-- Header -->
    <div class="bg-[#F5E8F5] w-full h-[70px] rounded-full shadow-sm px-8 py-3">
        <h3 class="font-semibold text-primary">Event Report Submission</h3>
        <p>Submit comprehensive reports for completed events</p>
    </div>

    <form id="eventReportForm" action="{{ route('student_register_event') }}" method="POST" enctype="multipart/form-data" class="mt-8 px-4">
        @csrf
        <!-- EVENT INFORMATION -->
        <h2 class="text-primary font-semibold mt-10 px-4">Event Information</h2>
        <p class="px-4 text-gray-600 text-sm">Select the completed events and confirm details</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 px-4 mt-4">
            <div>
                <label class="block text-sm font-medium">Event Name <span class="text-red-600">*</span></label>
                <input type="text" name="event_name" placeholder="e.g. AI Engineering Workshop"
                    class="bg-[#D9D9D9] w-full rounded-full py-3 px-4 mt-1 focus:outline-none focus:ring-2 focus:ring-primary/40">
            </div>
            <div>
                <label class="block text-sm font-medium">Event Date <span class="text-red-600">*</span></label>
                <input type="date" name="event_date"
                    class="bg-[#D9D9D9] w-full rounded-full py-3 px-4 mt-1 focus:outline-none focus:ring-2 focus:ring-primary/40">
            </div>
        </div>
        <!-- PARTICIPATION SUMMARY -->
        <h2 class="text-primary font-semibold mt-10 px-4">Participation Summary</h2>
        <p class="px-4 text-gray-600 text-sm">Details about event attendance and participants</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 px-4 mt-4">
            <div>
                <label class="block text-sm font-medium">Male Count <span class="text-red-600">*</span></label>
                <input type="number" name="male_count" placeholder="0"
                    class="bg-[#D9D9D9] w-full rounded-full py-3 px-4 mt-1 focus:outline-none focus:ring-2 focus:ring-primary/40">
            </div>
            <div>
                <label class="block text-sm font-medium">Female Count <span class="text-red-600">*</span></label>
                <input type="number" name="female_count" placeholder="0"
                    class="bg-[#D9D9D9] w-full rounded-full py-3 px-4 mt-1 focus:outline-none focus:ring-2 focus:ring-primary/40">
            </div>
        </div>
        <!-- EVENT OUTCOMES -->
        <h2 class="text-primary font-semibold mt-10 px-4">Event Outcomes</h2>
        <div class="px-4 mt-2">
            <label class="block text-sm font-medium">Outcomes & Results <span class="text-red-600">*</span></label>
            <textarea name="outcomes" rows="4" placeholder="Describe the main achievements, successful activities, notable moments, learning outcomes..."
                class="bg-[#D9D9D9] w-full rounded-2xl p-3 mt-1 focus:outline-none focus:ring-2 focus:ring-primary/40"></textarea>
        </div>
        <!-- EVENT PROOF IMAGES -->
        <h2 class="text-primary font-semibold mt-10 px-4">Event Proof Images</h2>
        <div class="px-4 mt-4">
            <div class="border-2 border-dashed border-primary rounded-2xl p-8 text-center">
                <img src="{{ asset('/images/upload.png') }}" class="mx-auto w-14 mb-3" />
                <p class="text-primary font-semibold">Upload event images (max 4 images)</p>
                <p class="text-sm text-primary mt-1">PNG, JPG</p>
                <input type="file" name="event_images[]" accept="image/*" multiple class="hidden" id="event_images">
            </div>
        </div>
        <!-- FEEDBACK SUMMARY -->
        <h2 class="text-primary font-semibold mt-10 px-4">Feedback Summary</h2>
        <div class="px-4 mt-2">
            <textarea name="feedback_summary" rows="3" placeholder="Summarize participant feedback, ratings, testimonials, suggestions for improvement, and satisfaction levels..."
                class="bg-[#D9D9D9] w-full rounded-2xl p-3 mt-1 focus:outline-none focus:ring-2 focus:ring-primary/40"></textarea>
        </div>
        <!-- SUPPORTING FILES -->
        <h2 class="text-primary font-semibold mt-10 px-4">Supporting Files</h2>
        <p class="px-4 text-gray-600 text-sm">Upload images, certificates, documents, and other supporting materials</p>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 px-4 mt-4">
            <div class="border-2 border-dashed border-primary rounded-2xl p-6 text-center">
                <img src="{{ asset('/images/upload.png') }}" class="mx-auto w-10 mb-2" />
                <p class="text-primary font-semibold">Upload Certificates</p>
                <input type="file" name="certificates[]" accept=".jpg,.png,.pdf" class="hidden" id="certificates">
            </div>
            <div class="border-2 border-dashed border-primary rounded-2xl p-6 text-center">
                <img src="{{ asset('/images/upload.png') }}" class="mx-auto w-10 mb-2" />
                <p class="text-primary font-semibold">Upload Attendance List - IN</p>
                <input type="file" name="attendance_in" accept=".jpg,.png,.pdf" class="hidden" id="attendance_in">
            </div>
            <div class="border-2 border-dashed border-primary rounded-2xl p-6 text-center">
                <img src="{{ asset('/images/upload.png') }}" class="mx-auto w-10 mb-2" />
                <p class="text-primary font-semibold">Upload Attendance List - OUT</p>
                <input type="file" name="attendance_out" accept=".jpg,.png,.pdf" class="hidden" id="attendance_out">
            </div>
        </div>
        <!-- SUBMIT BUTTON -->
        <div class="flex justify-center mt-12 mb-10">
            <button type="submit"
                class="px-10 bg-gradient-to-r from-primary to-pink-600 text-white font-semibold py-3 rounded-full hover:opacity-90 transition">
                Submit Reports
            </button>
        </div>
    </form>
</x-layouts.app>

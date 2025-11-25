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
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-5">
        <div class="bg-white rounded-2xl shadow hover:shadow-lg transition p-5">
            <!-- Header -->
            <p class="font-semibold text-lg">AI Smart Automation</p>
            <p class="text-xs mt-2"><i class="fa fa-calendar text-primary" aria-hidden="true"></i>Event - March 20, 2025
                (10.00AM)</p>
            <p class="mt-2 text-xs"><i class="fa fa-clock text-primary" aria-hidden="true"></i>Submitted : March 21,
                2025 (12.00PM)</p>
            <div class="flex items-center justify-between py-2">
                <p class="mt-2 text-xs bg-[#F2E8F5] py-2 px-3 rounded-full text-primary">AI Workshop</p>
            </div>
            <!-- Image -->
            <div class="grid grid-cols-2 gap-3 mt-4">
                <button
                    class="w-full bg-gradient-to-r from-primary to-pink-600 text-white font-medium py-1 rounded-full">
                   <i class="fa fa-eye" aria-hidden="true"></i> View Pdf
                </button>
                <button
                    class="w-full bg-gradient-to-r from-primary to-pink-600 text-white font-medium py-1 rounded-full">
                    <i class="fa fa-download" aria-hidden="true"></i> Download
                </button>
            </div>
        </div>
    </div>
</x-layouts.app>

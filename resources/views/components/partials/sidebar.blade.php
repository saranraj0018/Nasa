<aside class="fixed top-0 left-0 h-full w-64 mx-3 overflow-y-auto border-r-1 border-zinc-300 bg-[#FCF7FC]">
    <!-- Brand Logo -->
    <div class="p-5">
        <x-app-logo />
    </div>

    {{-- PROFILE SEGMENT IN SIDEBAR --}}

    <div class="space-y-2">
        <img src="{{ asset('/images/profilesss.png') }}" alt="" class="mx-auto">
        <div class="text-center font-medium text-md text-black">
            Welcome Back
        </div>
        <div class="text-center font-medium text-md text-primary">
            ALEX TIER
        </div>
        <div class="text-center font-medium text-md text-primary">
            ID - 123456789
        </div>
    </div>

    {{-- PROFILE SEGMENT IN SIDEBAR - ENDS --}}

    {{-- MENU SEGMENT IN SIDEBAR --}}
    <ul class="mt-8 mx-3 space-y-2">
        <x-menu.list>
              @if (!empty(session()->get('student')))
            <x-slot:trigger>
                <x-menu.item trigger name="Curriculum" icon="fa-book" />
            </x-slot:trigger>
            <x-slot:menus>
                <x-menu.item name="Dashboard" icon="fa-home" route="student_dashboard" />
                <x-menu.item name="Register for Events" icon="fa-calendar" route="register_events" />
                <x-menu.item name="My Registration" icon="fa-check-circle" route="my_register_events" />
                <x-menu.item name="Certificates" icon="fa-trophy" route="certificates" />
                {{-- <x-menu.item name="Upload Proofs" icon="fa-file-text" /> --}}
            </x-slot:menus>
            @endif
        </x-menu.list>
        <x-menu.item name="Home" icon="fa-home" route="super_admin_home" />
        <x-menu.item name="Events" icon="fa-calendar-minus" route="events" />
        <x-menu.item name="Create Event" icon="fa-pencil-square" route="create_event" />
        <x-menu.item name="Assign Tasks" icon="fa-check-circle" route="assign_tasks" />
        <x-menu.item name="Review Reports" icon="fa-check-circle" route="review_reports" />
        <x-menu.item name="Student Approval" icon="fa-graduation-cap" route="student_approval" />
        <x-menu.item name="Non-Curriculum" icon="fa-graduation-cap" />

    </ul>
    {{-- MENU SEGMENT IN SIDEBAR -ENDS --}}
    <div class="flex gap-3 mt-16">
        <img src="{{ asset('/images/profilesss.png') }}" alt="" class="w-1/5">
        <div class="my-auto space-y-1">
            <form method="POST" action="{{ route('student.logout') }}">
            @csrf
            <button type="submit" class="text-sm font-medium hover:underline">
                Logout
            </button>
        </form>
            <p class="text-sm font-medium text-black">ID - 123456789</p>
        </div>
    </div>
</aside>

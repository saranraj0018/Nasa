{{--
    Shared filter bar for list pages.
    Usage: <x-list-filter :action="route('club_list')" :keys="['search', 'faculty_id']"> ...fields... </x-list-filter>
--}}
@props(['action', 'keys' => [], 'title' => 'Filter'])
<section class="p-4 bg-white rounded-xl shadow-md mt-3">
    @if ($title)
        <h4 class="font-semibold text-gray-800 mb-3">{{ $title }}</h4>
    @endif
    <form method="GET" action="{{ $action }}" class="flex flex-col md:flex-row md:flex-wrap md:items-center gap-3">
        {{ $slot }}
        <div class="flex gap-2">
            <button type="submit"
                class="px-6 py-2 bg-gradient-to-r from-primary to-pink-600 text-white text-sm rounded-full hover:opacity-90 transition">
                <i class="fa fa-search mr-1"></i> Search
            </button>
            @if (request()->anyFilled($keys))
                <a href="{{ $action }}"
                    class="px-5 py-2 bg-gray-400 text-white text-sm rounded-full hover:bg-gray-500 transition">
                    Reset
                </a>
            @endif
        </div>
    </form>
</section>

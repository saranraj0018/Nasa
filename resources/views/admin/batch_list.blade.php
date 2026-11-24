<x-layouts.app>
    <div class="bg-[#F5E8F5] w-full rounded-full shadow-sm px-8 py-3">
        <h3 class="font-semibold text-primary">Batch</h3>
    </div>
    <div class="flex justify-end">
        <a href="{{ route('create_batch') }}"
            class="px-2 w-30 mt-3 bg-gradient-to-r from-primary to-pink-600 text-white font-medium py-1 rounded-full">
            <i class="fa fa-plus" aria-hidden="true"></i> ADD Batch</a>
    </div>
    <x-list-filter :action="route('batch_list')" :keys="['search', 'status']">
        <div class="w-full md:flex-1 md:min-w-[250px]">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search batch e.g. 2025"
                class="w-full border border-gray-300 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary">
        </div>
        <div class="w-full md:w-48">
            <select name="status" class="w-full border border-gray-300 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                <option value="">All Status</option>
                <option value="active" @selected(request('status') == 'active')>Active</option>
                <option value="inactive" @selected(request('status') == 'inactive')>Inactive</option>
            </select>
        </div>
    </x-list-filter>
    <section class="p-2 mt-3">
        <div class="mt-6">
            <h4 class="font-semibold text-gray-800 mb-4">Batch List</h4>
            <div class="overflow-x-auto bg-white rounded-xl shadow-md">
                <table class="w-full text-sm text-left text-gray-700 border-collapse">
                    <thead>
                        <tr class="bg-primary text-white text-sm uppercase tracking-wider">
                            <th class="px-3 py-2">S.No</th>
                            <th class="px-3 py-2">Batch</th>
                            <th class="px-3 py-2">Status</th>
                            <th class="px-3 py-2 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($batches as $batch)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $batches->firstItem() + $loop->index }}</td>
                                <td class="px-4 py-3">{{ $batch->name }}</td>
                                <td class="px-4 py-3">
                                    @if ($batch->is_active)
                                        <span class="px-2 py-1 rounded-full bg-green-100 text-green-700 text-xs">Active</span>
                                    @else
                                        <span class="px-2 py-1 rounded-full bg-gray-200 text-gray-600 text-xs">Inactive</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <a href="{{ route('create_batch', ['batch_id' => encrypt($batch->id)]) }}" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-6 text-center text-gray-500">No batches found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4">
                {{ $batches->links() }}
            </div>
        </div>
    </section>
</x-layouts.app>

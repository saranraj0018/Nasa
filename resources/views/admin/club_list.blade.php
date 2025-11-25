<x-layouts.app>
    <div class="bg-[#F5E8F5] w-full rounded-full shadow-sm px-8 py-3">
        <h3 class="font-semibold text-primary">Club</h3>
    </div>
    <div class="flex justify-end">
        <a href="{{ route('create_club') }}"
                class="px-2 w-30 mt-3 bg-gradient-to-r from-primary to-pink-600 text-white font-medium py-1 rounded-full">
                <i class="fa fa-plus" aria-hidden="true"></i>ADD Club</a>
    </div>
     <section class="p-2 mt-3">
        <div class="mt-6">
            <h4 class="font-semibold text-gray-800 mb-4">Club List</h4>
             <div class="overflow-x-auto bg-white rounded-xl shadow-md">
            <table class="w-full text-sm text-left text-gray-700 border-collapse">
                <thead>
                <tr class="bg-primary text-white text-sm uppercase tracking-wider">
                    <th class="px-3 py-2">S.No</th>
                    <th class="px-3 py-2">Club Name</th>
                    <th class="px-3 py-2">Description</th>
                    <th class="px-3 py-2">Faculty Name</th>
                    <th class="px-3 py-2">Action</th>
                 </tr>
                </thead>
                <tbody id="studentTableBody" class="divide-y divide-gray-200">
                @foreach($clubs as $club)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $club->name ?? ''}}</td>
                        <td class="px-4 py-3">{{ $club->description ??''  }}</td>
                        <td class="px-4 py-3">{{ $club->get_faculty->name ?? ''}}</td>
                        <td class="px-4 py-3 flex justify-center gap-4">
                        <a href="{{ route('create_club', ['club_id' => encrypt($club->id)]) }}">
                             <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
         <div class="p-4">
            {{ $clubs->links() }}
        </div>
        </div>
    </section>
</x-layouts.app>



<x-layouts.app>
    <div class="bg-[#F5E8F5] w-full rounded-full shadow-sm px-6 py-4 flex justify-between items-center">
        <div class="flex flex-col">
            <h3 class="font-semibold text-primary text-lg">
                {{ $edit_batch ? 'Edit Batch' : 'Create New Batch' }}
            </h3>
        </div>
        <a href="{{ route('batch_list') }}"
            class="flex items-center text-gray-700 hover:text-primary transition-colors">
            <i class="fa-solid fa-arrow-left mr-2"></i> Back
        </a>
    </div>

    <h1 class="text-primary font-semibold mt-10 px-3">Batch Information</h1>
    <p class="px-3">Batches added here appear in every Batch dropdown. Inactive batches are hidden from the dropdowns.</p>

    <form id="batchForm" method="POST" class="space-y-4 mt-8 px-3">
        @csrf
        @if ($edit_batch)
            <input type="hidden" name="batch_id" value="{{ $edit_batch->id }}">
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium">Batch<span class="text-red-500">*</span></label>
                <input type="text" name="batch_name" id="batch_name" value="{{ $edit_batch->name ?? '' }}"
                    placeholder="e.g, 2025-2029" maxlength="9"
                    class="w-full bg-[#D9D9D9] rounded-full px-4 py-2 mt-1">
            </div>
            <div>
                <label class="block text-sm font-medium">Status<span class="text-red-500">*</span></label>
                <select name="is_active" id="is_active" class="bg-[#D9D9D9] w-full rounded-full py-2 px-3 mt-1">
                    <option value="1" @selected(!$edit_batch || $edit_batch->is_active)>Active</option>
                    <option value="0" @selected($edit_batch && !$edit_batch->is_active)>Inactive</option>
                </select>
            </div>
        </div>

        <div class="flex justify-center mt-10">
            <button type="submit" id="batchSaveBtn"
                class="px-3 bg-gradient-to-r from-primary to-pink-600 text-white font-semibold py-1 w-35 rounded-full hover:opacity-90 transition">
                <i class="fas fa-save"></i> {{ $edit_batch ? 'Update Batch' : 'Create Batch' }}
            </button>
        </div>
    </form>
</x-layouts.app>
@include('partials.js_routes.batch')
<script src="{{ asset('admin/js/batch.js') }}?v={{ time() }}"></script>

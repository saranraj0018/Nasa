<x-layouts.app>

    <!-- Header -->
    <div class="bg-[#F5E8F5] w-full h-[90px] rounded-full shadow-sm px-8 py-3 flex flex-col justify-center">
        <h3 class="font-semibold text-primary">Student Attendance Management</h3>
        <p class="text-sm text-gray-700">Mark entry & exit</p>
    </div>

    <!-- Back -->
    <a href="{{ route('student_attendance') }}" class="inline-block mt-3">
        <i class="fa-solid fa-arrow-left"></i>
    </a>

    <!-- Success Message -->
    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                showToast("{{ session('success') }}", "success");
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                showToast("{{ session('error') }}", "error");
            });
        </script>
    @endif

    <section class="p-3 mt-4">
        <!-- Title -->
        <div class="flex justify-between items-center">
            <h1 class="text-lg font-semibold text-gray-800">
                Event : {{ $event->title ?? '' }}
            </h1>
            @if (!empty($attendance_entry) && $attendance_entry->count() > 0)
                <a href="{{ route('attendance.download', ['event_id' => $event->id]) }}"
                    class="bg-primary text-white px-4 py-2 rounded-full shadow transition">
                    <i class="fa fa-download mr-1"></i> Download
                </a>
            @endif
        </div>

        <!-- FORM START -->
        <form method="POST" action="{{ route('attendance.mark') }}">
            @csrf
            <input type="hidden" name="event_id" value="{{ $event->id }}">
            @php
                $anyEntryExists = $attendance_entry->whereNotNull('entry_time')->count() > 0;
                $anyExitExists = $attendance_entry->whereNotNull('exit_time')->count() > 0;
                $disableSubmit =
                    $attendance_entry->whereNotNull('entry_time')->count() > 0 ||
                    $attendance_entry->whereNotNull('exit_time')->count() > 0;
            @endphp
            <div class="mt-4 bg-white rounded-2xl shadow overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-primary text-white uppercase text-sm">
                        <tr>
                            <th class="px-4 py-3">S.No</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Department</th>
                            <th class="px-4 py-3">Phone</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3 text-center"> Entry <br> <input type="checkbox" id="selectAllEntry">
                            </th>
                            <th class="px-4 py-3 text-center">Exit <br> <input type="checkbox" id="selectAllExit"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($registeredStudents) && $registeredStudents->count() > 0)
                            @foreach ($registeredStudents as $attendance)
                                @php
                                    $studentEntryExists =
                                        $attendance_entry
                                            ->where('student_id', $attendance->student_id)
                                            ->where('event_id', $event->id)
                                            ->whereNotNull('entry_time')
                                            ->count() > 0;

                                    $studentExitExists =
                                        $attendance_entry
                                            ->where('student_id', $attendance->student_id)
                                            ->where('event_id', $event->id)
                                            ->whereNotNull('exit_time')
                                            ->count() > 0;
                                @endphp

                                <tr class="border-t">
                                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3">{{ $attendance->student?->name }}</td>
                                    <td class="px-4 py-3">{{ $attendance->student?->get_department?->name }}</td>
                                    <td class="px-4 py-3">{{ $attendance->student?->mobile_number }}</td>
                                    <td class="px-4 py-3">{{ $attendance->student?->email }}</td>

                                    <!-- ENTRY -->
                                    <td class="px-4 py-3 text-center">
                                        <label class="inline-flex items-center">
                                            <input type="checkbox"
                                                name="attendance[{{ $attendance->student_id }}][entry]"
                                                class="form-checkbox h-5 w-5 text-green-500 entry-checkbox"
                                                {{ $studentEntryExists ? 'checked' : '' }}
                                                {{ $anyEntryExists ? 'disabled' : '' }}>
                                        </label>
                                    </td>

                                    <!-- EXIT -->
                                    <td class="px-4 py-3 text-center">
                                        <label class="inline-flex items-center">
                                            <input type="checkbox"
                                                name="attendance[{{ $attendance->student_id }}][exit]"
                                                class="form-checkbox h-5 w-5 text-red-500 exit-checkbox"
                                                {{ $studentExitExists ? 'checked' : '' }}
                                                {{ $anyExitExists ? 'disabled' : '' }}>
                                        </label>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center py-6 text-gray-500">
                                    No registered students found
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="mt-5 text-center">
                <button type="submit" class="bg-primary text-white px-8 py-2 rounded-full shadow transition"
                    {{ $anyExitExists && $studentExitExists ? 'disabled' : '' }}>
                    Submit Attendance
                </button>
            </div>
        </form>

        <!-- FORM END -->
    </section>

</x-layouts.app>
<script>
    // Select All Entry
    document.getElementById('selectAllEntry').addEventListener('change', function () {
        document.querySelectorAll('.entry-checkbox:not(:disabled)').forEach(cb => {
            cb.checked = this.checked;
        });
    });

    // Select All Exit
    document.getElementById('selectAllExit').addEventListener('change', function () {
        document.querySelectorAll('.exit-checkbox:not(:disabled)').forEach(cb => {
            cb.checked = this.checked;
        });
    });
</script>

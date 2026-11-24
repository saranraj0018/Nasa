{{-- URLs used by public/admin/js/student_attendance.js, generated from named routes --}}
@php
    $jsRoutes = [
        'attendance_mark' => route('attendance.mark'),
    ];
@endphp
<script>
    window.appRoutes = Object.assign(window.appRoutes || {}, {{ Illuminate\Support\Js::from($jsRoutes) }});
</script>

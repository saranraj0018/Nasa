{{-- URLs used by public/admin/js/student_approval.js, generated from named routes --}}
@php
    $jsRoutes = [
        'student_event_approval' => route('student_event_approval'),
    ];
@endphp
<script>
    window.appRoutes = Object.assign(window.appRoutes || {}, {{ Illuminate\Support\Js::from($jsRoutes) }});
</script>

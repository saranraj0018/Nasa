{{-- URLs used by public/admin/js/registration_form.js, generated from named routes --}}
@php
    $jsRoutes = [
        'get_student' => route('get_student'),
        'student_register_event' => route('student_register_event'),
        'cashfree_order' => route('cashfree.order'),
    ];
@endphp
<script>
    window.appRoutes = Object.assign(window.appRoutes || {}, {{ Illuminate\Support\Js::from($jsRoutes) }});
</script>

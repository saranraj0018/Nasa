{{-- URLs used by public/admin/js/student.js, generated from named routes --}}
@php
    $jsRoutes = [
        'save_student' => route('save_student'),
        'student_list' => route('student_list'),
        'student_register_save' => route('student.register_save'),
        'student_login' => route('student.login'),
    ];
@endphp
<script>
    window.appRoutes = Object.assign(window.appRoutes || {}, {{ Illuminate\Support\Js::from($jsRoutes) }});
</script>

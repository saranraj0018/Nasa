{{-- URLs used by public/admin/js/faculty.js, generated from named routes --}}
@php
    $jsRoutes = [
        'save_faculty' => route('save_faculty'),
        'faculty_list' => route('faculty_list'),
    ];
@endphp
<script>
    window.appRoutes = Object.assign(window.appRoutes || {}, {{ Illuminate\Support\Js::from($jsRoutes) }});
</script>

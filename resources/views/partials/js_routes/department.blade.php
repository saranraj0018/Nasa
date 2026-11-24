{{-- URLs used by public/admin/js/department.js, generated from named routes --}}
@php
    $jsRoutes = [
        'save_department' => route('save_department'),
        'department_list' => route('department_list'),
        'save_programme' => route('save_programme'),
        'programme_list' => route('programme_list'),
    ];
@endphp
<script>
    window.appRoutes = Object.assign(window.appRoutes || {}, {{ Illuminate\Support\Js::from($jsRoutes) }});
</script>

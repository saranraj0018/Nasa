{{-- URLs used by public/admin/js/tasks.js, generated from named routes --}}
@php
    $jsRoutes = [
        'save_task' => route('save_task'),
        'assign_tasks' => route('assign_tasks'),
    ];
@endphp
<script>
    window.appRoutes = Object.assign(window.appRoutes || {}, {{ Illuminate\Support\Js::from($jsRoutes) }});
</script>

{{-- URLs used by public/admin/js/report.js, generated from named routes --}}
@php
    $jsRoutes = [
        'create_report' => route('create_report'),
        'save_report' => route('save_report'),
        'reports' => route('reports'),
    ];
@endphp
<script>
    window.appRoutes = Object.assign(window.appRoutes || {}, {{ Illuminate\Support\Js::from($jsRoutes) }});
</script>

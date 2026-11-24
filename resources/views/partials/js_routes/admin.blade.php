{{-- URLs used by public/admin/js/admin.js, generated from named routes --}}
@php
    $jsRoutes = [
        'save_admin' => route('save_admin'),
        'admin_list' => route('admin_list'),
    ];
@endphp
<script>
    window.appRoutes = Object.assign(window.appRoutes || {}, {{ Illuminate\Support\Js::from($jsRoutes) }});
</script>

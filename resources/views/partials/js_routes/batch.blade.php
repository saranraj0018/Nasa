{{-- URLs used by public/admin/js/batch.js, generated from named routes --}}
@php
    $jsRoutes = [
        'save_batch' => route('save_batch'),
        'batch_list' => route('batch_list'),
    ];
@endphp
<script>
    window.appRoutes = Object.assign(window.appRoutes || {}, {{ Illuminate\Support\Js::from($jsRoutes) }});
</script>

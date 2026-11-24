{{-- URLs used by public/admin/js/credit_point.js, generated from named routes --}}
@php
    $jsRoutes = [
        'save_credit_point' => route('save_credit_point'),
        'credit_point_assign' => route('credit_point_assign'),
    ];
@endphp
<script>
    window.appRoutes = Object.assign(window.appRoutes || {}, {{ Illuminate\Support\Js::from($jsRoutes) }});
</script>

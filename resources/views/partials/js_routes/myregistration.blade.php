{{-- URLs used by public/admin/js/myregistration.js, generated from named routes --}}
@php
    $jsRoutes = [
        'uploaded_proof' => route('uploaded_proof'),
        'upload_proof' => route('upload_proof'),
    ];
@endphp
<script>
    window.appRoutes = Object.assign(window.appRoutes || {}, {{ Illuminate\Support\Js::from($jsRoutes) }});
</script>

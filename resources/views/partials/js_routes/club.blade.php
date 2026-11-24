{{-- URLs used by public/admin/js/club.js, generated from named routes --}}
@php
    $jsRoutes = [
        'save_club' => route('save_club'),
        'club_list' => route('club_list'),
    ];
@endphp
<script>
    window.appRoutes = Object.assign(window.appRoutes || {}, {{ Illuminate\Support\Js::from($jsRoutes) }});
</script>

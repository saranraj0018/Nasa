{{-- URLs used by public/admin/js/events.js, generated from named routes --}}
@php
    $jsRoutes = [
        'save_event' => route('save_event'),
        'event_list' => route('event_list'),
        'events_destroy' => route('events.destroy', ['id' => '__ID__']),
        'events_toggle_status' => route('events.toggle_status', ['id' => '__ID__']),
        'events_toggle_publish' => route('events.toggle_publish', ['id' => '__ID__']),
        'create_event' => route('create_event'),
        'publish_event' => route('publish_event'),
    ];
@endphp
<script>
    window.appRoutes = Object.assign(window.appRoutes || {}, {{ Illuminate\Support\Js::from($jsRoutes) }});
</script>

@php
    $fmt = fn ($v) => \App\Http\Controllers\CreditSummaryReportController::formatCredits($v);
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 20px 15px; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 9px; margin: 0; padding: 0; }
        .logo { width: 100%; margin-bottom: 8px; }
        h2 { text-align: center; margin: 6px 0 10px 0; font-size: 14px; }
        .meta { width: 100%; margin-bottom: 10px; border-collapse: collapse; }
        .meta td { border: none; padding: 2px 4px; font-size: 10px; }
        table.report { width: 100%; border-collapse: collapse; table-layout: fixed; }
        table.report th, table.report td {
            border: 1px solid #000; padding: 4px; vertical-align: top;
            word-wrap: break-word; overflow-wrap: break-word;
        }
        table.report th { background: #f0f0f0; text-align: center; font-size: 9px; }
        table.report td { font-size: 8px; }
        .text-center { text-align: center; }
        .earned { color: #15803d; font-weight: bold; }
        .remaining { color: #b91c1c; font-weight: bold; }
        .muted { color: #6b7280; }
        .col-sl { width: 4%; } .col-reg { width: 11%; } .col-name { width: 15%; }
        .col-sec { width: 5%; } .col-events { width: 37%; } .col-num { width: 7%; }
        .col-status { width: 7%; }
    </style>
</head>
<body>
    <img src="{{ public_path('images/rtc_logo.png') }}" class="logo">

    <h2>Credit Report</h2>

    <table class="meta">
        <tr>
            <td><b>Programme:</b> {{ $progm->name ?? '' }}</td>
            <td><b>Semester:</b> {{ $semester }}</td>
            <td><b>Section:</b> {{ $section ? strtoupper($section) : 'All' }}</td>
            <td><b>Required Credits:</b> {{ $fmt($required) }}</td>
        </tr>
        <tr>
            <td><b>Total Students:</b> {{ $summary['students'] }}</td>
            <td><b>Completed:</b> {{ $summary['completed'] }}</td>
            <td><b>Pending:</b> {{ $summary['pending'] }}</td>
            <td><b>Generated:</b> {{ now()->format('d-m-Y h:i A') }}</td>
        </tr>
    </table>

    <table class="report">
        <thead>
            <tr>
                <th class="col-sl">#</th>
                <th class="col-reg">Register Number</th>
                <th class="col-name">Student Name</th>
                <th class="col-sec">Section</th>
                <th class="col-events">Attended Events</th>
                <th class="col-num">Required</th>
                <th class="col-num">Earned</th>
                <th class="col-num">Remaining</th>
                <th class="col-status">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rows->values() as $i => $row)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ $row['student']->register_number }}</td>
                    <td>{{ $row['student']->name }}</td>
                    <td class="text-center">{{ strtoupper((string) $row['student']->section) }}</td>
                    <td>
                        @forelse ($row['events'] as $event)
                            <div>
                                {{ $event['title'] }} - {{ $fmt($event['credits']) }} cr
                                @if ($event['note'])<span class="muted">({{ $event['note'] }})</span>@endif
                            </div>
                        @empty
                            <span class="muted">No Events</span>
                        @endforelse
                    </td>
                    <td class="text-center">{{ $fmt($required) }}</td>
                    <td class="text-center earned">{{ $fmt($row['earned']) }}</td>
                    <td class="text-center remaining">{{ $fmt($row['remaining']) }}</td>
                    <td class="text-center">{{ $row['completed'] ? 'Completed' : 'Pending' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No students found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>

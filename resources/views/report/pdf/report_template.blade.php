<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Event Report #{{ $report->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12.5px; color: #1A1A1A; margin: 30px; }
        .header { text-align: center; margin-top: 0x; }
        .header img { width: 430px; margin-top: 0px; }
        .report-title { font-size: 18px; font-weight: 700; text-transform: uppercase; margin-top: 5px; color:#7A1C73; letter-spacing: 0.5px; }
        .report-meta { font-size: 12px; color: #444; margin-top: 2px; }

        .section-title { font-size: 14px; font-weight: 700; background: #F1E5F7; padding: 6px 8px; border-left: 4px solid #7A1C73; margin: 18px 0 8px; }

        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #bbb; padding: 8px 9px; font-size: 12.5px; }
        th { background: #fafafa; width: 34%; }

        .file-badge { background: #EEF5FF; border: 1px solid #CDE0FF; padding: 4px 6px; border-radius: 4px; font-size: 11.5px; display:inline-block; }

        .image-grid { margin-top: 8px; }
        .image-block { display:inline-block; margin: 5px 10px 10px 0; text-align:center; }
        .image-block img { max-width: 240px; max-height: 160px; border:1px solid #bbb; padding:4px; }

        .footer { margin-top: 24px; text-align: right; font-size: 11.5px; color: black; }
        hr { border: none; border-top: 1px solid #CCC; margin: 20px 0; }
    </style>
</head>

<body>

    <!-- INSTITUTION HEADER -->
    <div class="header">
        <img src="{{ public_path('/images/rtc_logo.png') }}" alt="College Logo">
        <div class="report-title">EVENT REPORT</div>
        <div class="report-meta">Report ID: {{ $report->id }}</div>
    </div>

    <!-- BASIC DETAILS -->
    <div class="section-title">Event Details</div>
    <table>
        <tr>
            <th>Event Name</th>
            <td>{{ $report->get_event->get_task->title ?? $report->get_event->title ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Event Date & Time</th>
            <td>
                {{ optional($report->get_event->event_date) ? \Carbon\Carbon::parse($report->get_event->event_date)->format('F d, Y') : 'N/A' }}
                @if($report->get_event->start_time)
                    ({{ \Carbon\Carbon::parse($report->get_event->start_time)->format('h:i A') }})
                @endif
            </td>
        </tr>
        <tr>
            <th>Report Submitted By</th>
            <td>{{ $report->creator->name ?? 'N/A' }} — <em>{{ \Carbon\Carbon::parse($report->created_at)->format('F d, Y (h:i A)') }}</em></td>
        </tr>
    </table>

    <!-- PARTICIPANTS -->
    <div class="section-title">Participants</div>
    <table>
        <tr>
            <th>Total Attendance</th>
            <td>Male: {{ $report->male_count ?? 0 }} &nbsp; | &nbsp; Female: {{ $report->female_count ?? 0 }}</td>
        </tr>
    </table>
    <!-- OUTCOMES -->
    <div class="section-title">Event Outcomes</div>
    <table>
        <tr>
            <td>{!! nl2br(e($report->outcomes ?? $report->outcomes_results ?? 'N/A')) !!}</td>
        </tr>
    </table>
    <!-- FEEDBACK -->
    <div class="section-title">Feedback Summary</div>
    <table>
        <tr>
            <td>{!! nl2br(e($report->feedback_summary ?? 'N/A')) !!}</td>
        </tr>
    </table>
    <!-- CERTIFICATES -->
    <div class="section-title">Certificate / Documentation</div>
    <table>
        <tr>
            <td>
                @php $cert = $report->certificates; @endphp
                @if($cert)
                    @if(preg_match('/\.(jpg|jpeg|png)$/i', $cert))
                        <img src="{{ public_path('storage/' . $cert) }}" style="max-width:270px; max-height:170px; border:1px solid #bbb; padding:4px;">
                    @else
                        <span class="file-badge">{{ basename($cert) }}</span>
                    @endif
                @else
                    N/A
                @endif
            </td>
        </tr>
    </table>
    <!-- SUPPORTING IMAGES -->
    @if($report->get_event_image && $report->get_event_image->count())
        <div class="section-title">Supporting Files / Photographs</div>
        <div class="image-grid">
            @foreach($report->get_event_image as $img)
                <div class="image-block">
                    <img src="{{ public_path('storage/' . ltrim($img->file_path, '/')) }}" alt="{{ $img->file_name }}">
                    <div style="font-size: 11px; margin-top: 3px;">{{ $img->file_name }}</div>
                </div>
            @endforeach
        </div>
    @endif
    <hr>
    <!-- FOOTER -->
    <div class="footer">
        Generated on {{ \Carbon\Carbon::now()->format('F d, Y (h:i A)') }}
    </div>
</body>
</html>

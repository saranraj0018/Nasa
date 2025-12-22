<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Event Report</title>

    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #1A1A1A;
        }

        /* HEADER */
        .header-line {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #7A1C73;
            padding: 10px 0;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-left img {
            width: 75px;
        }

        .event-title {
            font-size: 20px;
            font-weight: bold;
            color: #7A1C73;
        }

        .event-meta {
            font-size: 13px;
            text-align: right;
        }

        /* COUNT BOXES */
        .count-boxes {
            display: flex;
            gap: 15px;
            margin: 18px 0;
        }

        .count-box {
            flex: 1;
            border: 1px solid #bbb;
            padding: 15px;
            text-align: center;
            border-radius: 6px;
            background: #F9F3FB;
        }

        .count-box h3 {
            margin: 0;
            font-size: 24px;
            color: #7A1C73;
        }

        .count-box span {
            font-size: 13px;
            color: #555;
        }

        /* SECTIONS */
        .section-title {
            margin-top: 22px;
            font-weight: bold;
            font-size: 14px;
            background: #F1E5F7;
            padding: 6px;
            border-left: 4px solid #7A1C73;
        }

        /* GRID */
        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-top: 12px;
        }

        .image-box img {
            max-width: 100%;
            height: 170px;
            border: 1px solid #bbb;
            padding: 4px;
        }

        /* FEEDBACK */
        .star {
            color: #FFD700;
            font-size: 16px;
        }

        .feedback-item {
            margin-bottom: 12px;
            border-bottom: 1px dashed #ccc;
            padding-bottom: 8px;
        }

        /* FOOTER */
        .footer {
            margin-top: 30px;
            font-size: 11px;
            text-align: right;
            color: #333;
        }
    </style>
</head>

<body>

<!-- HEADER -->
<div class="header-line">
    <div class="header-left">
        <img src="{{ public_path('/images/rtc_logo.png') }}" alt="Logo">
        <div class="event-title">
            {{ $report->get_event->title ?? 'Event Title' }}
        </div>
    </div>

    <div class="event-meta">
        {{ optional($report->get_event->event_date)->format('d M Y') ?? '' }}
        <br>
        Session: {{ $report->get_event->session ?? 'N/A' }}
    </div>
</div>

<!-- COUNT BOXES -->
<div class="count-boxes">
    <div class="count-box">
        <h3>{{ $report->registered_count ?? 0 }}</h3>
        <span>Registered Students</span>
    </div>

    <div class="count-box">
        <h3>{{ $report->attended_count ?? 0 }}</h3>
        <span>Attended Students</span>
    </div>
</div>

<!-- EVENT IMAGE -->
@if($report->event_image)
<div class="section-title">Event Image</div>
<div class="image-box">
    <img src="{{ public_path('storage/'.$report->event_image) }}">
</div>
@endif

<!-- GENDER CHART -->
<div class="section-title">Gender Participation</div>
<canvas id="genderChart" height="90"></canvas>

<script>
new Chart(document.getElementById('genderChart'), {
    type: 'bar',
    data: {
        labels: ['Male', 'Female'],
        datasets: [{
            data: [
                {{ $report->male_count ?? 0 }},
                {{ $report->female_count ?? 0 }}
            ],
            backgroundColor: ['#7A1C73', '#C36BCB']
        }]
    },
    options: {
        plugins: { legend: { display: false } }
    }
});
</script>

<!-- GEO TAG PHOTOS -->
@if(isset($report->geo_images) && $report->geo_images->count())
<div class="section-title">Geo Tagged Photos</div>

<div class="grid">
@foreach($report->geo_images->take(2) as $img)
    <div class="image-box">
        <img src="{{ public_path('storage/'.$img->file_path) }}">
        <div style="font-size:11px">
            {{ $img->latitude }}, {{ $img->longitude }}
        </div>
    </div>
@endforeach
</div>
@endif

<!-- STUDENT FEEDBACK -->
@if(isset($report->feedbacks) && $report->feedbacks->count())
<div class="section-title">Student Feedback</div>

@foreach($report->feedbacks as $feedback)
    <div class="feedback-item">
        <strong>{{ $feedback->student->name ?? 'Student' }}</strong><br>

        @for($i = 1; $i <= 5; $i++)
            <span class="star">
                {{ $i <= $feedback->rating ? '★' : '☆' }}
            </span>
        @endfor

        <div style="font-size:12px">{{ $feedback->comments }}</div>
    </div>
@endforeach
@endif

<!-- STUDENT UPLOAD PROOF -->
@if(isset($report->student_uploads) && $report->student_uploads->count())
<div class="section-title">Student Upload Proof</div>

<div class="grid">
@foreach($report->student_uploads as $file)
    <div class="image-box">
        <img src="{{ public_path('storage/'.$file->file_path) }}">
        <div style="font-size:11px">{{ $file->student->name ?? '' }}</div>
    </div>
@endforeach
</div>
@endif

<!-- FOOTER -->
<div class="footer">
    Generated on {{ now()->format('d M Y h:i A') }}
</div>

</body>
</html>

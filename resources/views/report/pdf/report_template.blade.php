<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Event Report</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #1A1A1A;
            /* margin: 0; */
        }

        .container { padding: 20px; }

        /* HEADER */
        .header {
            display: flex;
            justify-content: space-between;
            border-bottom: 3px solid #7A1C73;
            padding-bottom: 10px;
        }
        .header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .header-left img { width: 70px; }
        .event-title {
            font-size: 22px;
            font-weight: bold;
            color: #7A1C73;
        }
        .event-meta {
            text-align: right;
            font-size: 12px;
        }

        /* SUMMARY */
        .summary-boxes {
            display: flex;
            gap: 15px;
            margin: 20px 0;
        }
        .summary-box {
            flex: 1;
            background: #F9F3FB;
            border: 1px solid #ccc;
            border-radius: 6px;
            text-align: center;
            padding: 12px;
        }
        .summary-box h2 {
            margin: 0;
            font-size: 22px;
            color: #7A1C73;
        }

        /* SECTION */
        .section-title {
            margin-top: 25px;
            padding: 6px;
            font-weight: bold;
            background: #F1E5F7;
            border-left: 5px solid #7A1C73;
        }

        /* CHARTS */
        .chart-wrapper {
            display: flex;
            gap: 40px;
            margin-top: 15px;
        }

        .bar-chart { width: 55%; }

        .bar-item { margin-bottom: 12px; }

        .bar-label {
            font-size: 12px;
            margin-bottom: 4px;
        }

        .bar-bg {
            width: 100%;
            background: #eee;
            height: 16px;
            border-radius: 6px;
        }

        .bar-fill {
            height: 100%;
            border-radius: 6px;
        }

        /* PIE */
        .pie-chart {
            width: 170px;
            height: 170px;
            border-radius: 50%;
            position: relative;
        }
        .pie-center {
            position: absolute;
            width: 80px;
            height: 80px;
            background: #fff;
            border-radius: 50%;
            top: 45px;
            left: 45px;
        }

        .legend {
            margin-top: 8px;
            font-size: 12px;
        }
        .legend span { margin-right: 10px; }
        .legend-box {
            width: 10px;
            height: 10px;
            display: inline-block;
            margin-right: 4px;
        }

        /* FEEDBACK */
        .feedback-item {
            border-bottom: 1px solid #ddd;
            margin-bottom: 10px;
            padding-bottom: 6px;
        }
        .stars { color: #F1C40F; }

        /* IMAGES */
        .image-grid {
            display: grid;
            grid-template-columns: repeat(3,1fr);
            gap: 10px;
            margin-top: 10px;
        }
        .image-grid img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border: 1px solid #bbb;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 11px;
        }
    </style>
</head>
<body>

@php
function stars($rating) {
    $full = floor($rating);
    return str_repeat('★',$full).str_repeat('☆',5-$full);
}

$total = max(1,$data['report']->registered_count);
$male = $data['report']->male_count ?? 0;
$female = $data['report']->female_count ?? 0;
$malePct = round(($male/$total)*100);
$femalePct = round(($female/$total)*100);
$avg = $data['report']->avgRatings ?? [];
@endphp

<div class="container">

<!-- HEADER -->
<img style="width:100%;" src="{{ public_path('images/rtc_logo.png') }}">
<div class="header">
    <div class="header-left">
        <div class="event-title">
            {{ $data['report']->get_event->title ?? 'Event Title' }}
        </div>
    </div>

    <div class="event-meta">
        {{ optional($data['report']->get_event->event_date)->format('d M Y') }}<br>
        Session: {{ $data['report']->get_event->session ?? 'N/A' }}
    </div>
</div>

<!-- SUMMARY -->
<div class="summary-boxes">
    <div class="summary-box">
        <h2>{{ $data['report']->registered_count }}</h2>
        Registered
    </div>
    <div class="summary-box">
        <h2>{{ $data['report']->attended_count }}</h2>
        Attended
    </div>
</div>

<!-- GENDER CHART -->
<div class="section-title">Gender Participation</div>

<div class="chart-wrapper">
    <div class="bar-chart">
        <div class="bar-item">
            <div class="bar-label">Male ({{ $male }})</div>
            <div class="bar-bg">
                <div class="bar-fill" style="width:{{ $malePct }}%;background:#7A1C73;"></div>
            </div>
        </div>

        <div class="bar-item">
            <div class="bar-label">Female ({{ $female }})</div>
            <div class="bar-bg">
                <div class="bar-fill" style="width:{{ $femalePct }}%;background:#C36BCB;"></div>
            </div>
        </div>
    </div>

    <div>
        <div class="pie-chart" style="background:
            conic-gradient(#7A1C73 0 {{ $malePct }}%, #C36BCB {{ $malePct }}% 100%);">
            <div class="pie-center"></div>
        </div>

        <div class="legend">
            <span><span class="legend-box" style="background:#7A1C73"></span>Male</span>
            <span><span class="legend-box" style="background:#C36BCB"></span>Female</span>
        </div>
    </div>
</div>

<!-- FEEDBACK CHART -->
<div class="section-title">Average Feedback</div>

<div class="bar-chart">
@foreach([
 'overall_experience'=>'Overall Experience',
 'engagement'=>'Engagement',
 'organization'=>'Organization',
 'coordination'=>'Coordination',
 'recommendation'=>'Recommendation'
] as $k=>$label)

@php $val = round(($avg[$k] ?? 0) * 20); @endphp

<div class="bar-item">
    <div class="bar-label">{{ $label }} ({{ number_format($avg[$k] ?? 0,1) }}/5)</div>
    <div class="bar-bg">
        <div class="bar-fill" style="width:{{ $val }}%;background:#7A1C73;"></div>
    </div>
</div>

@endforeach
</div>

<!-- STUDENT FEEDBACK -->
<div class="section-title">Student Feedback</div>
@foreach($data['report']->feedbacks as $f)
<div class="feedback-item">
    <strong>{{ $f->student->name ?? 'Student' }}</strong>
    @php $r = json_decode($f->ratings,true); @endphp
    <div class="stars">
        Overall: {{ stars($r['overall_experience'] ?? 0) }}
    </div>
    <div>{{ $f->comments }}</div>
</div>
@endforeach

<!-- GEO IMAGES -->
@if($data['report']->geo_images->count())
<div class="section-title">Geo Tagged Photos</div>
<div class="image-grid">
@foreach($data['report']->geo_images as $img)
    <img src="{{ public_path('storage/'.$img->file_path) }}">
@endforeach
</div>
@endif

<!-- STUDENT UPLOADS -->
@if($data['report']->student_uploads->count())
<div class="section-title">Student Uploads</div>
<div class="image-grid">
@foreach($data['report']->student_uploads as $img)
    <img style="width:50%; height:10%;" src="{{ public_path('storage/'.$img->file_path) }}">
@endforeach
</div>
@endif

<div class="footer">
    Generated on {{ now()->format('d M Y h:i A') }}
</div>

</div>
</body>
</html>

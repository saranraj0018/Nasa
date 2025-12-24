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
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 20px;
        }

        /* HEADER */
        .header {
            border-bottom: 3px solid #7A1C73;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .event-title {
            font-size: 22px;
            font-weight: bold;
            color: #7A1C73;
        }

        .event-meta {
            font-size: 12px;
            text-align: right;
        }

        table.header-table {
            width: 100%;
            border-collapse: collapse;
        }

        /* SUMMARY */
        .summary-table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        .summary-box {
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
            margin-bottom: 10px;
            padding: 6px;
            font-weight: bold;
            background: #F1E5F7;
            border-left: 5px solid #7A1C73;
        }

        /* GENDER CHART */
     .gender-wrapper {
    width: 100%;
    max-width: 480px;
    margin: 0 auto;
}

/* BAR */
.bar-item {
    margin-bottom: 12px;
}

.bar-label {
    font-size: 12px;
    margin-bottom: 4px;
}

.bar-bg {
    width: 100%;
    background: #e0e0e0;
    height: 12px;
    border-radius: 6px;
}

.bar-fill {
    height: 12px;
    border-radius: 6px;
}

/* PIE */
.pie-chart {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    margin: 15px auto 0;
    position: relative;
}

.pie-center {
    position: absolute;
    width: 45px;
    height: 45px;
    background: #fff;
    border-radius: 50%;
    top: 32px;
    left: 32px;
}

/* LEGEND */
.legend {
    margin-top: 8px;
    font-size: 12px;
    text-align: center;
}

.legend-box {
    width: 10px;
    height: 10px;
    display: inline-block;
    margin-right: 4px;
}

        /* FEEDBACK BARS */
        .feedback-bars {
            width: 100%;
        }

        /* STUDENT FEEDBACK */
        .feedback-item {
            border-bottom: 1px solid #ddd;
            margin-bottom: 10px;
            padding-bottom: 6px;
        }

        .stars {
            color: #F1C40F;
        }

        /* IMAGES */
        .image-grid {
            width: 100%;
            margin-top: 10px;
        }

        .image-grid img {
            width: 32%;
            height: 140px;
            object-fit: cover;
            border: 1px solid #bbb;
            margin-right: 1%;
            margin-bottom: 10px;
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

$total = max(1, $data['report']->registered_count);
$male = $data['report']->male_count ?? 0;
$female = $data['report']->female_count ?? 0;

$malePct = round(($male / $total) * 100);
$femalePct = round(($female / $total) * 100);

$avg = $data['report']->avgRatings ?? [];
@endphp

<div class="container">

    <!-- LOGO -->
    <img src="{{ public_path('images/rtc_logo.png') }}" style="width:100%; margin-bottom:10px;">

    <!-- HEADER -->
    <div class="header">
        <table class="header-table">
            <tr>
                <td>
                    <div class="event-title">
                        {{ $data['report']->get_event->title ?? 'Event Title' }}
                    </div>
                </td>
                <td class="event-meta">
                   <b> Date: {{ $data['report']->get_event->event_date }}  &
                    Session:
                    @if ($data['report']->get_event->session == 1)
                        FN
                    @elseif ($data['report']->get_event->session == 2)
                        AN
                    @endif
                   </b>
                </td>
            </tr>
        </table>
    </div>

    <!-- SUMMARY -->
    <table class="summary-table">
        <tr>
            <td class="summary-box">
                <h2>{{ $data['report']->registered_count }}</h2>
                Registered
            </td>
            <td width="20"></td>
            <td class="summary-box">
                <h2>{{ $data['report']->attended_count }}</h2>
                Attended
            </td>
        </tr>
    </table>

    <!-- GENDER -->
<div class="section-title">Gender Participation</div>

@php
$total = max(1, $male + $female);
$maleAngle = ($male / $total) * 360;
$femaleAngle = 360 - $maleAngle;
@endphp

<!-- SVG CHART (NO CSS LAYOUT) -->
<svg width="420" height="200" viewBox="0 0 420 200">

    <!-- PIE -->
    <g transform="translate(100,100)">
        <!-- Male -->
        <path d="
            M 0 0
            L 0 -70
            A 70 70 0 {{ $maleAngle > 180 ? 1 : 0 }} 1
              {{ 70 * sin(deg2rad($maleAngle)) }}
              {{ -70 * cos(deg2rad($maleAngle)) }}
            Z"
            fill="#7A1C73"/>

        <!-- Female -->
        <path d="
            M 0 0
            L {{ 70 * sin(deg2rad($maleAngle)) }}
              {{ -70 * cos(deg2rad($maleAngle)) }}
            A 70 70 0 {{ $femaleAngle > 180 ? 1 : 0 }} 1
              0 -70
            Z"
            fill="#C36BCB"/>

        <!-- Center hole -->
        <circle cx="0" cy="0" r="35" fill="#ffffff"/>
    </g>

    <!-- LABELS -->
    <text x="220" y="70" font-size="12" fill="#000">
        ■ Male: {{ $male }}
    </text>
    <rect x="200" y="60" width="10" height="10" fill="#7A1C73"/>

    <text x="220" y="95" font-size="12" fill="#000">
        ■ Female: {{ $female }}
    </text>
    <rect x="200" y="85" width="10" height="10" fill="#C36BCB"/>

    <!-- BARS -->
    <text x="20" y="180" font-size="11">Male</text>
    <rect x="60" y="170" width="{{ ($male/$total)*300 }}" height="10" fill="#7A1C73"/>

    <text x="20" y="195" font-size="11">Female</text>
    <rect x="60" y="185" width="{{ ($female/$total)*300 }}" height="10" fill="#C36BCB"/>

</svg>




    <!-- AVERAGE FEEDBACK -->
    <div class="section-title">Average Feedback</div>

    @foreach([
        'overall_experience'=>'Overall Experience',
        'engagement'=>'Engagement',
        'organization'=>'Organization',
        'coordination'=>'Coordination',
        'recommendation'=>'Recommendation'
    ] as $k=>$label)

        @php $val = round(($avg[$k] ?? 0) * 20); @endphp

        <div class="bar-item">
            <div class="bar-label">
                {{ $label }} ({{ number_format($avg[$k] ?? 0,1) }}/5)
            </div>
            <div class="bar-bg">
                <div class="bar-fill" style="width:{{ $val }}%; background:#7A1C73;"></div>
            </div>
        </div>

    @endforeach

    <!-- STUDENT FEEDBACK -->
    <div class="section-title">Student Feedback</div>

    @foreach($data['report']->feedbacks as $f)
        @php $r = json_decode($f->ratings,true); @endphp
        <div class="feedback-item">
            <strong>{{ $f->student->name ?? 'Student' }}</strong>
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
    {{-- @if($data['report']->student_uploads->count())
        <div class="section-title">Student Uploads</div>
        <div class="image-grid">
            @foreach($data['report']->student_uploads as $img)
                <img src="{{ public_path('storage/'.$img->file_path) }}">
            @endforeach
        </div>
    @endif --}}

    <div class="footer">
        Generated on {{ now()->format('d M Y h:i A') }}
    </div>

</div>
</body>
</html>


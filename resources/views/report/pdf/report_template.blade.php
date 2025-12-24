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
       .gender-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

.gender-left {
    width: 360px;      /* FIXED – SAFE */
    vertical-align: top;
}

.gender-right {
    width: 180px;      /* FIXED – SAFE */
    vertical-align: top;
    text-align: center;
}

/* BAR */
.bar-item {
    margin-bottom: 14px;
}

.bar-label {
    font-size: 12px;
    margin-bottom: 4px;
}

.bar-bg {
    width: 100%;
    background: #e0e0e0;
    height: 14px;
    border-radius: 6px;
}

.bar-fill {
    height: 14px;
    border-radius: 6px;
}

/* PIE */
.pie-chart {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    margin: 0 auto;
    position: relative;
}

.pie-center {
    position: absolute;
    width: 50px;
    height: 50px;
    background: #ffffff;
    border-radius: 50%;
    top: 35px;
    left: 35px;
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
                    {{ optional($data['report']->get_event->event_date)->format('d M Y') }}<br>
                    Session: {{ $data['report']->get_event->session ?? 'N/A' }}
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

<table class="gender-table">
    <tr>
        <!-- BAR -->
        <td class="gender-left">
            <div class="bar-item">
                <div class="bar-label">Male ({{ $male }})</div>
                <div class="bar-bg">
                    <div class="bar-fill"
                         style="width:{{ $malePct }}%; background:#7A1C73;">
                    </div>
                </div>
            </div>

            <div class="bar-item">
                <div class="bar-label">Female ({{ $female }})</div>
                <div class="bar-bg">
                    <div class="bar-fill"
                         style="width:{{ $femalePct }}%; background:#C36BCB;">
                    </div>
                </div>
            </div>
        </td>

        <!-- PIE -->
        <td class="gender-right">
            <div class="pie-chart"
                 style="background: conic-gradient(
                     #7A1C73 0 {{ $malePct }}%,
                     #C36BCB {{ $malePct }}% 100%
                 );">
                <div class="pie-center"></div>
            </div>

            <div class="legend">
                <span>
                    <span class="legend-box" style="background:#7A1C73"></span>
                    Male
                </span>
                &nbsp;&nbsp;
                <span>
                    <span class="legend-box" style="background:#C36BCB"></span>
                    Female
                </span>
            </div>
        </td>
    </tr>
</table>


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

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Event Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #1A1A1A; margin: 0; padding: 0; }
        .container { padding: 20px; }
        .header { display: flex; justify-content: space-between; border-bottom: 3px solid #7A1C73; padding-bottom: 10px; }
        .header-left { display: flex; align-items: center; gap: 15px; }
        .header-left img { width: 80px; }
        .event-title { font-size: 24px; font-weight: bold; color: #7A1C73; }
        .event-meta { text-align: right; font-size: 13px; }
        .summary-boxes { display: flex; gap: 15px; margin: 20px 0; }
        .summary-box { flex:1; background:#F9F3FB; border-radius:6px; padding:15px; text-align:center; border:1px solid #bbb; }
        .summary-box h2 { margin:0; font-size:22px; color:#7A1C73; }
        .summary-box span { font-size:13px; color:#555; }
        .section-title { font-size:16px; font-weight:bold; background:#F1E5F7; border-left:5px solid #7A1C73; padding:6px; margin-top:20px; }
        .gender-chart div { margin-bottom:10px; }
        .gender-bar { display:inline-block; height:16px; border-radius:4px; }
        .feedback-item { margin-bottom:12px; border-bottom:1px solid #ddd; padding-bottom:8px; }
        .feedback-item p { margin:2px 0; }
        .stars { color:#F1C40F; font-size:14px; }
        .image-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:10px; margin-top:10px; }
        .image-grid img { width:100%; height:160px; object-fit:cover; border:1px solid #bbb; border-radius:4px; }
        .footer { text-align:right; font-size:11px; margin-top:30px; color:#333; }
    </style>
</head>
<body>
<div class="container">

@php
// Star rendering function
function renderStars($rating, $max = 5) {
    $full = floor($rating);
    $half = ($rating - $full) >= 0.5 ? 1 : 0;
    $empty = $max - $full - $half;
    $stars = str_repeat('★', $full);
    $stars .= $half ? '⯪' : ''; // Half star
    $stars .= str_repeat('☆', $empty);
    return $stars;
}
@endphp

<!-- HEADER -->
<div class="header">
    <div class="header-left">
        <img src="{{ public_path('/images/rtc_logo.png') }}" alt="Logo">
        <div class="event-title">{{ $data['report']->get_event->title ?? 'Event Title' }}</div>
    </div>
    <div class="event-meta">
        {{ optional($data['report']->get_event->event_date)->format('d M Y') ?? '' }}<br>
        Session: {{ $data['report']->get_event->session ?? 'N/A' }}
    </div>
</div>

<!-- SUMMARY BOXES -->
<div class="summary-boxes">
    <div class="summary-box">
        <h2>{{ $data['report']->registered_count ?? 0 }}</h2>
        <span>Registered Students</span>
    </div>
    <div class="summary-box">
        <h2>{{ $data['report']->attended_count ?? 0 }}</h2>
        <span>Attended Students</span>
    </div>
    <div class="summary-box">
        <h2>{{ $data['report']->male_count ?? 0 }}</h2>
        <span>Male Students</span>
    </div>
    <div class="summary-box">
        <h2>{{ $data['report']->female_count ?? 0 }}</h2>
        <span>Female Students</span>
    </div>
</div>

<!-- EVENT IMAGE -->
@if($data['report']->event_image)
<div class="section-title">Event Image</div>
<div class="image-grid">
    <img src="{{ public_path('storage/'.$data['report']->event_image) }}">
</div>
@endif

<!-- GENDER CHART (Bar inside PDF using CSS) -->
@if(isset($data['report']->male_count) && isset($data['report']->female_count))
<div class="section-title">Gender Participation</div>
<div class="gender-chart">
    <div>Male:
        <div class="gender-bar" style="width:{{ ($data['report']->male_count / max(1,$data['report']->registered_count)) * 200 }}px; background:#7A1C73;"></div>
        <span>{{ $data['report']->male_count }}</span>
    </div>
    <div>Female:
        <div class="gender-bar" style="width:{{ ($data['report']->female_count / max(1,$data['report']->registered_count)) * 200 }}px; background:#C36BCB;"></div>
        <span>{{ $data['report']->female_count }}</span>
    </div>
</div>
@endif

<!-- STUDENT FEEDBACK -->
<div class="section-title">Student Feedback</div>
@foreach($data['report']->feedbacks as $feedback)
    <div class="feedback-item">
        <strong>{{ $feedback->student->name ?? 'Student' }}</strong>
        @php $ratings = json_decode($feedback->ratings,true); @endphp
        <p>Overall Experience: <span class="stars">{!! renderStars($ratings['overall_experience'] ?? 0) !!}</span></p>
        <p>Engagement: <span class="stars">{!! renderStars($ratings['engagement'] ?? 0) !!}</span></p>
        <p>Organization: <span class="stars">{!! renderStars($ratings['organization'] ?? 0) !!}</span></p>
        <p>Coordination: <span class="stars">{!! renderStars($ratings['coordination'] ?? 0) !!}</span></p>
        <p>Recommendation: <span class="stars">{!! renderStars($ratings['recommendation'] ?? 0) !!}</span></p>
        <p>Comments: {{ $feedback->comments ?? '-' }}</p>
    </div>
@endforeach

<!-- AVERAGE RATINGS -->
<div class="section-title">Average Ratings</div>
<div class="feedback-item">
    <p>Overall Experience: <span class="stars">{!! renderStars($data['report']->avgRatings['overall_experience'] ?? 0) !!}</span></p>
    <p>Engagement: <span class="stars">{!! renderStars($data['report']->avgRatings['engagement'] ?? 0) !!}</span></p>
    <p>Organization: <span class="stars">{!! renderStars($data['report']->avgRatings['organization'] ?? 0) !!}</span></p>
    <p>Coordination: <span class="stars">{!! renderStars($data['report']->avgRatings['coordination'] ?? 0) !!}</span></p>
    <p>Recommendation: <span class="stars">{!! renderStars($data['report']->avgRatings['recommendation'] ?? 0) !!}</span></p>
</div>

<!-- GEO-TAGGED PHOTOS -->
@if($data['report']->geo_images && $data['report']->geo_images->count())
<div class="section-title">Geo-tagged Photos</div>
<div class="image-grid">
    @foreach($data['report']->geo_images as $img)
        <img src="{{ public_path('storage/'.$img->file_path) }}">
    @endforeach
</div>
@endif

<!-- STUDENT UPLOADS -->
@if($data['report']->student_uploads && $data['report']->student_uploads->count())
<div class="section-title">Student Uploads</div>
<div class="image-grid">
    @foreach($data['report']->student_uploads as $file)
        <img src="{{ public_path('storage/'.$file->file_path) }}">
    @endforeach
</div>
@endif

<!-- FOOTER -->
<div class="footer">
    Generated on {{ now()->format('d M Y h:i A') }}
</div>

</div>
</body>
</html>

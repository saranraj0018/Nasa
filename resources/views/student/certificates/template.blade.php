<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Certificate of Participation</title>
<style>
 @page { margin: 0; }

body {
  margin: 0;
  padding: 0;
  font-family: "Times New Roman", serif;
  background: #ffffff;
}

.certificate {
  width: 92.5%;
  height: 94.5%;
  padding: 20px 20px;
  box-sizing: border-box;
  border: 10px solid #9F3895;
  position: relative;
}

.college-header {
  text-align: center;
  margin-bottom: 10px;
}

.college-header img {
  width: 500px;
}

.certificate-title {
  text-align: center;
  margin-top: 30px;
}

.certificate-title h1 {
  font-size: 35px;
  text-transform: uppercase;
  color: #9F3895;
  margin: 0;
}

.certificate-title h3 {
  font-size: 20px;
  letter-spacing: 3px;
  text-transform: uppercase;
  color: #9F3895;
  margin: 5px 0 0 0;
}

.content {
  text-align: center;
  margin-top: 30px;
  font-size: 21px;
  line-height: 1.6;
}

.recipient {
  font-size: 32px;
  font-weight: bold;
  border-bottom: 2px solid #000;
  display: inline-block;
  padding: 3px 50px;
  margin-top: 12px;
}

.event-name {
  font-size: 24px;
  font-weight: bold;
  margin-top: 18px;
  text-transform: uppercase;
  color: #f57c00;
}

/* Badge */
.badge {
  position: absolute;
  top: 300px; /* Adjust for your layout */
  right: 50px;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  border: 6px solid #f57c00;
  background: #ffffff;
  display: flex;
  justify-content: center;
  align-items: center;
}

.badge img {
  width: 85px;
  height: 85px;
  border-radius: 60%;
}

/* Footer Signatures */
.footer {
  width: 100%;
  position: absolute;
  bottom: 45px;
  left: 0;
  display: table;
  padding: 0 60px;
}

.signature {
  display: table-cell;
  text-align: center;
  width: 33.33%;
}

.signature-line {
  margin: 0 auto 6px;
  width: 200px;
  border-top: 2px solid #000;
}

.signature-title {
  font-weight: bold;
  font-size: 18px;
  color: #9F3895;
}
</style>
</head>

<body>
<div class="certificate">

  <div class="college-header">
    <img src="{{ public_path('images/rtc_logo.png') }}" alt="College Logo">
  </div>

  <div class="certificate-title">
    <h1>Certificate of Participation</h1>
    <h3>Presented with Appreciation</h3>
  </div>

  <div class="badge">
    <img src="{{ public_path('images/badge.jpeg') }}" alt="Badge">
  </div>
  <div class="content">
    <p><strong>This is to certify that</strong></p>
    <p><span class="recipient">{{ $student->name ?? ''}}</span></p>
    <p>has successfully participated in</p>
    <p class="event-name">{{ $event->title ?? '' }}</p>
    <p>organized by the Department of {{ $student->get_department->name ?? '' }} on {{ $event->event_date ?? '' }}.</p>
  </div>

  <div class="footer">
    <div class="signature">
      <div class="signature-line"></div>
      <div class="signature-title">Convenor</div>
    </div>
    <div class="signature">
      <div class="signature-line"></div>
      <div class="signature-title">Organizing Secretary</div>
    </div>
    <div class="signature">
      <div class="signature-line"></div>
      <div class="signature-title">Principal</div>
    </div>
  </div>
</div>
</body>
</html>

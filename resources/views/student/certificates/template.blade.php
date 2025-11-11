<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Certificate of Appreciation</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background: #f4f4f4;
      font-family: "Times New Roman", serif;
    }

    .certificate {
      width: 1100px;
      height: 800px;
      background: linear-gradient(135deg, #fff6f3 0%, #fff 40%);
      margin: 40px auto;
      border: 12px solid #9F3895 !important;
      box-shadow: 0 0 30px rgba(0,0,0,0.2);
      position: relative;
      overflow: hidden;
      padding: 50px 60px;
      box-sizing: border-box;
    }

    .college-header {
      text-align: center;
      color: #b71c1c;
      position: relative;
      z-index: 2;
    }

    .college-header img {
      width: 00px;
      height: auto;
    }

    .college-header h2 {
      margin: 10px 0 4px;
      font-size: 26px;
      font-weight: bold;
      text-transform: uppercase;
      color: #333;
    }

    .college-header p {
      margin: 0;
      font-size: 15px;
      color: #555;
    }

    .certificate-title {
      text-align: center;
      margin-top: 40px;
      position: relative;
      z-index: 2;
    }

    .certificate-title h1 {
      font-size: 50px;
      color: #9F3895 !important;
      margin: 0;
      text-transform: uppercase;
      font-weight: bold;
      letter-spacing: 1px;
    }

    .certificate-title h3 {
      font-size: 18px;
      letter-spacing: 4px;
      color: #9F3895 !important;
      margin-top: 8px;
      text-transform: uppercase;
    }

    .badge {
      position: absolute;
      top: 350px;
      right: 100px;
      background: white;
      border: 6px solid #f57c00;
      border-radius: 50%;
      width: 140px;
      height: 140px;
      text-align: center;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }

    .badge img {
      width: 90px;
      height: 90px;
      border-radius: 50%;
    }

    .content {
      text-align: center;
      font-size: 20px;
      color: #333;
      margin-top: 50px;
      line-height: 1.8;
      position: relative;
      z-index: 2;
      padding: 0 60px;
    }

    .content strong {
      color: #9F3895;
      font-size: 22px;
    }

    .recipient {
      display: inline-block;
      border-bottom: 2px solid #000;
      font-size: 28px;
      font-weight: bold;
      margin: 15px 0;
      padding: 6px 60px;
      color: #000;
    }

    .event-name {
      font-size: 22px;
      font-weight: bold;
      color: #f57c00;
      text-transform: uppercase;
      margin-top: 25px;
      letter-spacing: 1px;
    }

    .footer {
      display: flex;
      justify-content: space-around;
      margin-top: 90px;
      position: relative;
      z-index: 2;
    }

    .signature {
      text-align: center;
    }

    .signature-line {
      border-top: 2px solid #000;
      width: 220px;
      margin: 0 auto 8px;
    }

    .signature-title {
      font-weight: bold;
      font-size: 18px;
      color: #9F3895 !important;
    }
  </style>
</head>
<body>
  <div class="certificate">
    <div class="college-header">
      <img src="{{ asset('/images/rtc_logo.png') }}" alt="College Logo" />
    </div>

    <div class="certificate-title">
      <h1>Certificate of Participation</h1>
      <h3>Presented with Appreciation</h3>
    </div>

    <div class="badge">
      <img src="{{ asset('/images/badge.jpeg') }}" alt="Badge" />
    </div>

    <div class="content">
      <p><strong>This is to certify that</strong></p>
      <p><span class="recipient">{{ $student }}</span></p>
      <p>has successfully participated in the</p>
      <p class="event-name">{{ $event }}</p>
      {{-- <p>organized by the Department of {{ $department ?? 'Computer Science and Engineering' }}<br>
        held on {{ $event_date ?? 'October 15, 2025' }}.</p>
      <p>This certificate is awarded in recognition of your active participation and valuable contribution to the success of the event.</p> --}}
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

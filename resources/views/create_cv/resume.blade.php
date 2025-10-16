  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Finished Resume</title>
    <style>
      body { font-family: Georgia, serif; background: #f9f9f9; padding: 40px; }
      .resume { max-width: 800px; margin: auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
      h1, h2 { color: #003366; margin-bottom: 10px; }
      .section { margin-top: 30px; }
      .line { border-top: 1px solid #ccc; margin: 20px 0; }
      .info { font-size: 16px; line-height: 1.6; }
      .label { font-weight: bold; }
      .download-btn {
        display: block;
        margin: 30px auto 0;
        padding: 10px 20px;
        background-color: #0078D4;
        color: white;
        font-size: 16px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background 0.3s;
      }
      .download-btn:hover {
        background-color: #005fa3;
      }
    </style>
  </head>
  <body>

<div class="resume" id="resumeContent">
  <h1>{{ $contract->first_name }} {{ $contract->last_name }}</h1>
  <div class="info">
    {{ $contract->city ?? '' }}, {{ $contract->postal_code ?? '' }}<br>
    Phone: {{ $contract->phone ?? '' }}<br>
    Email: {{ $contract->email ?? '' }}
  </div>

  <div class="line"></div>

  <div class="section">
    <h2>Professional Summary</h2>
    <p>{{ $about->summary ?? '' }}</p>
  </div>

  <div class="line"></div>

  <div class="section">
    <h2>Skills</h2>
    <p><span class="label">{{ $about->skill ?? '' }}</span> — {{ $about->level ?? '' }}</p>
  </div>

  <div class="line"></div>

  <div class="section">
    <h2>Experience</h2>
    @if($experiences)
      <p>
        <span class="label">{{ $experiences->job_title ?? '' }} </span><br>
        {{ $experiences->employer }} — {{ $experiences->city }}<br>
        @if($experiences->start_date && $experiences->end_date)
          {{ \Carbon\Carbon::parse($experiences->start_date)->format('F Y') }}
          to
          {{ \Carbon\Carbon::parse($experiences->end_date)->format('F Y') }}<br>
        @endif
        {{ $experiences->description }}
      </p>
    @else
      <p>No experiences added yet.</p>
    @endif
  </div>

  <div class="line"></div>

  <div class="section">
    <h2>Education</h2>
    @if($educations)
      <p>
        <span class="label">{{ $educations->school ?? '' }}</span> — {{ $educations->city }}<br>
        Degree: {{ $educations->degree }}<br>
        @if($educations->grad_date)
          Graduation: {{ \Carbon\Carbon::parse($educations->grad_date)->format('F Y') }}<br>
        @endif
        {{ $educations->description }}
      </p>
    @else
      <p>No educations added yet.</p>
    @endif
  </div>
</div>

{{-- ✅ Script xuất PDF --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
function downloadPDF() {
    const element = document.getElementById("resumeContent");
    const opt = {
        margin: 10,
        filename: '{{ preg_replace("/[^A-Za-z0-9_-]/", "_", ($about->first_name ?? "user") . "_" . ($about->last_name ?? "resume")) }}.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
    };
    html2pdf().set(opt).from(element).save();
}
</script>


  <!-- Button to download PDF -->
  <button class="download-btn" onclick="downloadPDF()">Download PDF</button>

    <!-- html2pdf.js CDN -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
  <script>
  function downloadPDF() {
    const element = document.getElementById("resumeContent");
    const opt = {
      margin: 10,
      filename: '{{ Str::slug(($about->first_name ?? "user") . "_" . ($about->last_name ?? "resume")) }}.pdf',
      image: { type: 'jpeg', quality: 0.98 },
      html2canvas: { scale: 2 },
      jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
    };
    html2pdf().set(opt).from(element).save();
  }
  </script>



  </body>
  </html>

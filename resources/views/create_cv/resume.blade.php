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
    <h1>{{ $about->first_name }} {{ $about->last_name }} </h1>
    <div class="info">
      <?= htmlspecialchars($city) ?>, <?= htmlspecialchars($postalCode) ?><br>
      Phone: {{ $contract['phone'] ?? '' }}<br>
      Email: <?= htmlspecialchars($email) ?>
    </div>

    <div class="line"></div>

    <div class="section">
      <h2>Professional Summary</h2>
      <p><?= nl2br(htmlspecialchars($summary)) ?></p>
    </div>

    <div class="line"></div>

    <div class="section">
      <h2>Skills</h2>
      <p><span class="label"><?= htmlspecialchars($skill) ?></span> — <?= htmlspecialchars($level) ?></p>
    </div>

    <div class="line"></div>

    <div class="section">
      <h2>Experience</h2>
      <p>
        <span class="label"><?= htmlspecialchars($jobTitle) ?></span><br>
        <?= htmlspecialchars($employer) ?> — <?= htmlspecialchars($jobCity) ?><br>
        <?php if ($startDate && $endDate): ?>
          <?= date("F Y", strtotime($startDate)) ?> to <?= date("F Y", strtotime($endDate)) ?><br>
        <?php endif; ?>
        <?= nl2br(htmlspecialchars($jobDescription)) ?>
      </p>
    </div>

    <div class="line"></div>

    <div class="section">
      <h2>Education</h2>
      <p>
        <span class="label"><?= htmlspecialchars($school) ?></span> — <?= htmlspecialchars($eduCity) ?><br>
        Degree: <?= htmlspecialchars($degree) ?><br>
        <?php if ($gradDate): ?>
          Graduation: <?= date("F Y", strtotime($gradDate)) ?><br>
        <?php endif; ?>
        <?= nl2br(htmlspecialchars($eduDescription)) ?>
      </p>
    </div>
  </div>

  <!-- Button to download PDF -->
  <button class="download-btn" onclick="downloadPDF()">Download PDF</button>

  <!-- html2pdf.js CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
  <script>
  function downloadPDF() {
    const element = document.getElementById("resumeContent");
    const opt = {
      margin: 10,
      filename: '<?= preg_replace("/[^A-Za-z0-9_-]/", "_", $firstName . "_" . $lastName ?: "resume") ?>.pdf',
      image: { type: 'jpeg', quality: 0.98 },
      html2canvas: { scale: 2 },
      jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
    };
    html2pdf().set(opt).from(element).save();
  }
  </script>

  </body>
  </html>

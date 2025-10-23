<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CV Hoàn chỉnh</title>
    <link rel="stylesheet" href="{{ asset('page/css/style.css') }}">
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
        <h2>Experiences</h2>
        @if($experiences)
            <p>
                <span class="label">{{ $experiences->job_title ?? '' }} </span><br>
                {{ $experiences->employer }} — {{ $experiences->city }}<br>
                @if($experiences->start_date && $experiences->end_date)
                    {{ \Carbon\Carbon::parse($experiences->start_date)->format('F Y') }}
                    đến
                    {{ \Carbon\Carbon::parse($experiences->end_date)->format('F Y') }}<br>
                @endif
                {{ $experiences->description }}
            </p>
        @else
            <p>No experience has been added yet.</p>
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
                    Graduation  : {{ \Carbon\Carbon::parse($educations->grad_date)->format('F Y') }}<br>
                @endif
                {{ $educations->description }}
            </p>
        @else
            <p>"No education has been added yet."</p>
        @endif
    </div>
</div>

<!-- Nút tải PDF -->
<button class="download-btn" onclick="downloadPDF()">Download PDF</button>

<!-- Script xuất PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
function downloadPDF() {
    const element = document.getElementById("resumeContent");
    const opt = {
        // ... (các tùy chọn khác)
        filename: '{{ Str::slug(($contract->first_name ?? "user") . " " . ($contract->last_name ?? "resume")) }}.pdf',
        // ... (các tùy chọn khác)
    };
    html2pdf().set(opt).from(element).save();
}
</script>
</body>
</html>
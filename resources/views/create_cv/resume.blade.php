@extends('layouts.createcv')
@section('content')
<div class="container section-padding">
    <div class="row">
        <div class="col-lg-10 col-12 mx-auto">
            <div class="resume" id="resumeContent">
                <!-- Header -->
                <div class="text-center mb-4">
                    <h1 class="mb-2">{{ $contract->first_name ?? '' }} {{ $contract->last_name ?? '' }}</h1>
                    <div class="info">
                        <p class="mb-1">{{ $contract->city ?? '' }}, {{ $contract->postal_code ?? '' }}</p>
                        <p class="mb-1">Phone: {{ $contract->phone ?? '' }}</p>
                        <p>Email: {{ $contract->email ?? '' }}</p>
                    </div>
                </div>

                <div class="line"></div>

                <!-- Professional Summary -->
                <div class="section mt-4">
                    <h2>Professional Summary</h2>
                    <p class="mt-2">{{ $about->summary ?? 'No summary provided.' }}</p>
                </div>

                <div class="line"></div>

                <!-- Skills -->
                <div class="section mt-4">
                    <h2>Skills</h2>
                    <p class="mt-2">
                        <span class="label">{{ $about->skill ?? 'No skill listed' }}</span> —
                        <span>{{ $about->level ?? 'Not specified' }}</span>
                    </p>
                </div>

                <div class="line"></div>

                <!-- Experiences -->
                <div class="section mt-4">
                    <h2>Experiences</h2>
                    @if($experiences)
                        <p class="mt-2">
                            <span class="label">{{ $experiences->job_title ?? '' }}</span><br>
                            {{ $experiences->employer ?? '' }} — {{ $experiences->city ?? '' }}<br>
                            @if($experiences->start_date && $experiences->end_date)
                                {{ \Carbon\Carbon::parse($experiences->start_date)->format('F Y') }}
                                to
                                {{ \Carbon\Carbon::parse($experiences->end_date)->format('F Y') }}<br>
                            @endif
                            {{ $experiences->description ?? '' }}
                        </p>
                    @else
                        <p class="mt-2">No experience has been added yet.</p>
                    @endif
                </div>

                <div class="line"></div>

                <!-- Education -->
                <div class="section mt-4">
                    <h2>Education</h2>
                    @if($educations)
                        <p class="mt-2">
                            <span class="label">{{ $educations->school ?? '' }}</span> — {{ $educations->city ?? '' }}<br>
                            Degree: {{ $educations->degree ?? 'Not specified' }}<br>
                            @if($educations->grad_date)
                                Graduation: {{ \Carbon\Carbon::parse($educations->grad_date)->format('F Y') }}<br>
                            @endif
                            {{ $educations->description ?? '' }}
                        </p>
                    @else
                        <p class="mt-2">No education has been added yet.</p>
                    @endif
                </div>
            </div>

            <!-- Download Button -->
            <div class="text-center mt-5">
                <button class="download-btn" onclick="downloadPDF()">Download as PDF</button>
            </div>
        </div>
    </div>
</div>

<!-- Script for PDF generation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
function downloadPDF() {
    const element = document.getElementById("resumeContent");
    const opt = {
        margin: [10, 10, 10, 10], // Top, right, bottom, left margins in mm
        filename: '{{ Str::slug(($contract->first_name ?? "user") . "_" . ($contract->last_name ?? "resume")) }}.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 3, useCORS: true }, // Higher scale for better quality
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
    };
    html2pdf().set(opt).from(element).save();
}
</script>
@endsection
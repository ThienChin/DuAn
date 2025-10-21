@extends('layouts.main')
@section('content')
<div class="container section-padding">
    <div class="row">
        <!-- Contact Info (Sidebar) -->
        <div class="col-lg-3 col-12 mb-5 mb-lg-0">
            <div class="resume-sidebar bg-light p-4 rounded shadow-sm border">
                <h3 class="text-primary mb-4">{{ $contract->first_name ?? '' }} {{ $contract->last_name ?? '' }}</h3>
                <div class="info">
                    <p class="mb-3"><i class="bi bi-geo-alt-fill me-2"></i>{{ $contract->city ?? '' }}, {{ $contract->postal_code ?? '' }}</p>
                    <p class="mb-3"><i class="bi bi-telephone-fill me-2"></i>Phone: {{ $contract->phone ?? '' }}</p>
                    <p><i class="bi bi-envelope-fill me-2"></i>Email: {{ $contract->email ?? '' }}</p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9 col-12">
            <div class="resume-content p-4 bg-white rounded shadow-sm" id="resumeContent">
                <!-- Professional Summary -->
                <div class="section mb-5">
                    <h2 class="border-bottom border-primary pb-2 mb-4">Professional Summary</h2>
                    <div class="card p-3 border-light">
                        <p class="text-muted">{{ $about->summary ?? 'No summary provided.' }}</p>
                    </div>
                </div>

                <!-- Skills -->
                <div class="section mb-5">
                    <h2 class="border-bottom border-primary pb-2 mb-4">Skills</h2>
                    <div class="card p-3 border-light">
                        <p>
                            <span class="badge bg-primary text-white me-3">{{ $about->skill ?? 'No skill listed' }}</span>
                            <span class="text-secondary">{{ $about->level ?? 'Not specified' }}</span>
                        </p>
                    </div>
                </div>

                <!-- Experiences -->
                <div class="section mb-5">
                    <h2 class="border-bottom border-primary pb-2 mb-4">Experiences</h2>
                    <div class="card p-3 border-light">
                        @if($experiences)
                            <div class="mb-4">
                                <h4 class="mb-2">{{ $experiences->job_title ?? '' }}</h4>
                                <p class="text-muted mb-2">{{ $experiences->employer ?? '' }} — {{ $experiences->city ?? '' }}</p>
                                @if($experiences->start_date && $experiences->end_date)
                                    <p class="text-muted mb-2">
                                        {{ \Carbon\Carbon::parse($experiences->start_date)->format('F Y') }}
                                        to
                                        {{ \Carbon\Carbon::parse($experiences->end_date)->format('F Y') }}
                                    </p>
                                @endif
                                <p>{{ $experiences->description ?? '' }}</p>
                            </div>
                        @else
                            <p class="text-muted">No experience has been added yet.</p>
                        @endif
                    </div>
                </div>

                <!-- Education -->
                <div class="section">
                    <h2 class="border-bottom border-primary pb-2 mb-4">Education</h2>
                    <div class="card p-3 border-light">
                        @if($educations)
                            <div class="mb-4">
                                <h4 class="mb-2">{{ $educations->school ?? '' }}</h4>
                                <p class="text-muted mb-2">{{ $educations->city ?? '' }}</p>
                                <p class="text-muted mb-2">Degree: {{ $educations->degree ?? 'Not specified' }}</p>
                                @if($educations->grad_date)
                                    <p class="text-muted mb-2">Graduation: {{ \Carbon\Carbon::parse($educations->grad_date)->format('F Y') }}</p>
                                @endif
                                <p>{{ $educations->description ?? '' }}</p>
                            </div>
                        @else
                            <p class="text-muted">No education has been added yet.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Download Button -->
    <div class="text-center mt-5">
        <button class="download-btn btn btn-primary btn-lg rounded-pill px-4 py-2" onclick="downloadPDF()">
            <i class="bi bi-download me-2"></i> Download as PDF
        </button>
    </div>
</div>

<!-- Script for PDF generation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
function downloadPDF() {
    const element = document.getElementById("resumeContent");
    const opt = {
        margin: [15, 15, 15, 15],
        filename: '{{ Str::slug(($contract->first_name ?? "user") . "_" . ($contract->last_name ?? "resume")) }}.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 3, useCORS: true },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
        pagebreak: { mode: ['css', 'legacy'] }
    };
    html2pdf().set(opt).from(element).toPdf().get('pdf').then(function (pdf) {
        const totalPages = pdf.internal.getNumberOfPages();
        for (let i = 1; i <= totalPages; i++) {
            pdf.setPage(i);
            pdf.setFontSize(10);
            pdf.text('Page ' + i + ' of ' + totalPages, pdf.internal.pageSize.width / 2, pdf.internal.pageSize.height - 10, { align: 'center' });
        }
    }).save();
}
</script>
@endsection
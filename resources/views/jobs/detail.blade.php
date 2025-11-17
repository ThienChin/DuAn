@extends('layouts.main')

{{-- CSS to ensure the layout is not overwhelmed and refine UL/LI --}}
@section('styles')
<style>
    /* CSS for layout overrides (if layouts.main is not full width) */
    .job-section .container-fluid,
    .cta-section .container-fluid,
    .site-footer .container-fluid {
        /* Limit maximum width for clean layout */
        max-width: 1400px;
        padding-left: 15px;
        padding-right: 15px;
    }
    
    /* Styling for Requirements and Benefits lists */
    .job-thumb-detail ul {
        list-style: none;
        padding-left: 0;
        margin-top: 15px;
    }
    .job-thumb-detail ul li {
        margin-bottom: 8px;
        line-height: 1.6;
        padding-left: 20px;
        position: relative;
    }
    /* Custom checkmark icon */
    .job-thumb-detail ul li::before {
        content: "\f26a"; /* Bootstrap icon: bi-check2 */
        font-family: 'bootstrap-icons';
        position: absolute;
        left: 0;
        color: #28a745; /* Green color */
        font-weight: 700;
        top: 2px;
    }

    /* Title styling for detailed content */
    .job-thumb-detail h4, .job-thumb-detail h5 {
        color: #007bff; /* Primary color */
        border-bottom: 2px solid #007bff40; /* Light underline */
        padding-bottom: 5px;
        margin-top: 30px !important;
    }
    
    /* Remove unnecessary CSS Grid rules */
    .job-details-grid, .job-info-list.info-columns {
        display: block !important;
        grid-template-columns: none !important;
        gap: 0 !important;
    }
</style>
@endsection

@section('content')
    <main>

        {{-- HEADER --}}
        <header class="site-header">
            <div class="section-overlay"></div>

            <div class="container-fluid" style="max-width: 1400px;"> 
                <div class="row">
                    
                    <div class="col-lg-12 col-12 text-center">
                        {{-- DYNAMIC TITLE --}}
                        <h1 class="text-white">⭐ {{ $job->title ?? 'Job Details' }}</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="{{ route('page.index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $job->title ?? 'Job Details' }}</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
        </header>

        ---

        {{-- JOB DETAIL SECTION (8/4 Layout - BLOCK LAYOUT) --}}
        <section class="job-section section-padding pb-0">
            <div class="container-fluid" style="max-width: 1400px;"> 
                <div class="row">

                    {{-- Column 8: Job Details (Block Layout) --}}
                    <div class="col-lg-8 col-12">
                        <h2 class="job-title mb-0 text-dark">{{ $job->title ?? 'Technical Lead' }}</h2>

                        <div class="job-thumb job-thumb-detail">
                            
                            {{-- CORE INFO --}}
                            <div class="d-flex flex-wrap align-items-center border-bottom pt-lg-3 pt-2 pb-3 mb-4">
                                
                                {{-- LOCATION --}}
                                <p class="job-location mb-0 me-3 text-muted">
                                    <i class="custom-icon bi-geo-alt me-1 text-primary"></i>
                                    {{ optional($job->locationItem)->value ?? 'Kuala, Malaysia' }}
                                </p>

                                {{-- POSTED AT --}}
                                <p class="job-date mb-0 me-3 text-muted">
                                    <i class="custom-icon bi-clock me-1 text-primary"></i>
                                    {{ $job->posted_at ? \Carbon\Carbon::parse($job->posted_at)->diffForHumans() : '10 hours ago' }}
                                </p>

                                {{-- SALARY --}}
                                <p class="job-price mb-0 me-3 text-success fw-bold">
                                    <i class="custom-icon bi-cash me-1"></i>
                                    {{ isset($job->salary) && $job->salary > 0 ? number_format($job->salary, 0) . ' VND' : '$20k (Negotiable)' }}
                                </p>

                                <div class="d-flex">
                                    {{-- LEVEL --}}
                                    <p class="mb-0 me-2">
                                        <a href="{{ route('jobs.list', ['level' => $job->level_id]) }}" class="badge bg-primary text-white">{{ optional($job->levelItem)->value ?? 'Internship' }}</a>
                                    </p>
                                    {{-- TYPE --}}
                                    <p class="mb-0">
                                        <a href="{{ route('jobs.list', ['type' => $job->remote_type_id]) }}" class="badge bg-secondary text-white">{{ optional($job->remoteTypeItem)->value ?? 'Freelance' }}</a>
                                    </p>
                                </div>
                            </div>

                            {{-- JOB DESCRIPTION --}}
                            <h4 class="mt-4 mb-2">📄 Job Description</h4>
                            <p style="white-space: pre-line;">{!! nl2br(e($job->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.')) !!}</p>

                            {{-- BENEFITS / ROLE --}}
                            <h5 class="mt-4 mb-3">💰 Benefits & Perks</h5>
                            @if(isset($job->benefits) && is_string($job->benefits))
                                <p class="mb-1"><strong>Benefits:</strong> {!! nl2br(e($job->benefits)) !!}</p>
                            @else
                                <p class="mb-1"><strong>General Benefits:</strong> Health insurance, performance bonus, company travel.</p>
                            @endif
                            <p><strong>Salary Information:</strong> {{ $job->salary_note ?? 'Competitive salary, negotiable based on experience.' }}</p>

                            {{-- REQUIREMENTS --}}
                            <h5 class="mt-4 mb-3">🎯 Candidate Requirements</h5>
                            
                            <ul>
                                <li>
                                    <strong><i class="bi bi-person-badge me-2"></i>Job Level:</strong> 
                                    {{ optional($job->levelItem)->value ?? 'N/A' }}
                                </li>
                                <li>
                                    <strong><i class="bi bi-hammer me-2"></i>Experience:</strong> 
                                    {{ optional($job->experienceItem)->value ?? 'None required' }}
                                </li>
                                <li>
                                    <strong><i class="bi bi-mortarboard me-2"></i>Degree:</strong> 
                                    {{ optional($job->degreeItem)->value ?? 'None required' }}
                                </li>
                                <li>
                                    <strong><i class="bi bi-gender-ambiguous me-2"></i>Gender:</strong> 
                                    {{ optional($job->genderItem)->value ?? 'Any' }}
                                </li>
                                <li>
                                    <strong><i class="bi bi-calendar-check me-2"></i>Age:</strong> 
                                    {{ $job->age ?? 'N/A' }}
                                </li>
                                @if(isset($job->required_skills))
                                    <li class="mt-3">
                                        <strong><i class="bi bi-code-slash me-2"></i>Additional Skills:</strong> 
                                        {!! nl2br(e($job->required_skills)) !!}
                                    </li>
                                @endif
                            </ul>
                            

                            {{-- ACTIONS & SHARE BUTTONS --}}
                            <div class="d-flex justify-content-center flex-wrap mt-5 border-top pt-4">
                                <a href="{{ route('jobs.apply.form', $job->id) }}" class="custom-btn btn mt-2 btn-lg">Apply now</a>

                                <a href="#" class="custom-btn custom-border-btn btn mt-2 ms-lg-4 ms-3">Save this job</a>

                                <div class="job-detail-share d-flex align-items-center">
                                    <p class="mb-0 me-lg-4 me-3">Share:</p>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="bi-facebook text-primary fs-5"></a>
                                    <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}" target="_blank" class="bi-twitter mx-3 text-info fs-5"></a>
                                    <a href="#" class="bi-share text-secondary fs-5"></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Column 4: Company Sidebar --}}
                    <div class="col-lg-4 col-12 mt-5 mt-lg-0">
                        <div class="job-thumb job-thumb-detail-box bg-white shadow-lg p-4">
                            <div class="d-flex align-items-center mb-3 border-bottom pb-3">
                                <div class="job-image-wrap d-flex align-items-center mb-0">
                                    @php
                                        // Use asset('storage/...') for logo path
                                        $logoUrl = $job->company_logo_url ? asset('storage/' . $job->company_logo_url) : asset('images/logos/google.png');
                                    @endphp
                                    <img src="{{ $logoUrl }}" class="job-image me-3 img-fluid rounded-circle" alt="{{ $job->company_name ?? 'Company Logo' }}" style="width: 50px; height: 50px; object-fit: contain;">

                                    <p class="mb-0 fw-bold">{{ $job->company_name ?? 'Google' }}</p>
                                </div>

                                <a href="#" class="bi-bookmark ms-auto me-2 text-secondary fs-5"></a>
                                <a href="#" class="bi-heart text-danger fs-5"></a>
                            </div>

                            <h6 class="mt-3 mb-2 text-primary">🏢 About the Company</h6>
                            <p class="small">{{ $job->company_description ?? 'Lorem ipsum dolor sit amet, consectetur elit sed do eiusmod tempor incididunt labore.' }}</p>

                            <h6 class="mt-4 mb-3 text-primary">📞 Contact Information</h6>

                            <p class="mb-2 small">
                                <i class="custom-icon bi-globe me-1 text-secondary"></i>
                                <a href="{{ $job->website ?? '#' }}" class="site-footer-link" target="_blank">
                                    {{ $job->website ?? 'www.jobbportal.com' }}
                                </a>
                            </p>

                            <p class="mb-2 small">
                                <i class="custom-icon bi-telephone me-1 text-secondary"></i>
                                <a href="tel: {{ $job->phone ?? '305-240-9671' }}" class="site-footer-link">
                                    {{ $job->phone ?? '305-240-9671' }}
                                </a>
                            </p>

                            <p class="small">
                                <i class="custom-icon bi-envelope me-1 text-secondary"></i>
                                <a href="mailto:{{ $job->email ?? 'info@yourgmail.com' }}" class="site-footer-link">
                                    {{ $job->email ?? 'info@jobportal.co' }}
                                </a>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        ---

        {{-- SIMILAR JOBS SECTION --}}
        <section class="job-section section-padding bg-light">
            <div class="container-fluid" style="max-width: 1400px;">
                <div class="row align-items-center">

                    <div class="col-lg-6 col-12 mb-lg-4">
                        <h3>Similar Jobs</h3>
                        <p><strong>Over 10k opening jobs</strong> Lorem Ipsum dolor sit amet, consectetur adipsicing kengan omeg kohm tokito adipcingi elit eismuod larehai</p>
                    </div>

                    <div class="col-lg-4 col-12 d-flex ms-auto mb-5 mb-lg-4">
                        <a href="{{ route('jobs.list') }}" class="custom-btn custom-border-btn btn ms-lg-auto">Browse Job Listings</a>
                    </div>

                    {{-- Loop for similar jobs --}}
                    @foreach (\App\Models\Job::where('category_id', $job->category_id ?? 1)->where('id', '!=', $job->id)->take(3)->get() as $similarJob)
                        <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
                            <div class="job-thumb job-thumb-box shadow-sm">
                                <div class="job-image-box-wrap">
                                    <a href="{{ route('jobs.show', $similarJob->id) }}">
                                        {{-- Use similar job image if available, otherwise default --}}
                                        <img src="{{ $similarJob->jobs_images ? asset('storage/' . $similarJob->jobs_images) : asset('images/jobs/it-professional-works-startup-project.jpg') }}" class="job-image img-fluid" alt="{{ $similarJob->title }}">
                                    </a>

                                    <div class="job-image-box-wrap-info d-flex align-items-center">
                                        <p class="mb-0">
                                            <span class="badge bg-primary">{{ optional($similarJob->levelItem)->value ?? 'N/A' }}</span>
                                        </p>

                                        <p class="mb-0">
                                            <span class="badge bg-secondary">{{ optional($similarJob->remoteTypeItem)->value ?? 'N/A' }}</span>
                                        </p>
                                    </div>
                                </div>

                                <div class="job-body p-3">
                                    <h4 class="job-title">
                                        <a href="{{ route('jobs.show', $similarJob->id) }}" class="job-title-link text-dark">{{ $similarJob->title }}</a>
                                    </h4>

                                    <div class="d-flex align-items-center pt-2">
                                        <p class="job-location small text-muted me-3">
                                            <i class="custom-icon bi-geo-alt me-1"></i>
                                            {{ optional($similarJob->locationItem)->value ?? 'N/A' }}
                                        </p>
                                        <p class="job-date small text-muted">
                                            <i class="custom-icon bi-clock me-1"></i>
                                            {{ \Carbon\Carbon::parse($similarJob->posted_at)->diffForHumans() }}
                                        </p>
                                    </div>
                                    
                                    <div class="d-flex align-items-center border-top pt-3 mt-3">
                                        <p class="job-price mb-0 fw-bold text-success">
                                            <i class="custom-icon bi-cash me-1"></i>
                                            {{ number_format($similarJob->salary ?? 0, 0) }} VND
                                        </p>

                                        <a href="{{ route('jobs.show', $similarJob->id) }}" class="custom-btn btn ms-auto btn-sm">Apply now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- CTA SECTION --}}
        <section class="cta-section">
            <div class="section-overlay"></div>

            <div class="container-fluid" style="max-width: 1400px;">
                <div class="row">
                    <div class="col-lg-6 col-10">
                        <h2 class="text-white mb-2">Over 10k opening jobs</h2>
                        <p class="text-white">Gotto Job is a leading recruitment platform. Create an account now to not miss out on the best job opportunities.</p>
                    </div>
                    
                    <div class="col-lg-4 col-12 ms-auto">
                        <div class="custom-border-btn-wrap d-flex align-items-center mt-lg-4 mt-2">
                            <a href="{{ route('create_cv.contract') }}" class="custom-btn custom-border-btn btn me-4">Create resume</a>

                            {{-- Form và nút Upload CV --}}
                            <form id="cvUploadForm" action="{{ route('create_cv.upload') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                                @csrf
                                <input type="file" name="pdfFile" id="pdfFileInput" accept=".pdf" onchange="document.getElementById('cvUploadForm').submit()">
                            </form>
                            <button type="button" class="custom-btn custom-border-btn btn me-4" onclick="document.getElementById('pdfFileInput').click()">
                                Post your CV
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
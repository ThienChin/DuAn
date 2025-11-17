@extends('layouts.employer')

@section('title', 'Gotto Online Job Portal')

@section('content')
<section class="banner position-relative text-white overflow-hidden" style="height: 480px;">
    <img src="{{ asset('page/images/professional-asian-businesswoman-gray-blazer.jpg') }}" 
          alt="Gotto Employer Banner" 
          class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"
          style="opacity: 0.45; z-index: 1;">

    <div class="position-absolute top-0 start-0 w-100 h-100" 
          style="background: rgba(108,99,255,0.5); z-index: 2;">
    </div>

    <div class="container position-relative z-3 text-center d-flex flex-column justify-content-center align-items-center h-100">
        <h1 class="fw-bold mb-3" style="font-size: 3rem; line-height: 1.2;">
            The Smart Recruitment Platform <br> with <span style="color: #fff;">Gotto Online Job</span>
        </h1>
        <p class="lead text-white-50 mb-4" style="max-width: 700px;">
            Connect with thousands of potential candidates and build your professional recruitment brand.
        </p>
        <div>
            
            {{-- Logic Check: If employer is logged in, show 'Create Job' button. Otherwise, show 'Login' button. --}}
            @auth('employer')
                <a href="{{ route('employer.create') }}" class="btn btn-light text-primary fw-semibold px-4 py-2 rounded-pill shadow-sm me-3">
                    Post a New Job
                </a>
            @else
                <a href="{{ route('employer.login') }}" class="btn btn-light text-primary fw-semibold px-4 py-2 rounded-pill shadow-sm me-3">
                    Post a Job Now
                </a>
            @endauth

        </div>
    </div>
</section>



<section class="py-5 bg-white text-center">
    <div class="container">
        <h2 class="fw-bold mb-3" style="color: var(--gotto-primary);">Fast Recruitment with Gotto</h2>
        <p class="text-muted mb-5">A platform that helps businesses post jobs, manage applications, and find the most suitable candidates.</p>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="p-4 shadow-sm rounded-4 h-100">
                    <h5 class="fw-bold text-primary mb-3">1. Free Job Posting</h5>
                    <p class="text-muted">Create quick and intuitive job listings in just a few simple steps.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 shadow-sm rounded-4 h-100">
                    <h5 class="fw-bold text-primary mb-3">2. Candidate Management</h5>
                    <p class="text-muted">Convenient application management system helps you track the application progress easily.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 shadow-sm rounded-4 h-100">
                    <h5 class="fw-bold text-primary mb-3">3. Smart Suggestions</h5>
                    <p class="text-muted">AI technology automatically suggests the most suitable candidates for each position.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
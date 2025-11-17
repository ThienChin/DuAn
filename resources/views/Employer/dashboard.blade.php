@extends('layouts.employer')

@section('title', 'Employer Dashboard')

@section('content')
<div class="container my-5">
    <div class="row">
        {{-- COL 1: SIDEBAR MENU --}}
        <div class="col-lg-3">
            <div class="list-group shadow-sm bg-white rounded-3 p-3 mb-4">
                <h5 class="mb-3 text-muted">GENERAL MANAGEMENT</h5>
                <a href="{{ route('employer.dashboard') }}" class="list-group-item list-group-item-action @if(Route::is('employer.dashboard')) active @endif"><i class="bi bi-house-door-fill me-2"></i> Dashboard Home</a> 
                <a href="{{ route('employer.create') }}" class="list-group-item list-group-item-action @if(Route::is('employer.create')) active @endif"><i class="bi bi-upload me-2"></i> Post New Job</a>
                <a href="{{ route('employer.myJobs') }}" class="list-group-item list-group-item-action @if(Route::is('employer.myJobs')) active @endif"><i class="bi bi-list-task me-2"></i> All Job Postings</a>

                <h5 class="mt-4 mb-3 text-muted">CANDIDATES & APPLICATIONS</h5>
                <a href="{{ route('employer.history') }}" class="list-group-item list-group-item-action @if(Route::is('employer.history')) active @endif"><i class="bi bi-person-lines-fill me-2"></i> Application History</a>
                
                <h5 class="mt-4 mb-3 text-muted">SETTINGS</h5>
                <a href="{{ route('employer.companyInfo') }}" class="list-group-item list-group-item-action"><i class="bi bi-building me-2"></i> Company Info</a>
                <a href="{{ route('employer.accountSettings') }}" class="list-group-item list-group-item-action"><i class="bi bi-gear-fill me-2"></i> Account Settings</a>
                <a href="{{ route('employer.logout') }}" 
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                    class="list-group-item list-group-item-action text-danger">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </a>

                <form id="logout-form" action="{{ route('employer.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>

        {{-- COL 2: DASHBOARD CONTENT --}}
        <div class="col-lg-9">
            
            {{-- WELCOME BLOCK --}}
            <div class="card shadow-sm border-0 mb-4 p-4 p-md-5" style="background-color: #e6f7ff; border-left: 5px solid #007bff !important;">
                <h3 class="fw-bold mb-2 text-dark">Welcome, {{ Auth::guard('employer')->user()->company_name ?? 'Employer' }}!</h3>
                <p class="text-muted mb-0">This is your recruitment dashboard. Track key metrics and manage candidate applications here.</p>
            </div>


            {{-- DASHBOARD STATS ROW --}}
            <div class="row g-3 mb-4">
                <div class="col-md-4 col-lg-3">
                    <div class="card p-3 text-center shadow-sm border-0 h-100">
                        <i class="bi bi-briefcase-fill h4 mb-2" style="color: #4834d4;"></i>
                        <div id="count-jobs" class="h3 mb-1 fw-bold" style="color: #4834d4;">{{ $postedJobsCount ?? 0 }}</div> 
                        <p class="text-muted mb-0">Jobs Posted</p>
                    </div>
                </div>

                <div class="col-md-4 col-lg-3">
                    <div class="card p-3 text-center shadow-sm border-0 h-100">
                        <i class="bi bi-file-earmark-person-fill h4 mb-2" style="color: #ff7675;"></i>
                        <div id="count-applications" class="h3 mb-1 fw-bold" style="color: #ff7675;">{{ $applicationsCount ?? 0 }}</div>
                        <p class="text-muted mb-0">Applications Received</p>
                    </div>
                </div>

                <div class="col-md-4 col-lg-3">
                    <div class="card p-3 text-center shadow-sm border-0 h-100">
                        <i class="bi bi-eye-fill h4 mb-2" style="color: #ff6b6b;"></i>
                        <div id="count-viewed-applications" class="h3 mb-1 fw-bold" style="color: #ff6b6b;">{{ $viewedApplicationsCount ?? 0 }}</div>
                        <p class="text-muted mb-0">Applications Reviewed</p>
                    </div>
                </div>
                
                {{-- STATIC DECORATIVE BLOCK --}}
                <div class="col-md-4 col-lg-3">
                    <div class="card p-3 text-center shadow-sm border-0 h-100" style="background-color: #e3fcf0;">
                        <i class="bi bi-shield-fill-check h4 mb-2 text-success"></i>
                        <div id="static-account-status" class="h3 mb-1 fw-bold text-success">Active</div>
                        <p class="text-muted mb-0">Account Status</p>
                    </div>
                </div>

            </div>

            {{-- ACTION GUIDANCE BLOCK --}}
            <div class="card shadow-sm border-0 mb-4 p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5 class="card-title mb-3 fw-bold"><i class="bi bi-arrow-right-circle-fill me-2 text-primary"></i> Required Actions</h5>
                        <p class="text-muted mb-3">Start recruiting quickly by posting a job or reviewing newly submitted applications.</p>
                        <div class="d-flex gap-3">
                            <a href="{{ route('employer.create') }}" class="btn btn-primary fw-bold">
                                <i class="bi bi-send-plus me-1"></i> Post New Job
                            </a>
                            <a href="{{ route('employer.history') }}" class="btn btn-outline-secondary fw-bold">
                                <i class="bi bi-person-lines-fill me-1"></i> View Applications
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 text-center mt-4 mt-md-0">
                         <i class="bi bi-bullseye display-4 text-secondary opacity-50"></i>
                    </div>
                </div>
            </div>

            {{-- LATEST APPLICATIONS BLOCK --}}
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0 pt-4 pb-0">
                    <h5 class="card-title fw-bold d-inline-block">Latest Applications Received</h5>
                    <a href="{{ route('employer.history') }}" class="float-end text-primary text-decoration-none fw-semibold small">View All >></a>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex fw-bold text-white" style="background-color: var(--gotto-primary);">
                            <div class="col-4">Candidate Profile</div>
                            <div class="col-4">Applied Position</div>
                            <div class="col-4">Date Submitted</div>
                        </li>
                        <li class="list-group-item text-center text-muted py-4">
                            No suitable data...
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
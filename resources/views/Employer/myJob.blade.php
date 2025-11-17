@extends('layouts.employer')

@section('title', 'All Posted Jobs')

@section('content')
<div class="container-fluid py-4" style="max-width: 1400px;">
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

        {{-- COL 2: MAIN CONTENT --}}
        <div class="col-lg-9">
            
            {{-- THÊM: KHỐI CHÀO MỪNG NHỎ (TRANG TRÍ) --}}
            <div class="card shadow-sm border-0 mb-4 p-3" style="background-color: #f5f7ff; border-left: 4px solid var(--gotto-primary) !important;">
                 <h5 class="fw-bold mb-0 text-dark">
                    <i class="bi bi-list-task me-2 text-primary"></i> Managing All Your Posted Jobs
                </h5>
            </div>
            
            <div class="card shadow-lg border-0">
                <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center p-3">
                    <h4 class="card-title mb-0 fw-bold">
                        Job Postings List
                    </h4>
                    <a href="{{ route('employer.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus-circle-fill me-1"></i> Post New Job
                    </a>
                </div>

                <div class="card-body p-0">
                    @if(session('success'))
                        <div class="alert alert-success m-3">{{ session('success') }}</div>
                    @endif
                    
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th style="width: 35%;">Title & Location</th>
                                    <th style="width: 15%;">Salary</th>
                                    <th style="width: 15%;">Level</th>
                                    <th style="width: 15%;">Date Posted</th>
                                    <th style="width: 10%;">Status</th>
                                    <th class="text-center" style="width: 10%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jobs as $job)
                                <tr>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $job->title }}</div>
                                        <div class="small text-muted">
                                            <i class="bi bi-geo-alt me-1"></i>{{ $job->locationItem->value ?? 'N/A' }}
                                        </div>
                                    </td>
                                    <td class="fw-semibold text-success">{{ number_format($job->salary) }} VND</td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $job->levelItem->value ?? 'N/A' }}</span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($job->posted_at)->format('d/m/Y') }}</td>
                                    
                                    <td>
                                        {{-- Display status badge --}}
                                        @if($job->status == 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($job->status == 'approved')
                                            <span class="badge bg-success">Approved</span>
                                        @else
                                            <span class="badge bg-danger">Rejected</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        
                                        {{-- Edit Button --}}
                                        <a href="{{ route('employer.editJob', $job->id) }}" class="btn btn-sm btn-warning me-1" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        {{-- Delete Button (Form) --}}
                                        <form action="{{ route('employer.destroyJob', $job->id) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete the job: {{ $job->title }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach

                                @if($jobs->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center text-muted p-4">
                                            <i class="bi bi-info-circle me-2"></i> You have not posted any job listings yet. 
                                            <a href="{{ route('employer.create') }}" class="btn btn-sm btn-link fw-semibold">Post now!</a>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{-- Pagination links: {{ $jobs->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
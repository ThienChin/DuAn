@extends('layouts.employer')

@section('title', 'Application History')

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
            
            {{-- PROMOTION CARD --}}
            <div class="card bg-info text-white rounded-3 shadow-sm p-4">
                <h6 class="fw-bold mb-1"><i class="bi bi-megaphone me-2"></i> Exclusive Offer!</h6>
                <p class="small mb-2">Upgrade your plan to unlock more features and reach 50% more candidates.</p>
                <a href="#" class="btn btn-sm btn-light fw-bold">VIEW DETAILS</a>
            </div>
        </div>

        {{-- COL-LG-9: MAIN CONTENT --}}
        <div class="col-lg-9">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-white border-bottom p-4">
                    <h2 class="fw-bold text-primary mb-1">
                        <i class="bi bi-person-lines-fill me-2"></i> Received Applications
                    </h2>
                    <p class="text-muted mb-0">Total Applications: <span class="fw-bold">{{ $applications->count() }}</span></p>
                    
                    {{-- Notifications --}}
                    @if(session('success'))
                        <div class="alert alert-success mt-3">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                    @endif
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless table-hover mb-0">
                            <thead class="table-primary text-white">
                                <tr>
                                    <th style="width: 20%;">Candidate Name</th>
                                    <th style="width: 25%;">Applied Position</th>
                                    <th style="width: 15%;">Date Submitted</th>
                                    <th style="width: 15%;">Status</th> 
                                    <th style="width: 25%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($applications as $application)
                                <tr>
                                    <td class="fw-bold text-dark">
                                        <i class="bi bi-file-earmark-person me-1"></i> {{ $application->name }}
                                        <div class="small text-muted">{{ $application->email }}</div>
                                    </td>
                                    <td>
                                        <span class="fw-semibold">{{ $application->job->title ?? 'Job Not Found' }}</span>
                                    </td>
                                    <td>{{ $application->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        {{-- Current Status Badge --}}
                                        @php
                                            $badgeClass = match ($application->status) {
                                                'pending' => 'bg-warning text-dark',
                                                'accepted' => 'bg-success',
                                                'rejected' => 'bg-danger',
                                                default => 'bg-secondary',
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">
                                            {{ ucfirst($application->status) }}
                                        </span>
                                    </td>
                                    <td class="text-start">
                                        {{-- Action Buttons --}}
                                        
                                        {{-- 1. View CV --}}
                                        <a href="{{ route('employer.viewCV', $application) }}" class="btn btn-sm btn-info text-white mb-1" target="_blank" title="View CV">
                                            <i class="fas fa-eye"></i> View CV
                                        </a>

                                        @if ($application->status === 'pending')
                                            {{-- 2. Accept Button --}}
                                            <a href="{{ route('employer.application_form', ['application' => $application->id, 'action' => 'accepted']) }}" class="btn btn-sm btn-success mb-1" title="Accept/Invite">
                                                <i class="fas fa-check"></i> Accept
                                            </a>

                                            {{-- 3. Reject Button --}}
                                            <a href="{{ route('employer.application_form', ['application' => $application->id, 'action' => 'rejected']) }}" class="btn btn-sm btn-danger mb-1" title="Reject">
                                                <i class="fas fa-times"></i> Reject
                                            </a>
                                        @endif 
                                        
                                        {{-- Nút Lưu hồ sơ ĐÃ BỊ XÓA --}}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center p-4">No applications received yet.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    {{-- Pagination (if applicable) --}}
                    {{-- {{ $applications->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
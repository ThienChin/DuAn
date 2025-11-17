@extends('layouts.employer')

@section('title', 'Company Information')

@section('content')
<div class="container-fluid py-4" style="max-width: 1400px;">
    <div class="row">
        
        {{-- Sidebar --}}
        <div class="col-lg-3">
            <div class="list-group shadow-sm bg-white rounded-3 p-3 mb-4">
                <h5 class="mb-3 text-muted">GENERAL MANAGEMENT</h5>
                <a href="{{ route('employer.dashboard') }}" class="list-group-item list-group-item-action"><i class="bi bi-house-door-fill me-2"></i> Dashboard Home</a> 
                <a href="{{ route('employer.create') }}" class="list-group-item list-group-item-action"><i class="bi bi-upload me-2"></i> Post New Job</a>
                <a href="{{ route('employer.myJobs') }}" class="list-group-item list-group-item-action"><i class="bi bi-list-task me-2"></i> All Job Postings</a>

                <h5 class="mt-4 mb-3 text-muted">CANDIDATES & APPLICATIONS</h5>
                <a href="{{ route('employer.history') }}" class="list-group-item list-group-item-action"><i class="bi bi-person-lines-fill me-2"></i> Application History</a>
                
                <h5 class="mt-4 mb-3 text-muted">SETTINGS</h5>
                <a href="{{ route('employer.companyInfo') }}" class="list-group-item list-group-item-action active"><i class="bi bi-building me-2"></i> Company Info</a>
                <a href="{{ route('employer.accountSettings') }}" class="list-group-item list-group-item-action"><i class="bi bi-gear-fill me-2"></i> Account Settings</a>
                <a href="{{ route('employer.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="list-group-item list-group-item-action text-danger"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
                <form id="logout-form" action="{{ route('employer.logout') }}" method="POST" class="d-none">@csrf</form>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="col-lg-9">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white p-3">
                    <h4 class="mb-0"><i class="bi bi-building me-2"></i> Company Profile Management</h4>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success"><i class="bi bi-check-circle me-2"></i> {{ session('success') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger"><i class="bi bi-exclamation-triangle me-2"></i> Please review the fields below.</div>
                    @endif

                    <form action="{{ route('employer.updateCompanyInfo') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="company_name" class="form-label fw-semibold">Company Name *</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name', $employer->company_name) }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="website" class="form-label fw-semibold">Website</label>
                            <input type="url" class="form-control" id="website" name="website" value="{{ old('website', $employer->website) }}" placeholder="https://">
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label fw-semibold">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $employer->address) }}" placeholder="City, State, Country">
                        </div>
                        
                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">Company Description</label>
                            <textarea class="form-control" id="description" name="description" rows="5" style="resize: none;">{{ old('description', $employer->description) }}</textarea>
                            {{-- ✨ FIXED: resize: none; --}}
                        </div>

                        {{-- 
                        *LƯU Ý: Phần chọn logo (company_logo_url_new) đã được loại bỏ theo yêu cầu.
                                Nếu bạn muốn thêm nó lại, hãy thêm input type="file" ở đây. 
                        --}}

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary fw-bold px-5">SAVE UPDATES</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
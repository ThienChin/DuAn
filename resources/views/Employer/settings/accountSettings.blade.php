@extends('layouts.employer')

@section('title', 'Account Settings')

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
                <a href="{{ route('employer.accountSettings') }}" class="list-group-item list-group-item-action active"><i class="bi bi-gear-fill me-2"></i> Account Settings</a>
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

        {{-- Nội dung chính --}}
        <div class="col-lg-9">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white p-3">
                    <h4 class="mb-0"><i class="bi bi-gear-fill me-2"></i> Account Settings (Recruiter)</h4>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success"><i class="bi bi-check-circle me-2"></i> {{ session('success') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger"><i class="bi bi-exclamation-triangle me-2"></i> Please check the information fields below.</div>
                    @endif

                    <form action="{{ route('employer.updateAccountSettings') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <h5 class="mb-3 text-primary"><i class="bi bi-person-fill me-2"></i> Personal Information</h5>

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Full Name *</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $employer->name) }}" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label fw-semibold">Login Email *</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $employer->email) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label fw-semibold">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $employer->phone) }}">
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="form-label fw-semibold me-3 mb-0">Gender: *</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="genderNam" value="Nam" {{ old('gender', $employer->gender) == 'Nam' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="genderNam">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="genderNu" value="Nữ" {{ old('gender', $employer->gender) == 'Nữ' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="genderNu">Female</label>
                            </div>
                            @error('gender') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>


                        <h5 class="mb-3 mt-4 text-primary"><i class="bi bi-lock-fill me-2"></i> Change Password</h5>

                        <div class="mb-3">
                            <label for="current_password" class="form-label fw-semibold">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter old password if you want to change it">
                            @error('current_password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password_new" class="form-label fw-semibold">New Password</label>
                                <input type="password" class="form-control" id="password_new" name="password_new">
                                @error('password_new') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password_new_confirmation" class="form-label fw-semibold">Confirm New Password</label>
                                <input type="password" class="form-control" id="password_new_confirmation" name="password_new_confirmation">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary fw-bold px-5">SAVE SETTINGS</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
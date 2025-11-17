@extends('layouts.employer')
@section('title', 'Employer Registration - Gotto')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <h2 class="card-title text-center mb-5" style="color: var(--gotto-primary);">
                        Employer Account Registration
                    </h2>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            Please check the information fields below.
                        </div>
                    @endif

                    <form method="POST" action="{{ route('employer.register') }}">
                        @csrf
                        
                        <h4 class="mb-4">Login Credentials</h4>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold"><i class="fa fa-envelope me-2"></i> Login Email *</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                            <small class="form-text text-muted">If you register with a non-corporate email domain, some account services may be restricted or unavailable for purchase.</small>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label fw-semibold"><i class="fa fa-lock me-2"></i> Password *</label>
                                <div class="input-group">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password (6 to 25 characters)" required autocomplete="new-password">
                                    <span class="input-group-text"><i class="fa fa-eye-slash"></i></span>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label fw-semibold"><i class="fa fa-lock me-2"></i> Confirm Password *</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re-enter password" required autocomplete="new-password">
                                    <span class="input-group-text"><i class="fa fa-eye-slash"></i></span>
                                </div>
                            </div>
                        </div>

                        <h4 class="mb-4 mt-4">Recruiter Information</h4>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-semibold">Full Name *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Full Name" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3 d-flex align-items-center pt-2">
                                <label class="form-label fw-semibold me-3 mb-0">Gender: *</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="genderNam" value="Nam" {{ old('gender') == 'Nam' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="genderNam">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="genderNu" value="Nữ" {{ old('gender') == 'Nữ' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="genderNu">Female</label>
                                </div>
                                @error('gender')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label fw-semibold"><i class="fa fa-phone me-2"></i> Personal Phone Number *</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Personal Phone Number" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="company_name" class="form-label fw-semibold"><i class="fa fa-building me-2"></i> Company Name *</label>
                            <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" value="{{ old('company_name') }}" placeholder="Company Name" required>
                            @error('company_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        {{-- OPTIONAL FIELDS --}}
                        <h4 class="mb-4 mt-4">Optional Company Information</h4>
                        
                        <div class="mb-3">
                            <label for="address" class="form-label fw-semibold">Company Address</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" placeholder="Company Address">
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="website" class="form-label fw-semibold">Company Website</label>
                            <input type="url" class="form-control @error('website') is-invalid @enderror" id="website" name="website" value="{{ old('website') }}" placeholder="https://www.company.com">
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary fw-bold py-2" style="background-color: var(--gotto-primary);">
                                REGISTER NOW
                            </button>
                        </div>

                        <p class="text-center mt-4">
                            Already have an account?
                            <a href="{{ route('employer.login') }}" class="text-decoration-none" style="color: var(--gotto-primary);">Login</a>
                            <span class="text-muted"></span>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
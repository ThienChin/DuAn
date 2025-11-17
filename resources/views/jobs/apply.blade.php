@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            {{-- 1. HEADER CÔNG VIỆC --}}
            <div class="card shadow-sm mb-4 border-primary border-3 border-bottom-0 border-end-0 border-start-0" style="background-color: #fff;">
                <div class="card-body p-4">
                    <h1 class="card-title fw-bold text-primary mb-1">
                        <i class="bi bi-briefcase me-2"></i> Apply for: {{ $job->title ?? 'Job Position' }}
                    </h1>
                    <p class="mb-0 text-muted">
                        <i class="bi bi-building me-1"></i> <strong>Company:</strong> {{ $job->company_name ?? 'N/A' }}
                    </p>
                    <p class="mb-0 text-muted">
                        <i class="bi bi-geo-alt me-1" ></i> <strong>Location:</strong> {{ optional($job->locationItem)->value ?? 'N/A' }}
                    </p>
                </div>
            </div>
            
            {{-- 2. APPLICATION FORM CARD --}}
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body p-4 p-md-5">
                    <h3 class="mb-4 fw-semibold text-dark">Submit Your Application</h3>
                    
                    {{-- THÔNG BÁO LỖI/THÀNH CÔNG --}}
                    @if(session('success'))
                        <div class="alert alert-success"><i class="bi bi-check-circle me-2"></i> {{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger"><i class="bi bi-x-octagon me-2"></i> {{ session('error') }}</div>
                    @endif

                    {{-- HIỂN THỊ LỖI VALIDATION --}}
                    @if ($errors->any())
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle me-2"></i> Please check the required fields below.
                        </div>
                    @endif

                    <form action="{{ route('jobs.apply', ['id' => $job->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold">
                                <i class="bi bi-person-fill me-1 text-primary"></i> Full Name *
                            </label>
                            <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Your full name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">
                                <i class="bi bi-envelope-fill me-1 text-primary"></i> Email Address *
                            </label>
                            <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="cv" class="form-label fw-semibold">
                                <i class="bi bi-file-earmark-arrow-up-fill me-1 text-primary"></i> Upload CV (PDF/DOCX) *
                            </label>
                            <input type="file" class="form-control form-control-lg @error('cv') is-invalid @enderror" id="cv" name="cv" accept=".pdf,.doc,.docx" required>
                            <small class="form-text text-muted">Accepted formats: PDF, DOCX. Max size: 2MB.</small>
                            @error('cv')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid mt-5">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold py-3">
                                <i class="bi bi-send-fill me-2"></i> Submit Application
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
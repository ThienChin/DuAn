@extends('layouts.main')
@section('content')
<div class="container section-padding">
    <nav class="nav d-flex justify-content-center mb-5">
        <span class="px-3 py-2">CONTACT</span>
        <span class="px-3 py-2 active">EXPERIENCE</span>
        <span class="px-3 py-2">EDUCATION</span>
        <span class="px-3 py-2">ABOUT</span>
        <span class="px-3 py-2">FINISH IT</span>
    </nav>

    <div class="row">
        <div class="col-lg-8 col-12 mx-auto text-center">
            <h2 class="mb-4">Tell us about your experience</h2>
            <p class="mb-4">Start with your recent job.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-12 mx-auto">
            <form class="custom-form contact-form" action="{{ route('experience.store') }}" method="POST" role="form">
                @csrf

                <!-- Job Title -->
                <div class="form-floating mb-4">
                    <input type="text" name="job_title" id="job_title" class="form-control @error('job_title') is-invalid @enderror" value="{{ old('job_title') }}" placeholder="Software Engineer" required>
                    <label for="job_title">Job Title (Mandatory)</label>
                    @error('job_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Employer -->
                <div class="form-floating mb-4">
                    <input type="text" name="employer" id="employer" class="form-control @error('employer') is-invalid @enderror" value="{{ old('employer') }}" placeholder="FPT Corporation">
                    <label for="employer">Employer</label>
                    @error('employer')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Start Date -->
                <div class="form-floating mb-4">
                    <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}">
                    <label for="start_date">Start Date</label>
                    @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- End Date -->
                <div class="form-floating mb-4">
                    <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date') }}">
                    <label for="end_date">End Date</label>
                    @error('end_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- City -->
                <div class="form-floating mb-4">
                    <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}" placeholder="Ho Chi Minh City">
                    <label for="city">City</label>
                    @error('city')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="form-floating mb-4">
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="Worked as lead developer on several major projects, contributing to the overall success of the company.">{{ old('description') }}</textarea>
                    <label for="description">Description</label>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="button" class="back-btn" onclick="history.back()">← Back</button>
                <button type="submit" class="btn custom-btn">Next to Education →</button>
            </form>
        </div>
    </div>
</div>
@endsection
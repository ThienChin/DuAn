@extends('layouts.main')
@section('content')
<div class="container section-padding">
    <nav class="nav d-flex justify-content-center mb-5">
        <span class="px-3 py-2">CONTACT</span>
        <span class="px-3 py-2">EXPERIENCE</span>
        <span class="px-3 py-2 active">EDUCATION</span>
        <span class="px-3 py-2">ABOUT</span>
        <span class="px-3 py-2">FINISH IT</span>
    </nav>

    <div class="row">
        <div class="col-lg-8 col-12 mx-auto text-center">
            <h2 class="mb-4">Please enter your education information</h2>
            <p class="mb-4">Enter your last diploma first.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-12 mx-auto">
            <form class="custom-form contact-form" action="{{ route('education.store') }}" method="POST" role="form">
                @csrf

                <!-- School -->
                <div class="form-floating mb-4">
                    <input type="text" name="school" id="school" class="form-control @error('school') is-invalid @enderror" value="{{ old('school') }}" placeholder="Vietnam National University">
                    <label for="school">School</label>
                    @error('school')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Degree -->
                <div class="form-floating mb-4">
                    <select name="degree" id="degree" class="form-control @error('degree') is-invalid @enderror">
                        <option value="">Select degree</option>
                        <option value="Bachelor">Bachelor</option>
                        <option value="Master">Master</option>
                        <option value="PhD">PhD</option>
                        <option value="Diploma">Diploma</option>
                    </select>
                    <label for="degree">Degree</label>
                    @error('degree')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Graduation Date -->
                <div class="form-floating mb-4">
                    <input type="date" name="grad_date" id="grad_date" class="form-control @error('grad_date') is-invalid @enderror" value="{{ old('grad_date') }}">
                    <label for="grad_date">Graduation Date</label>
                    @error('grad_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- City -->
                <div class="form-floating mb-4">
                    <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}" placeholder="Hanoi">
                    <label for="city">City</label>
                    @error('city')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="form-floating mb-4">
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="Graduated with a Bachelor of Science in Computer Science, specializing in software development.">{{ old('description') }}</textarea>
                    <label for="description">Description</label>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="button" class="btn custom-btn" onclick="history.back()">← Back</button>
                <button type="submit" class="btn custom-btn">Next to About →</button>
            </form>
        </div>
    </div>
</div>
@endsection
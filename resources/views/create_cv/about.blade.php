@extends('layouts.main')
@section('content')
<div class="container section-padding">
    <nav class="nav d-flex justify-content-center mb-5">
        <span class="px-3 py-2">CONTACT</span>
        <span class="px-3 py-2">EXPERIENCE</span>
        <span class="px-3 py-2">EDUCATION</span>
        <span class="px-3 py-2 active">ABOUT</span>
        <span class="px-3 py-2">FINISH IT</span>
    </nav>

    <div class="row">
        <div class="col-lg-8 col-12 mx-auto text-center">
            <h2 class="mb-4">Write down your professional summary</h2>
            <p class="mb-4">Include up to 3 sentences that describe your general experience.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-12 mx-auto">
            <form class="custom-form contact-form" action="{{ route('about.store') }}" method="POST" role="form">
                @csrf

                <!-- Summary -->
                <div class="form-floating mb-4">
                    <textarea name="summary" id="summary" class="form-control @error('summary') is-invalid @enderror" placeholder="Highly skilled software engineer with over 5 years of experience in leading successful software projects.">{{ old('summary') }}</textarea>
                    <label for="summary">Summary</label>
                    @error('summary')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <!-- Skill Row -->
                <div class="skill-row mb-4">
                    <div class="field">
                        <div class="form-floating">
                            <input type="text" name="skill" id="skill" class="form-control @error('skill') is-invalid @enderror" value="{{ old('skill') }}" placeholder="Type your skill here">
                            <label for="skill">Skill</label>
                            @error('skill')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="field">
                        <div class="form-floating">
                            <select name="level" id="level" class="form-control @error('level') is-invalid @enderror">
                                <option value="Beginner">Beginner</option>
                                <option value="Experienced" selected>Experienced</option>
                                <option value="Expert">Expert</option>
                            </select>
                            <label for="level">Experience Level</label>
                            @error('level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <p class="note mb-4">Use formatting to highlight your strengths. Keep it concise and impactful.</p>
                
                <button type="button" class="back-btn" onclick="history.back()">← Back</button>
                <button type="submit" class="btn custom-btn">Next to Finish It →</button>
                
            </form>
        </div>
    </div>
</div>
@endsection
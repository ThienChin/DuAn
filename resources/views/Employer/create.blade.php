@extends('layouts.employer')

@section('title', 'Post New Job Listing')

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

        {{-- COL 2: MAIN FORM CONTENT --}}
        <div class="col-lg-9">
            <form action="{{ route('employer.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                {{-- Global Error Message --}}
                @if ($errors->any())
                    <div class="alert alert-danger shadow-sm mb-4 fw-semibold">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> Please check the required fields and correct the errors below.
                    </div>
                @endif
                
                {{-- CARD 1: JOB ESSENTIALS --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white p-3">
                        <h4 class="mb-0"><i class="bi bi-info-circle me-2"></i> 1. Essential Job Information</h4>
                    </div>
                    <div class="card-body p-4">
                        
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Job Title:</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="Example: Marketing Specialist, IT Engineer..." required>
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- ROW 1: CATEGORY & LOCATION --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label fw-semibold required">Industry/Category:</label>
                                <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                    <option value="">-- Select Industry --</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="location_id" class="form-label fw-semibold required">Work Location:</label>
                                <select class="form-select @error('location_id') is-invalid @enderror" id="location_id" name="location_id" required>
                                    <option value="">-- Select Location --</option>
                                    @foreach ($locations as $loc)
                                        <option value="{{ $loc->id }}" {{ old('location_id') == $loc->id ? 'selected' : '' }}>
                                            {{ $loc->value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('location_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        {{-- ROW 2: LEVEL & REMOTE TYPE --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="level_id" class="form-label fw-semibold required">Job Level:</label>
                                <select class="form-select @error('level_id') is-invalid @enderror" id="level_id" name="level_id" required>
                                    <option value="">-- Select Level --</option>
                                    @foreach ($levels as $lvl)
                                        <option value="{{ $lvl->id }}" {{ old('level_id') == $lvl->id ? 'selected' : '' }}>
                                            {{ $lvl->value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('level_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="remote_type_id" class="form-label fw-semibold required">Employment Type:</label>
                                <select class="form-select @error('remote_type_id') is-invalid @enderror" id="remote_type_id" name="remote_type_id" required>
                                    <option value="">-- Select Type --</option>
                                    @foreach ($remote_types as $rt)
                                        <option value="{{ $rt->id }}" {{ old('remote_type_id') == $rt->id ? 'selected' : '' }}>
                                            {{ $rt->value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('remote_type_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        {{-- ROW 3: SALARY & REMOTE CHECKBOX --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="salary" class="form-label fw-semibold">Salary (VND):</label>
                                <input type="number" class="form-control @error('salary') is-invalid @enderror" id="salary" name="salary" value="{{ old('salary') }}" placeholder="E.g.: 10000000 (Leave blank if negotiable)">
                                @error('salary') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3 d-flex align-items-end">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="remote_job" name="remote" {{ old('remote') ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="remote_job">
                                        Allow Remote Work
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold required">Job Description:</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="7" required placeholder="Outline responsibilities, duties, and mission of the job..." style="resize: none;">{{ old('description') }}</textarea>
                            {{-- ✨ ĐÃ THÊM style="resize: none;" --}}
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                {{-- CARD 2: REQUIREMENTS (OPTIONAL) --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-secondary text-white p-3">
                        <h4 class="mb-0"><i class="bi bi-person-check-fill me-2"></i> 2. Candidate Requirements (Optional)</h4>
                    </div>
                    <div class="card-body p-4">
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="experience_id" class="form-label fw-semibold">Experience:</label>
                                <select class="form-select @error('experience_id') is-invalid @enderror" id="experience_id" name="experience_id">
                                    <option value="">-- No requirement / Select --</option>
                                    @foreach ($experiences as $exp)
                                        <option value="{{ $exp->id }}" {{ old('experience_id') == $exp->id ? 'selected' : '' }}>
                                            {{ $exp->value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('experience_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="degree_id" class="form-label fw-semibold">Degree:</label>
                                <select class="form-select @error('degree_id') is-invalid @enderror" id="degree_id" name="degree_id">
                                    <option value="">-- No requirement / Select --</option>
                                    @foreach ($degrees as $deg)
                                        <option value="{{ $deg->id }}" {{ old('degree_id') == $deg->id ? 'selected' : '' }}>
                                            {{ $deg->value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('degree_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="gender_id" class="form-label fw-semibold">Gender:</label>
                                <select class="form-select @error('gender_id') is-invalid @enderror" id="gender_id" name="gender_id">
                                    <option value="">-- No requirement / Select --</option>
                                    @foreach ($genders as $gen)
                                        <option value="{{ $gen->id }}" {{ old('gender_id') == $gen->id ? 'selected' : '' }}>
                                            {{ $gen->value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('gender_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="age" class="form-label fw-semibold">Age:</label>
                                <input type="text" class="form-control @error('age') is-invalid @enderror" id="age" name="age" value="{{ old('age') }}" placeholder="Example: 22-30 years old">
                                @error('age') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="required_skills" class="form-label fw-semibold">Required Skills:</label>
                            <textarea class="form-control @error('required_skills') is-invalid @enderror" id="required_skills" name="required_skills" rows="3" placeholder="List necessary skills (e.g., Python, SEO, Leadership)" style="resize: none;">{{ old('required_skills') }}</textarea>
                            {{-- ✨ ĐÃ THÊM style="resize: none;" --}}
                            @error('required_skills') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
                
                {{-- CARD 3: COMPANY INFO & FILES --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-info text-white p-3">
                        <h4 class="mb-0"><i class="bi bi-building-fill me-2"></i> 3. Company & Contact Information</h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label for="company_name" class="form-label fw-semibold required">Company Name:</label>
                            <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" value="{{ old('company_name') }}" required>
                            @error('company_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="company_description" class="form-label fw-semibold">Company Description:</label>
                            <textarea class="form-control @error('company_description') is-invalid @enderror" id="company_description" name="company_description" rows="3" style="resize: none;">{{ old('company_description') }}</textarea>
                            {{-- ✨ ĐÃ THÊM style="resize: none;" --}}
                            @error('company_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        {{-- CONTACT DETAILS --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label fw-semibold required">Contact Email:</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required placeholder="contact@company.com">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label fw-semibold">Contact Phone:</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="090...">
                                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="website" class="form-label fw-semibold">Company Website:</label>
                            <input type="url" class="form-control @error('website') is-invalid @enderror" id="website" name="website" value="{{ old('website') }}" placeholder="https://company.com">
                            @error('website') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- FILE UPLOAD --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="company_logo_url" class="form-label fw-semibold">Company Logo (File):</label>
                                <input type="file" class="form-control @error('company_logo_url') is-invalid @enderror" id="company_logo_url" name="company_logo_url" accept="image/*">
                                @error('company_logo_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="jobs_images" class="form-label fw-semibold">Job Image/Banner (File):</label>
                                <input type="file" class="form-control @error('jobs_images') is-invalid @enderror" id="jobs_images" name="jobs_images" accept="image/*">
                                @error('jobs_images') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SUBMIT BUTTONS --}}
                <div class="d-flex justify-content-end gap-3 mb-5 px-3">
                    <a href="{{ route('employer.dashboard') }}" class="btn btn-secondary px-5">CANCEL</a>
                    <button type="submit" class="btn btn-success px-5 fw-bold">POST JOB</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@extends('layouts.main')

@section('content')
    <main>
        <header class="site-header">
            <div class="section-overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12 text-center">
                        <h1 class="text-white">Job Listings</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
<<<<<<< HEAD
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Job listings</li>
=======
                                <li class="breadcrumb-item"><a href="{{ route('page.index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Job Listings</li>
>>>>>>> main
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </header>

        <section class="section-padding pb-0 d-flex justify-content-center align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <form class="custom-form hero-form" action="{{ route('jobs.index') }}" method="get" role="form">
                            <h3 class="text-white mb-3">Search your dream job</h3>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="bi-person custom-icon"></i></span>
<<<<<<< HEAD
                                        <input type="text" name="keyword" id="job-title" class="form-control" placeholder="Job Title" value="{{ request('keyword') }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="bi-geo-alt custom-icon"></i></span>
                                        <input type="text" name="location" id="job-location" class="form-control" placeholder="Location" value="{{ request('location') }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="bi-cash custom-icon"></i></span>
                                        <select class="form-select form-control" name="salary" id="job-salary" aria-label="Default select example">
                                            <option value="" selected>Salary Range (VNĐ)</option>
                                            <option value="3000000-5000000" {{ request('salary') == '3000000-5000000' ? 'selected' : '' }}>3M - 5M</option>
                                            <option value="10000000-45000000" {{ request('salary') == '10000000-45000000' ? 'selected' : '' }}>10M - 45M</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="bi-laptop custom-icon"></i></span>
                                        <select class="form-select form-control" name="level" id="job-level" aria-label="Default select example">
                                            <option value="" selected>Level</option>
                                            <option value="Internship" {{ request('level') == 'Internship' ? 'selected' : '' }}>Internship</option>
                                            <option value="Junior" {{ request('level') == 'Junior' ? 'selected' : '' }}>Junior</option>
                                            <option value="Senior" {{ request('level') == 'Senior' ? 'selected' : '' }}>Senior</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="bi-laptop custom-icon"></i></span>
                                        <select class="form-select form-control" name="remote" id="job-remote" aria-label="Default select example">
                                            <option value="" selected>Remote</option>
                                            <option value="Full Time" {{ request('remote') == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                                            <option value="Contract" {{ request('remote') == 'Contract' ? 'selected' : '' }}>Contract</option>
                                            <option value="Part Time" {{ request('remote') == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12">
                                    <button type="submit" class="form-control btn btn-primary">Search job</button>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex flex-wrap align-items-center mt-4 mt-lg-0">
                                        <span class="text-white mb-lg-0 mb-md-0 me-2">Popular keywords:</span>
                                        <div>
                                            <a href="{{ route('jobs.index') }}?keyword=Web" class="badge bg-info text-white">Web</a>
                                            <a href="{{ route('jobs.index') }}?keyword=Marketing" class="badge bg-info text-white">Marketing</a>
                                            <a href="{{ route('jobs.index') }}?keyword=Design" class="badge bg-info text-white">Design</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 col-12">
                        <img src="{{ asset('images/4557388.png') }}" class="hero-image img-fluid" alt="">
                    </div>
                </div>
            </div>
        </section>

        <section class="job-section section-padding">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-12 mb-lg-4">
                        <h3>Results of {{ $jobs->firstItem() }}-{{ $jobs->lastItem() }} of {{ $jobs->total() }} jobs</h3>
                    </div>
                    <div class="col-lg-4 col-12 d-flex align-items-center ms-auto mb-5 mb-lg-4">
                        <p class="mb-0 ms-lg-auto">Sort by:</p>
                        <div class="dropdown dropdown-sorting ms-3 me-4">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownSortingButton" data-bs-toggle="dropdown" aria-expanded="false">
                                Newest Jobs
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownSortingButton">
                                <li><a class="dropdown-item" href="{{ route('jobs.index') }}?sort=latest">Latest Jobs</a></li>
                                <li><a class="dropdown-item" href="{{ route('jobs.index') }}?sort=salary">Highest Salary</a></li>
                                <li><a class="dropdown-item" href="{{ route('jobs.index') }}?sort=internship">Internship Jobs</a></li>
                            </ul>
                        </div>
                        <div class="d-flex">
                            <a href="#" class="sorting-icon active bi-list me-2"></a>
                            <a href="#" class="sorting-icon bi-grid"></a>
                        </div>
                    </div>
                    <div class="row">
                        @forelse ($jobs as $job)
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="job-thumb job-thumb-box">
                                    <div class="job-image-box-wrap">
                                        <a href="{{ route('jobs.show', $job->id) }}">
                                            <img src="{{ asset('images/jobs/default.jpg') }}" class="job-image img-fluid" alt="{{ $job->title }}">
                                        </a>
                                        <div class="job-image-box-wrap-info d-flex align-items-center">
                                            <p class="mb-0">
                                                <a href="{{ route('jobs.index') }}?level={{ $job->category }}" class="badge badge-level">{{ $job->category }}</a>
                                            </p>
                                            <p class="mb-0">
                                                <a href="#" class="badge bg-secondary">Full Time</a> <!-- Placeholder, thay bằng remote nếu có -->
                                            </p>
                                        </div>
                                    </div>
                                    <div class="job-body">
                                        <h4 class="job-title">
                                            <a href="{{ route('jobs.show', $job->id) }}" class="job-title-link">{{ $job->title }}</a>
                                        </h4>
                                        <div class="d-flex align-items-center">
                                            <div class="job-image-wrap d-flex align-items-center bg-white shadow-lg mt-2 mb-4">
                                                <img src="{{ asset('images/logos/default.png') }}" class="job-image me-3 img-fluid" alt="">
                                                <p class="mb-0">Unknown Company</p>
                                            </div>
                                            <a href="#" class="bi-bookmark ms-auto me-2"></a>
                                            <a href="#" class="bi-heart"></a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <p class="job-location">
                                                <i class="custom-icon bi-geo-alt me-1"></i>
                                                {{ $job->location }}
                                            </p>
                                            <p class="job-date">
                                                <i class="custom-icon bi-clock me-1"></i>
                                                {{ \Carbon\Carbon::parse($job->posted_at)->diffForHumans() }}
                                            </p>
                                        </div>
                                        <div class="d-flex align-items-center border-top pt-3">
                                            <p class="job-price mb-0">
                                                <i class="custom-icon bi-cash me-1"></i>
                                                {{ number_format($job->salary, 0, ',', '.') }} VNĐ
                                            </p>
                                            <a href="{{ route('jobs.show', $job->id) }}" class="custom-btn btn ms-auto">Apply now</a>
=======
                                        <input type="text" name="job-title" id="job-title" class="form-control" placeholder="Job Title" value="{{ request('job-title') }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="bi-geo-alt custom-icon"></i></span>
                                        <input type="text" name="job-location" id="job-location" class="form-control" placeholder="Location" value="{{ request('job-location') }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="bi-cash custom-icon"></i></span>
                                        <select class="form-select form-control" name="job-salary" id="job-salary" aria-label="Default select example">
                                            <option value="">Salary Range</option>
                                            <option value="1" {{ request('job-salary') == '1' ? 'selected' : '' }}>3M - 8M VND</option>
                                            <option value="2" {{ request('job-salary') == '2' ? 'selected' : '' }}>10M - 45M VND</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="bi-laptop custom-icon"></i></span>
                                        <select class="form-select form-control" name="job-level" id="job-level" aria-label="Default select example">
                                            <option value="">Level</option>
                                            <option value="1" {{ request('job-level') == '1' ? 'selected' : '' }}>Internship</option>
                                            <option value="2" {{ request('job-level') == '2' ? 'selected' : '' }}>Junior</option>
                                            <option value="3" {{ request('job-level') == '3' ? 'selected' : '' }}>Senior</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="bi-laptop custom-icon"></i></span>
                                        <select class="form-select form-control" name="job-remote" id="job-remote" aria-label="Default select example">
                                            <option value="">Remote</option>
                                            <option value="1" {{ request('job-remote') == '1' ? 'selected' : '' }}>Full Time</option>
                                            <option value="2" {{ request('job-remote') == '2' ? 'selected' : '' }}>Contract</option>
                                            <option value="3" {{ request('job-remote') == '3' ? 'selected' : '' }}>Part Time</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12">
                                    <button type="submit" class="form-control">Search job</button>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex flex-wrap align-items-center mt-4 mt-lg-0">
                                        <span class="text-white mb-lg-0 mb-md-0 me-2">Popular keywords:</span>
                                        <div>
                                            <a href="{{ route('jobs.index') }}?job-title=Web+design" class="badge">Web design</a>
                                            <a href="{{ route('jobs.index') }}?job-title=Marketing" class="badge">Marketing</a>
                                            <a href="{{ route('jobs.index') }}?job-title=Customer+support" class="badge">Customer support</a>
>>>>>>> main
                                        </div>
                                    </div>
                                </div>
                            </div>
<<<<<<< HEAD
                        @empty
                            <p class="text-center">Không có công việc nào.</p>
                        @endforelse
                    </div>
                    <div class="col-lg-12 col-12">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center mt-5">
                                {{ $jobs->appends(request()->except('page'))->links() }}
                            </ul>
                        </nav>
=======
                        </form>
                    </div>
                    <div class="col-lg-6 col-12">
                        <img src="{{ asset('page/images/4557388.png') }}" class="hero-image img-fluid" alt="">
>>>>>>> main
                    </div>
                </div>
            </div>
        </section>

<<<<<<< HEAD
        <section class="cta-section">
            <div class="section-overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-10">
                        <h2 class="text-white mb-2">Over 10k opening jobs</h2>
                        <p class="text-white">Gotto Job is a free HTML CSS template for job hunting related websites. This layout is based on the famous Bootstrap 5 CSS framework. Thank you for visiting Tooplate website.</p>
                    </div>
                    <div class="col-lg-4 col-12 ms-auto">
                        <div class="custom-border-btn-wrap d-flex align-items-center mt-lg-4 mt-2">
                            <a href="{{ route('register') }}" class="custom-btn custom-border-btn btn me-4">Create an account</a>
                            <a href="#" class="custom-link">Post a job</a>
                        </div>
=======
        <section class="job-section section-padding">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-12 mb-lg-4">
                        <h3>Results of {{ $jobs->firstItem() }}-{{ $jobs->lastItem() }} of {{ $jobs->total() }} jobs</h3>
                    </div>
                    <div class="col-lg-4 col-12 d-flex align-items-center ms-auto mb-5 mb-lg-4">
                        <p class="mb-0 ms-lg-auto">Sort by:</p>
                        <div class="dropdown dropdown-sorting ms-3 me-4">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownSortingButton" data-bs-toggle="dropdown" aria-expanded="false">
                                Newest Jobs
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownSortingButton">
                                <li><a class="dropdown-item" href="{{ route('jobs.index') }}?sort=latest">Latest Jobs</a></li>
                                <li><a class="dropdown-item" href="{{ route('jobs.index') }}?sort=highest_salary">Highest Salary Jobs</a></li>
                                <li><a class="dropdown-item" href="{{ route('jobs.index') }}?job-level=1">Internship Jobs</a></li>
                            </ul>
                        </div>
                        <div class="d-flex">
                            <a href="#" class="sorting-icon active bi-list me-2"></a>
                            <a href="#" class="sorting-icon bi-grid"></a>
                        </div>
                    </div>
                    @foreach ($jobs as $job)
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="job-thumb job-thumb-box">
                                <div class="job-image-box-wrap">
                                    <a href="{{ route('jobs.show', $job->id) }}">
                                        <img src="{{ asset('page/images/jobs/it-professional-works-startup-project.jpg') }}" class="job-image img-fluid" alt="">
                                    </a>
                                    <div class="job-image-box-wrap-info d-flex align-items-center">
                                        <p class="mb-0">
                                            <a href="{{ route('jobs.index') }}?job-level={{ $job->level === 'Internship' ? 1 : ($job->level === 'Junior' ? 2 : 3) }}" class="badge badge-level">{{ $job->level }}</a>
                                        </p>
                                        <p class="mb-0">
                                            <a href="{{ route('jobs.index') }}?job-remote={{ $job->remote_type === 'Full Time' ? 1 : ($job->remote_type === 'Contract' ? 2 : 3) }}" class="badge">{{ $job->remote_type }}</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="job-body">
                                    <h4 class="job-title">
                                        <a href="{{ route('jobs.show', $job->id) }}" class="job-title-link">{{ $job->title }}</a>
                                    </h4>
                                    <div class="d-flex align-items-center">
                                        <div class="job-image-wrap d-flex align-items-center bg-white shadow-lg mt-2 mb-4">
                                            <img src="{{ asset('page/images/logos/google.png') }}" class="job-image me-3 img-fluid" alt="">
                                            <p class="mb-0">{{ $job->company_name ?? 'Unknown Company' }}</p>
                                        </div>
                                        <a href="#" class="bi-bookmark ms-auto me-2"></a>
                                        <a href="#" class="bi-heart"></a>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <p class="job-location">
                                            <i class="custom-icon bi-geo-alt me-1"></i>
                                            {{ $job->location }}
                                        </p>
                                        <p class="job-date">
                                            <i class="custom-icon bi-clock me-1"></i>
                                            {{ $job->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-center border-top pt-3">
                                        <p class="job-price mb-0">
                                            <i class="custom-icon bi-cash me-1"></i>
                                            {{ number_format($job->salary, 0) }} VND
                                        </p>
                                        <a href="{{ route('jobs.show', $job->id) }}" class="custom-btn btn ms-auto">Apply now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-lg-12 col-12">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center mt-5">
                                {{ $jobs->links() }}
                            </ul>
                        </nav>
>>>>>>> main
                    </div>
                </div>
            </div>
        </section>
<<<<<<< HEAD
    </main>
@endsection

@push('styles')
    <style>
        .job-thumb-box { border: none; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .job-image { height: 200px; object-fit: cover; }
        .badge { background-color: #28a745; color: white; margin-right: 5px; }
        .badge-level { background-color: #17a2b8; }
        .custom-btn { background-color: #ff4500; color: white; }
        .custom-btn:hover { background-color: #e03a00; }
        .hero-form .form-control { background-color: #fff; }
        .badge.bg-info { background-color: #17a2b8; }
        .badge.bg-secondary { background-color: #6c757d; }
    </style>
@endpush
=======

        <section class="cta-section">
            <div class="section-overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-10">
                        <h2 class="text-white mb-2">Over 10k opening jobs</h2>
                        <p class="text-white">Gotto Job is a free HTML CSS template for job hunting related websites. This layout is based on the famous Bootstrap 5 CSS framework. Thank you for visiting Tooplate website.</p>
                    </div>
                    <div class="col-lg-4 col-12 ms-auto">
                        <div class="custom-border-btn-wrap d-flex align-items-center mt-lg-4 mt-2">
                            <a href="{{ route('register') }}" class="custom-btn custom-border-btn btn me-4">Create an account</a>
                            <a href="{{ route('jobs.create') }}" class="custom-link">Post a job</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
>>>>>>> main

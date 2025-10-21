@extends('layouts.main')
@section('content')
    <main>
        <header class="site-header">
            <div class="section-overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12 text-center">
                        <h1 class="text-white">{{ $job->title }}</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="{{ route('page.index') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('jobs.index') }}">Job Listings</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $job->title }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </header>

        <section class="job-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <div class="job-thumb job-thumb-box">
                            <div class="job-image-box-wrap">
                                <img src="{{ asset('page/images/jobs/it-professional-works-startup-project.jpg') }}" class="job-image img-fluid" alt="{{ $job->title }}">
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
                                    <span class="job-title-link">{{ $job->title }}</span>
                                </h4>
                                <div class="d-flex align-items-center">
                                    <div class="job-image-wrap d-flex align-items-center bg-white shadow-lg mt-2 mb-4">
                                        <img src="{{ asset('page/images/logos/google.png') }}" class="job-image me-3 img-fluid" alt="">
                                        <p class="mb-0">{{ $job->company_name ?? 'Unknown Company' }}</p>
                                    </div>
                                    <a href="#" class="bi-bookmark ms-auto me-2"></a>
                                    <a href="#" class="bi-heart"></a>
                                </div>
                                <div class="job-details">
                                    <h5>Job Description</h5>
                                    <p>{{ $job->description ?? 'No description available' }}</p>

                                    <h5>Job Details</h5>
                                    <ul class="list-unstyled">
                                        <li><strong>Location:</strong> {{ $job->location }}</li>
                                        <li><strong>Salary:</strong> {{ number_format($job->salary, 0) }} VND</li>
                                        <li><strong>Level:</strong> {{ $job->level }}</li>
                                        <li><strong>Remote Type:</strong> {{ $job->remote_type }}</li>
                                        <li><strong>Category:</strong> {{ $job->category ?? 'N/A' }}</li>
                                        <li><strong>Posted At:</strong> {{ $job->posted_at ? $job->posted_at->format('Y-m-d') : 'N/A' }}</li>
                                        <li><strong>Featured:</strong> {{ $job->is_featured ? 'Yes' : 'No' }}</li>
                                        <li><strong>Remote:</strong> {{ $job->remote ? 'Yes' : 'No' }}</li>
                                    </ul>

                                    <h5>Company Information</h5>
                                    <ul class="list-unstyled">
                                        <li><strong>Company Name:</strong> {{ $job->company_name }}</li>
                                        <li><strong>Description:</strong> {{ $job->company_description ?? 'No description available' }}</li>
                                        <li><strong>Website:</strong> <a href="{{ $job->website }}" target="_blank">{{ $job->website ?? 'N/A' }}</a></li>
                                        <li><strong>Phone:</strong> {{ $job->phone ?? 'N/A' }}</li>
                                        <li><strong>Email:</strong> <a href="mailto:{{ $job->email }}">{{ $job->email ?? 'N/A' }}</a></li>
                                    </ul>

                                    @if (Auth::check() && (Auth::user()->hasRole('employer') || Auth::user()->hasRole('admin') || $job->company_name === Auth::user()->name))
                                        <a href="{{ route('jobs.edit', $job->id) }}" class="custom-btn btn mt-4">Edit Job</a>
                                        <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" style="display:inline-block; margin-left: 10px;" onsubmit="return confirm('Are you sure you want to delete this job?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="custom-btn btn btn-danger">Delete Job</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="job-sidebar">
                            <h5>Apply Now</h5>
                            <p>Interested in this job? Click the button below to apply.</p>
                            <a href="#" class="custom-btn btn w-100 mb-3">Apply Now</a>

                            <h5>Share This Job</h5>
                            <div class="social-share">
                                <a href="#" class="bi-facebook"></a>
                                <a href="#" class="bi-twitter"></a>
                                <a href="#" class="bi-linkedin"></a>
                                <a href="#" class="bi-envelope"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section class="job-section section-padding">
                <div class="container">
                    <div class="row align-items-center">

                        <div class="col-lg-6 col-12 mb-lg-4">
                            <h3>Similar Jobs</h3>

                            <p><strong>Over 10k opening jobs</strong> Lorem Ipsum dolor sit amet, consectetur adipsicing kengan omeg kohm tokito adipcingi elit eismuod larehai</p>
                        </div>

                        <div class="col-lg-4 col-12 d-flex ms-auto mb-5 mb-lg-4">
                            <a href="job-listings.html" class="custom-btn custom-border-btn btn ms-lg-auto">Browse Job Listings</a>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="job-thumb job-thumb-box">
                                <div class="job-image-box-wrap">
                                    <a href="job-details.html">
                                        <img src="images/jobs/it-professional-works-startup-project.jpg" class="job-image img-fluid" alt="">
                                    </a>

                                    <div class="job-image-box-wrap-info d-flex align-items-center">
                                        <p class="mb-0">
                                            <a href="job-listings.html" class="badge badge-level">Internship</a>
                                        </p>

                                        <p class="mb-0">
                                            <a href="job-listings.html" class="badge">Freelance</a>
                                        </p>
                                    </div>
                                </div>

                                <div class="job-body">
                                    <h4 class="job-title">
                                        <a href="job-details.html" class="job-title-link">Technical Lead</a>
                                    </h4>

                                    <div class="d-flex align-items-center">
                                        <div class="job-image-wrap d-flex align-items-center bg-white shadow-lg mt-2 mb-4">
                                            <img src="images/logos/salesforce.png" class="job-image me-3 img-fluid" alt="">

                                            <p class="mb-0">Salesforce</p>
                                        </div>

                                        <a href="#" class="bi-bookmark ms-auto me-2">
                                        </a>

                                        <a href="#" class="bi-heart">
                                        </a>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <p class="job-location">
                                            <i class="custom-icon bi-geo-alt me-1"></i>
                                            Kuala, Malaysia
                                        </p>

                                        <p class="job-date">
                                            <i class="custom-icon bi-clock me-1"></i>
                                            10 hours ago
                                        </p>
                                    </div>

                                    <div class="d-flex align-items-center border-top pt-3">
                                        <p class="job-price mb-0">
                                            <i class="custom-icon bi-cash me-1"></i>
                                            $50k
                                        </p>

                                        <a href="job-details.html" class="custom-btn btn ms-auto">Apply now</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="job-thumb job-thumb-box">
                                <div class="job-image-box-wrap">
                                    <a href="job-details.html">
                                        <img src="images/jobs/marketing-assistant.jpg" class="job-image img-fluid" alt="marketing assistant">
                                    </a>

                                    <div class="job-image-box-wrap-info d-flex align-items-center">
                                        <p class="mb-0">
                                            <a href="job-listings.html" class="badge badge-level">Senior</a>
                                        </p>

                                        <p class="mb-0">
                                            <a href="job-listings.html" class="badge">Part Time</a>
                                        </p>
                                    </div>
                                </div>

                                <div class="job-body">
                                    <h4 class="job-title">
                                        <a href="job-details.html" class="job-title-link">Marketing Assistant</a>
                                    </h4>

                                    <div class="d-flex align-items-center">
                                        <div class="job-image-wrap d-flex align-items-center bg-white shadow-lg mt-2 mb-4">
                                            <img src="images/logos/spotify.png" class="job-image me-3 img-fluid" alt="">

                                            <p class="mb-0">Spotify</p>
                                        </div>

                                        <a href="#" class="bi-bookmark ms-auto me-2">
                                        </a>

                                        <a href="#" class="bi-heart">
                                        </a>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <p class="job-location">
                                            <i class="custom-icon bi-geo-alt me-1"></i>
                                            California, USA
                                        </p>

                                        <p class="job-date">
                                            <i class="custom-icon bi-clock me-1"></i>
                                            8 days ago
                                        </p>
                                    </div>

                                    <div class="d-flex align-items-center border-top pt-3">
                                        <p class="job-price mb-0">
                                            <i class="custom-icon bi-cash me-1"></i>
                                            $20k
                                        </p>

                                        <a href="job-details.html" class="custom-btn btn ms-auto">Apply now</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="job-thumb job-thumb-box">
                                <div class="job-image-box-wrap">
                                    <a href="job-details.html">
                                        <img src="images/jobs/coding-man.jpg" class="job-image img-fluid" alt="">
                                    </a>

                                    <div class="job-image-box-wrap-info d-flex align-items-center">
                                        <p class="mb-0">
                                            <a href="job-listings.html" class="badge badge-level">Junior</a>
                                        </p>

                                        <p class="mb-0">
                                            <a href="job-listings.html" class="badge">Contract</a>
                                        </p>
                                    </div>
                                </div>

                                <div class="job-body">
                                    <h4 class="job-title">
                                        <a href="job-details.html" class="job-title-link">Programmer</a>
                                    </h4>
                                        
                                    <div class="d-flex align-items-center">
                                        <div class="job-image-wrap d-flex align-items-center bg-white shadow-lg mt-2 mb-4">
                                            <img src="images/logos/twitter.png" class="job-image me-3 img-fluid" alt="">

                                            <p class="mb-0">Twiter</p>
                                        </div>

                                        <a href="#" class="bi-bookmark ms-auto me-2">
                                        </a>

                                        <a href="#" class="bi-heart">
                                        </a>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <p class="job-location">
                                            <i class="custom-icon bi-geo-alt me-1"></i>
                                            California, USA
                                        </p>

                                        <p class="job-date">
                                            <i class="custom-icon bi-clock me-1"></i>
                                            23 hours ago
                                        </p>
                                    </div>

                                    <div class="d-flex align-items-center border-top pt-3">
                                        <p class="job-price mb-0">
                                            <i class="custom-icon bi-cash me-1"></i>
                                            $68k
                                        </p>

                                        <a href="job-details.html" class="custom-btn btn ms-auto">Apply now</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>


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
                                <a href="#" class="custom-btn custom-border-btn btn me-4">Create an account</a>

                                <a href="#" class="custom-link">Post a job</a>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </main>
@endsection
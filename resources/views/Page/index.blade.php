@extends('layouts.main')
@section('content')

        <main>

            <section class="hero-section d-flex justify-content-center align-items-center">
                <div class="section-overlay"></div>

                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-12 mb-5 mb-lg-0">
                            <div class="hero-section-text mt-5">
                                <h6 class="text-white">Are you looking for your dream job?</h6>

                                <h1 class="hero-title text-white mt-4 mb-4">Online Platform. <br> Best Job portal</h1>

                                <a href="#categories-section" class="custom-btn custom-border-btn btn">Browse Categories</a>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <form class="custom-form hero-form" action="{{ route('jobs.list') }}" method="get" role="form">
                                <h3 class="text-white mb-3">Search your dream job</h3>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="bi-person custom-icon"></i></span>

                                            <input type="text" name="job-title" id="job-title" class="form-control" placeholder="Job Title" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon2"><i class="bi-geo-alt custom-icon"></i></span>

                                            <input type="text" name="job-location" id="job-location" class="form-control" placeholder="Location" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <button type="submit" class="form-control">
                                            Find a job
                                        </button>
                                    </div>

                                    <div class="col-12">
                                        <div class="d-flex flex-wrap align-items-center mt-4 mt-lg-0">
                                            <span class="text-white mb-lg-0 mb-md-0 me-2">Popular keywords:</span>

                                            <div>
                                                <a href="job-listings.html" class="badge">Web design</a>

                                                <a href="job-listings.html" class="badge">Marketing</a>

                                                <a href="job-listings.html" class="badge">Customer support</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </section>


            <!-- <section class="categories-section section-padding" id="categories-section">
                <div class="container">
                    <div class="row justify-content-center align-items-center">

                        <div class="col-lg-12 col-12 text-center">
                            <h2 class="mb-5">Browse by <span>Categories</span></h2>
                        </div>

                        <div class="col-lg-2 col-md-4 col-6">
                            <div class="categories-block">
                                <a href="#" class="d-flex flex-column justify-content-center align-items-center h-100">
                                    <i class="categories-icon bi-window"></i>
                                
                                    <small class="categories-block-title">Web design</small>

                                    <div class="categories-block-number d-flex flex-column justify-content-center align-items-center">
                                        <span class="categories-block-number-text">320</span>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-4 col-6">
                            <div class="categories-block">
                                <a href="#" class="d-flex flex-column justify-content-center align-items-center h-100">
                                    <i class="categories-icon bi-twitch"></i>
                                
                                    <small class="categories-block-title">Marketing</small>

                                    <div class="categories-block-number d-flex flex-column justify-content-center align-items-center">
                                        <span class="categories-block-number-text">180</span>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-4 col-6">
                            <div class="categories-block">
                                <a href="#" class="d-flex flex-column justify-content-center align-items-center h-100">
                                    <i class="categories-icon bi-play-circle-fill"></i>
                                
                                    <small class="categories-block-title">Video</small>

                                    <div class="categories-block-number d-flex flex-column justify-content-center align-items-center">
                                        <span class="categories-block-number-text">340</span>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-4 col-6">
                            <div class="categories-block">
                                <a href="#" class="d-flex flex-column justify-content-center align-items-center h-100">
                                    <i class="categories-icon bi-globe"></i>
                                
                                    <small class="categories-block-title">Websites</small>

                                    <div class="categories-block-number d-flex flex-column justify-content-center align-items-center">
                                        <span class="categories-block-number-text">140</span>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-4 col-6">
                            <div class="categories-block">
                                <a href="#" class="d-flex flex-column justify-content-center align-items-center h-100">
                                    <i class="categories-icon bi-people"></i>
                                
                                    <small class="categories-block-title">Customer Support</small>

                                    <div class="categories-block-number d-flex flex-column justify-content-center align-items-center">
                                        <span class="categories-block-number-text">84</span>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
 -->

                <section class="about-section">
                    <div class="container">
                        <div class="row">

                            <div class="col-lg-3 col-12">
                                <div class="about-image-wrap custom-border-radius-start">
                                    <img src="{{ asset('page/images/professional-asian-businesswoman-gray-blazer.jpg') }}" class="about-image custom-border-radius-start img-fluid" alt="">

                                    <div class="about-info">
                                        <h4 class="text-white mb-0 me-2">Julia Ward</h4>

                                        <p class="text-white mb-0">Investor</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="custom-text-block">
                                    <h2 class="text-white mb-2">Introduction Gotto</h2>

                                    <p class="text-white">Gotto Job is a free aplication form for job portals. This layout is based on Bootstrap 5 CSS framework. Thank you for visiting <a href="https://www.tooplate.com" target="_parent">Tooplate website</a>. Images are from <a href="https://www.freepik.com/" target="_blank">FreePik</a> website.</p>

                                    <div class="custom-border-btn-wrap d-flex align-items-center mt-5">
                                        <a href="about.html" class="custom-btn custom-border-btn btn me-4">Get to know us</a>

                                        <a href="#job-section" class="custom-link smoothscroll">Explore Jobs</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-12">
                                <div class="instagram-block">
                                    <img src="{{ asset('images/horizontal-shot-happy-mixed-race-females.jpg') }}" class="about-image custom-border-radius-end img-fluid" alt="">

                                    <div class="instagram-block-text">
                                        <a href="https://instagram.com/" class="custom-btn btn">
                                            <i class="bi-instagram"></i>
                                            @Gotto
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>


            <section class="featured-jobs-section section-padding">
                <div class="container">

                </div>
            </section>


            <section>
                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-12">
                            <div class="custom-text-block custom-border-radius-start">
                                <h2 class="text-white mb-3">Gotto helps you an easier way to get new job</h2>

                                <p class="text-white">You are not allowed to redistribute the template ZIP file on any other template collection website. Please contact us for more info. Thank you.</p>

                                <div class="d-flex mt-4">
                                    <div class="counter-thumb"> 
                                        <div class="d-flex">
                                            <span class="counter-number" data-from="1" data-to="12" data-speed="1000"></span>
                                            <span class="counter-number-text">M</span>
                                        </div>

                                        <span class="counter-text">Daily active users</span>
                                    </div> 

                                    <div class="counter-thumb">    
                                        <div class="d-flex">
                                            <span class="counter-number" data-from="1" data-to="450" data-speed="1000"></span>
                                            <span class="counter-number-text">k</span>
                                        </div>

                                        <span class="counter-text">Opening jobs</span>
                                    </div> 
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="video-thumb">
                                <img src="{{ asset('page/images/people-working-as-team-company.jpg') }}" class="about-image custom-border-radius-end img-fluid" alt="">

                                <div class="video-info">
                                    <a href="https://www.youtube.com/tooplate" class="youtube-icon bi-youtube"></a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>


        <section class="job-section recent-jobs-section section-padding">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-6 col-12 mb-4">
                    <h2>Recent Jobs</h2>

                    <p><strong>Over 10k opening jobs</strong> If you are looking for free job aplication form, you may visit Gotto website. If you need a list of corporate companies, you can visit Gotto Job Listings website.</p>
                </div>

                <div class="clearfix"></div>

                {{-- BẮT ĐẦU VÒNG LẶP CHO DANH SÁCH CÔNG VIỆC MỚI NHẤT --}}
                    {{-- THẺ CÔNG VIỆC CHÍNH (Áp dụng Fix Chiều Cao & Ảnh) --}}
                    {{-- Đảm bảo row có align-items-stretch --}}
                    <div class="row align-items-center align-items-stretch">
                    @foreach ($recentJobs as $job)
                        {{-- THAY ĐỔI COL: Thêm d-flex để buộc cột giãn ra hết chiều cao --}}
                        <div class="col-lg-4 col-md-6 col-12 d-flex mb-4"> 
                            {{-- THAY ĐỔI THẺ CHÍNH: Thêm h-100 và d-flex flex-column --}}
                            <div class="job-thumb job-thumb-box h-100 d-flex flex-column">
                                
                                {{-- THAY ĐỔI: Thêm style cho job-image-box-wrap để fix chiều cao ảnh --}}
                                <div class="job-image-box-wrap" style="height: 200px; overflow: hidden;"> {{-- Đặt chiều cao cố định cho vùng ảnh --}}
                                    <a href="{{ route('jobs.show', $job->id) }}">
                                        {{-- Hình ảnh minh họa công việc (jobs_images) --}}
                                        <img 
                                            src="{{ asset('storage/' . $job->jobs_images ?? 'page/images/default.jpg') }}" 
                                            class="job-image img-fluid" 
                                            alt="{{ $job->title ?? 'Job Thumbnail' }}"
                                            style="width: 100%; height: 100%; object-fit: cover;" {{-- Đảm bảo ảnh bao phủ và cắt phần thừa --}}
                                        >
                                    </a>
                                    
                                    <div class="job-image-box-wrap-info d-flex align-items-center">
                                        {{-- Cấp độ (Level) --}}
                                        <p class="mb-0">
                                            <a href="job-listings.html" class="badge badge-level">{{ $job->level }}</a>
                                        </p>
                                        {{-- Loại hình công việc (Remote Type) --}}
                                        <p class="mb-0">
                                            <a href="job-listings.html" class="badge">{{ $job->remote_type }}</a>
                                        </p>
                                    </div>
                                </div>
                                
                                {{-- THÂN THẺ: Thêm flex-grow-1 --}}
                                <div class="job-body flex-grow-1 d-flex flex-column"> 
                                    <h4 class="job-title">
                                        {{-- Tên công việc (Title) --}}
                                        <a href="{{ route('jobs.show', $job->id) }}" class="job-title-link">{{ $job->title }}</a>
                                    </h4>
                                    
                                    <div class="d-flex align-items-center">
                                        {{-- THAY ĐỔI: Thêm style cho logo company trong job-image-wrap --}}
                                        <div class="job-image-wrap d-flex align-items-center bg-white shadow-lg mt-2 mb-4" style="width: 50px; height: 50px; overflow: hidden; border-radius: 50%; justify-content: center;"> {{-- Đặt kích thước cố định cho logo --}}
                                            {{-- Logo công ty --}}
                                            <img 
                                                src="{{ asset('storage/' . $job->company_logo_url ?? 'page/images/logos/default.png') }}" 
                                                class="job-image me-3 img-fluid" 
                                                alt="{{ $job->company_name }}"
                                                style="width: 100%; height: 100%; object-fit: cover;" {{-- Đảm bảo logo bao phủ và cắt phần thừa --}}
                                            >
                                            {{-- <p class="mb-0">{{ $job->company_name }}</p> đã bị xóa để gọn hơn nếu logo đã quá lớn --}}
                                        </div>
                                        <p class="mb-0 ms-2">{{ $job->company_name }}</p> {{-- Đặt tên công ty bên cạnh logo --}}
                                        
                                        <a href="#" class="bi-bookmark ms-auto me-2"></a>
                                        <a href="#" class="bi-heart"></a>
                                    </div>
                                    
                                    <div class="d-flex align-items-center"> 
                                        <p class="job-location">
                                            <i class="custom-icon bi-geo-alt me-1"></i>
                                            {{ optional($job->locationItem)->value ?? 'N/A' }}
                                        </p>
                                        <p class="job-date">
                                            <i class="custom-icon bi-clock me-1"></i>
                                            {{ $job->posted_at?->diffForHumans() }}
                                        </p>
                                    </div>
                                    
                                    {{-- CHÂN THẺ: Dùng mt-auto để đẩy xuống cuối --}}
                                    <div class="d-flex align-items-center border-top pt-3 mt-auto">
                                        <p class="job-price mb-0">
                                            <i class="custom-icon bi-cash me-1"></i>
                                            {{ number_format($job->salary, 0, ',', '.') }} VND
                                        </p>
                                        <a href="{{ route('jobs.show', $job->id) }}" class="custom-btn btn ms-auto">Apply now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div> {{-- Đóng thẻ Row chứa Jobs --}}

                <div class="col-lg-4 col-12 recent-jobs-bottom d-flex ms-auto my-4">
                    <a href="{{ route('jobs.list') }}" class="custom-btn btn ms-lg-auto">Browse Job Listings</a>
                </div>

            </div>
        </div>
    </section>


            <section class="reviews-section section-padding">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12">
                            <h2 class="text-center mb-5">Happy customers</h2>

                            <div class="owl-carousel owl-theme reviews-carousel">
                                <div class="reviews-thumb">
                                
                                    <div class="reviews-info d-flex align-items-center">
                                        <img src="{{ asset('page/images/avatar/portrait-charming-middle-aged-attractive-woman-with-blonde-hair.jpg') }}" class="avatar-image img-fluid" alt="">

                                        <div class="d-flex align-items-center justify-content-between flex-wrap w-100 ms-3">
                                            <p class="mb-0">
                                                <strong>Susan L</strong>
                                                <small>Product Manager</small>
                                            </p>

                                            <div class="reviews-icons">
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star-fill"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="reviews-body">
                                        <img src="{{ asset('page/images/left-quote.png') }}" class="quote-icon img-fluid" alt="">

                                        <h4 class="reviews-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</h4>
                                    </div>
                                </div>

                                <div class="reviews-thumb">
                                    <div class="reviews-info d-flex align-items-center">
                                        <img src="{{ asset('page/images/avatar/medium-shot-smiley-senior-man.jpg') }}" class="avatar-image img-fluid" alt="">

                                        <div class="d-flex align-items-center justify-content-between flex-wrap w-100 ms-3">
                                            <p class="mb-0">
                                                <strong>Jack</strong>
                                                <small>Technical Lead</small>
                                            </p>

                                            <div class="reviews-icons">
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star"></i>
                                                <i class="bi-star"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="reviews-body">
                                        <img src="{{ asset('page/images/left-quote.png') }}" class="quote-icon img-fluid" alt="">

                                        <h4 class="reviews-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</h4>
                                    </div>
                                </div>

                                <div class="reviews-thumb">

                                    <div class="reviews-info d-flex align-items-center">
                                        <img src="{{ asset('page/images/avatar/portrait-beautiful-young-woman.jpg') }}" class="avatar-image img-fluid" alt="">

                                        <div class="d-flex align-items-center justify-content-between flex-wrap w-100 ms-3">
                                            <p class="mb-0">
                                                <strong>Haley</strong>
                                                <small>Sales & Marketing</small>
                                            </p>

                                            <div class="reviews-icons">
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star-fill"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="reviews-body">
                                        <img src="{{ asset('page/images/left-quote.png') }}" class="quote-icon img-fluid" alt="">

                                        <h4 class="reviews-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</h4>
                                    </div>
                                </div>

                                <div class="reviews-thumb">
                                    <div class="reviews-info d-flex align-items-center">
                                        <img src="{{ asset('page/images/avatar/blond-man-happy-expression.jpg') }}" class="avatar-image img-fluid" alt="">

                                        <div class="d-flex align-items-center justify-content-between flex-wrap w-100 ms-3">
                                            <p class="mb-0">
                                                <strong>Jackson</strong>
                                                <small>Dev Ops</small>
                                            </p>

                                            <div class="reviews-icons">
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star"></i>
                                                <i class="bi-star"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="reviews-body">
                                        <img src="{{ asset('page/images/left-quote.png') }}" class="quote-icon img-fluid" alt="">

                                        <h4 class="reviews-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</h4>
                                    </div>
                                </div>

                                <div class="reviews-thumb">
                                    <div class="reviews-info d-flex align-items-center">
                                        <img src="{{ asset('page/images/avatar/university-study-abroad-lifestyle-concept.jpg') }}" class="avatar-image img-fluid" alt="">

                                        <div class="d-flex align-items-center justify-content-between flex-wrap w-100 ms-3">
                                            <p class="mb-0">
                                                <strong>Kevin</strong>
                                                <small>Internship</small>
                                            </p>

                                            <div class="reviews-icons">
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star-fill"></i>
                                                <i class="bi-star-fill"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="reviews-body">
                                        <img src="{{ asset('page/images/left-quote.png') }}" class="quote-icon img-fluid" alt="">

                                        <h4 class="reviews-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</h4>
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

                            <p class="text-white">If you are looking for free job aplication form, you may visit Gotto website. If you need a list of corporate companies, you can visit Gotto Job Listings website.</p>
                        </div>

                        <div class="col-lg-4 col-12 ms-auto">
                            <div class="custom-border-btn-wrap d-flex align-items-center mt-lg-4 mt-2">
                                <a href="{{ route('create_cv.contract') }}" class="custom-btn custom-border-btn btn me-4">Create resume</a>
                                <form id="cvUploadForm" action="{{ route('create_cv.upload') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                                    @csrf
                                    <input type="file" name="pdfFile" id="pdfFileInput" accept=".pdf" onchange="document.getElementById('cvUploadForm').submit()">
                                </form>

                                <form id="cvUploadForm" action="{{ route('create_cv.upload') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                                    @csrf
                                    <input type="file" name="pdfFile" id="pdfFileInput" accept=".pdf" onchange="document.getElementById('cvUploadForm').submit()">
                                </form>

                                <button type="button" class="custom-btn custom-border-btn btn me-4" onclick="document.getElementById('pdfFileInput').click()">
                                    Post your CV
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </main>

    </body>
@endsection
@extends('layouts.main')
@section('content')

        <main>

            <header class="site-header">
                <div class="section-overlay"></div>

                <div class="container">
                    <div class="row">
                        
                        <div class="col-lg-12 col-12 text-center">
                            <h1 class="text-white">About Gotto</h1>

                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="{{ route('page.index') }}">Home</a></li>

                                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('page.about') }}" >About </a></li>
                                </ol>
                            </nav>
                        </div>

                    </div>
                </div>
            </header>




            <section class="about-section">
                <div class="container">
                    <div class="row justify-content-center align-items-center">

                        <div class="col-lg-5 col-12">
                            <div class="about-info-text">
                                <h2 class="mb-0">Corporate Philosophy</h2>
                                <p> Nowadays, "choosing" has become even more difficult. In an age where unreliable information is overflowing flooded with the internet, many people feel insecure, not knowing which new option is best for their trunk.
                                <br>
                                 We want to bring a future where everyone can have peace of mind and be satisfied when get the best choice for yourself; where individuals and businesses provide services and products products with real value will be selected and will last for a long time.
                                <br>
                                 We - Gotto, hope for a time At some point in the future, it will be possible to change the way we look at the Internet, which will change the lives of 8 billion people in the world and contribute to promoting the development of mankind.</p>
                                <h4 class="mb-2">Get hired. Get your new job</h4>

                                <p>Thank you for visiting our Gotto Job website. Are you looking for the right Job? Please visit Gotto website to get free job application form.</p>

                                <div class="d-flex align-items-center mt-4">
                                    <a href="#services-section" class="custom-btn custom-border-btn btn me-4">Explore Services</a>

                                    <a href="{{ route('emails.contact') }}" class="custom-link smoothscroll">Contact</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5 col-12 mt-5 mt-lg-0">
                            <div class="about-image-wrap">
                                <img src="{{ asset('page/images/horizontal-shot-happy-mixed-race-females.jpg') }}" class="about-image about-image-border-radius img-fluid" alt="">

                                <div class="about-info d-flex">
                                    <h4 class="text-white mb-0 me-2">20</h4>

                                    <p class="text-white mb-0">years of experience</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>


                <section class="services-section section-padding" id="services-section">
                <div class="container">
                    <div class="row justify-content-center"> <div class="col-lg-12 col-12 text-center">
                            <h2 class="mb-5">We deliver best services</h2>
                        </div>

                        <div class="services-block-wrap col-lg-6 col-md-6 col-12 mb-4"> <div class="services-block">
                                <div class="services-block-title-wrap">
                                    <i class="services-block-icon bi-window"></i>
                                    <h4 class="services-block-title">CV design</h4>
                                </div>
                                <div class="services-block-body">
                                    <p>Gotto offers a variety of free CV (resume) and portfolio design templates, built on a modern HTML/CSS/Bootstrap platform, to help you create impressive profiles for personal, commercial, or business purposes.</p>
                                </div>
                            </div>
                        </div>

                        <div class="services-block-wrap col-lg-6 col-md-6 col-12 mb-4"> <div class="services-block">
                                <div class="services-block-title-wrap">
                                    <i class="services-block-icon bi-twitch"></i>
                                    <h4 class="services-block-title">Marketing</h4>
                                </div>
                                <div class="services-block-body">
                                    <p>Download free professional CV templates and instantly upload your personal profile to our platform for immediate sharing! Please tell your friends about Gotto.</p>
                                </div>
                            </div>
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
                                        <img src="images/left-quote.png" class="quote-icon img-fluid" alt="">

                                        <h4 class="reviews-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</h4>
                                    </div>
                                </div>

                                <div class="reviews-thumb">

                                    <div class="reviews-info d-flex align-items-center">
                                        <img src="{{ asset('page/images/avatar/portrait-beautiful-young-woman-studying-table-with-laptop-computer-notebook-home-studying-online-e-learning-system.jpg') }}" class="avatar-image img-fluid" alt="">

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
                                        <img src="images/left-quote.png" class="quote-icon img-fluid" alt="">

                                        <h4 class="reviews-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</h4>
                                    </div>
                                </div>

                                <div class="reviews-thumb">
                                    <div class="reviews-info d-flex align-items-center">
                                        <img src="{{ asset('images/avatar/blond-man-happy-expression.jpg') }}" class="avatar-image img-fluid" alt="">

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
                                        <img src="images/left-quote.png" class="quote-icon img-fluid" alt="">

                                        <h4 class="reviews-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</h4>
                                    </div>
                                </div>

                                <div class="reviews-thumb">
                                    <div class="reviews-info d-flex align-items-center">
                                        <img src="{{ asset('images/avatar/university-study-abroad-lifestyle-concept-satisfied-happy-asian-male-student-glasses-shirt-showing-thumbs-up-approval-likes-studying-college-holding-laptop-backpack.jpg') }}" class="avatar-image img-fluid" alt="">

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
                                        <img src="images/left-quote.png" class="quote-icon img-fluid" alt="">

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
                                <a href="{{ route('create_cv.contract') }}" class="custom-btn custom-border-btn btn me-4">Create an account</a>

                                <a href="#" class="custom-link">Post a job</a>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </main>
@endsection


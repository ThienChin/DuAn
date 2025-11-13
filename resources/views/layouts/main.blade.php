<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Gotto Online Job Portal</title>

    <!-- CSS FILES -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite([
            'resources/css/bootstrap-icons.css',
            'resources/css/bootstrap.min.css',
            'resources/css/owl.carousel.min.css',
            'resources/css/owl.theme.default.min.css',
            'resources/css/tooplate-gotto-job.css',
        ])
    @endif

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" 
          integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;300;400;600;700&display=swap" rel="stylesheet">
</head>
<body id="top">

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('page.index') }}">
            <img src="{{ asset('page/images/logo.png') }}" class="img-fluid logo-image" alt="Logo">
            <div class="d-flex flex-column">
                <strong class="logo-text">Gotto</strong>
                <small class="logo-slogan">Online Job Portal</small>
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav align-items-center ms-lg-5 me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('page.index') ? 'active' : '' }}" href="{{ route('page.index') }}">Homepage</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('page.about') ? 'active' : '' }}" href="{{ route('page.about') }}">About Gotto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('jobs.list') ? 'active' : '' }}" href="{{ route('jobs.list') }}">Jobs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('emails.contact') ? 'active' : '' }}" href="{{ route('emails.contact') }}">Contact</a>
                </li>
            </ul>

            

            <!-- Right Side: Authenticated or Guest -->
            <ul class="navbar-nav align-items-center">
                @auth
                    <!-- User Profile -->
                    <li class="nav-item ms-lg-auto dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center text-decoration-none" 
                           href="#" id="navbarUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('page/images/avatar.png') }}" 
                                 alt="avatar" 
                                 class="rounded-circle me-2" 
                                 style="width: 35px; height: 35px; object-fit: cover;" 
                                 onerror="this.src='{{ asset('page/images/avatar-default.jpg') }}'">
                            <span>{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarUser">
                            <li><a class="dropdown-item" href="{{ route('profile.personal') }}">Personal Information</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>

                    
                @else
                    <li class="nav-item ms-lg-auto">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link custom-btn btn" href="{{ route('login') }}">Login</a>
                    </li>
                @endauth

                    <!-- Employer Block -->
                     @guest
                    <li class="nav-item ms-3 d-none d-lg-block">
                        <div class="block-for-employer text-center text-lg-start">
                            <p class="mb-1 small">Bạn là nhà tuyển dụng?</p>
                            <a href="{{ route('employer.intro') }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <span>Đăng tuyển ngay</span>
                                <i class="fa-solid fa-chevrons-right ms-1"></i>
                            </a>
                        </div>
                    </li>
                    @endguest
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<!-- JS FILES (đặt cuối body) -->
@if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite([
        'resources/js/jquery.min.js',
        'resources/js/bootstrap.min.js',
        'resources/js/owl.carousel.min.js',
        'resources/js/counter.js',
        'resources/js/custom.js'
    ])
@endif

</body>

    <footer class="site-footer">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                        <div class="d-flex align-items-center mb-4">
                            <img src="page/images/logo.png" class="img-fluid logo-image">

                            <div class="d-flex flex-column">
                                <strong class="logo-text">Gotto</strong>
                                <small class="logo-slogan">Online Job Portal</small>
                            </div>
                        </div>  

                        <p class="mb-2">
                            <i class="custom-icon bi-globe me-1"></i>

                            <a href="#" class="site-footer-link">
                                gottojob.io.vn
                            </a>
                        </p>

                        <p class="mb-2">
                            <i class="custom-icon bi-telephone me-1"></i>

                            <a href="tel: 305-240-9671" class="site-footer-link">
                                305-240-9671
                            </a>
                        </p>

                        <p>
                            <i class="custom-icon bi-envelope me-1"></i>

                            <a href="mailto:thiendz362@gmail.com" class="site-footer-link">
                                 thiendz362@gmail.com 
                            </a> 
                        </p>

                    </div>

                    <div class="col-lg-2 col-md-3 col-6 ms-lg-auto">
                        <h6 class="site-footer-title">Company</h6>

                        <ul class="footer-menu">
                            <li class="footer-menu-item"><a href="{{ route('page.about') }}" class="footer-menu-link">About</a></li> 

                            <li class="footer-menu-item"><a href="{{ route('jobs.list') }}" class="footer-menu-link">Jobs</a></li>

                            <li class="footer-menu-item"><a href="{{ route('emails.contact') }}" class="footer-menu-link">Contact</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-md-3 col-6">
                        <h6 class="site-footer-title">Resources</h6>

                        <ul class="footer-menu">
                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Guide</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">How it works</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Salary Tool</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-8 col-12 mt-3 mt-lg-0">
                        <h6 class="site-footer-title">Newsletter</h6>

                        <form class="custom-form newsletter-form" action="#" method="post" role="form">
                            <h6 class="site-footer-title">Get notified jobs news</h6>

                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="bi-person"></i></span>

                                <input type="text" name="newsletter-name" id="newsletter-name" class="form-control" placeholder="yourname@gmail.com" required>

                                <button type="submit" class="form-control">
                                    <i class="bi-send"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            <div class="site-footer-bottom">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-4 col-12 d-flex align-items-center">
                            <p class="copyright-text">Copyright © Gotto Job 2048</p>

                            <ul class="footer-menu d-flex">
                                <li class="footer-menu-item"><a href="#" class="footer-menu-link">Privacy Policy</a></li>

                                <li class="footer-menu-item"><a href="#" class="footer-menu-link">Terms</a></li>
                            </ul>
                        </div>

                        <div class="col-lg-5 col-12 mt-2 mt-lg-0">
                            <ul class="social-icon">
                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-twitter"></a>
                                </li>

                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-facebook"></a>
                                </li>

                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-linkedin"></a>
                                </li>

                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-instagram"></a>
                                </li>

                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-youtube"></a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-3 col-12 mt-2 d-flex align-items-center mt-lg-0">
                            <p>Design: <a class="sponsored-link" rel="sponsored" href="https://www.tooplate.com" target="_blank">Tooplate</a></p>
                        </div>

                        <a class="back-top-icon bi-arrow-up smoothscroll d-flex justify-content-center align-items-center" href="#top"></a>

                    </div>
                </div>
            </div>
        </footer>
</html>

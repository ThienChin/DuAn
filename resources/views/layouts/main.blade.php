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

                'resources/js/bootstrap.min.js',
                'resources/js/counter.js',
                'resources/js/custom.js',
                'resources/js/jquery.min.js',
                'resources/js/owl.carousel.min.js'
            ])
        @endif

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;300;400;600;700&display=swap" rel="stylesheet">
    </head>
    <body id="top">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ route('page.index') }}">
                    <img src="{{ asset('page/images/logo.png') }}" class="img-fluid logo-image">
                    <div class="d-flex flex-column">
                        <strong class="logo-text">Gotto</strong>
                        <small class="logo-slogan">Online Job Portal</small>
                    </div>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav align-items-center ms-lg-5">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('page.index') }}">Homepage</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('page.about') }}">About Gotto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('jobs.index') }}">Jobs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('emails.contact') }}">Contact</a>
                        </li>
                        @auth
                            <li class="nav-item dropdown ms-lg-auto d-flex align-items-center">
                                <a href="{{ route('profile.personal') }}" class="d-flex align-items-center text-decoration-none">
                                    <img src="{{ asset('page/images/avatar.png') }}" 
                                         alt="avatar" 
                                         class="rounded-circle me-2" 
                                         style="width:35px; height:35px; object-fit:cover;">
                                    <span class="me-3">{{ auth()->user()->name }}</span>
                                </a>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Logout</button>
                                </form>
                            </li>
                        @else
                            <li class="nav-item ms-lg-auto">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link custom-btn btn" href="{{ route('login') }}">Login</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')

        <footer class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                        <div class="d-flex align-items-center mb-4">
                            <img src="{{ asset('page/images/logo.png') }}" class="img-fluid logo-image">
                            <div class="d-flex flex-column">
                                <strong class="logo-text">Gotto</strong>
                                <small class="logo-slogan">Online Job Portal</small>
                            </div>
                        </div>
                        <p class="mb-2">
                            <i class="custom-icon bi-globe me-1"></i>
                            <a href="#" class="site-footer-link">www.jobbportal.com</a>
                        </p>
                        <p class="mb-2">
                            <i class="custom-icon bi-telephone me-1"></i>
                            <a href="tel: 305-240-9671" class="site-footer-link">305-240-9671</a>
                        </p>
                        <p>
                            <i class="custom-icon bi-envelope me-1"></i>
                            <a href="mailto:info@yourgmail.com" class="site-footer-link">info@jobportal.co</a>
                        </p>
                    </div>
                    <div class="col-lg-2 col-md-3 col-6 ms-lg-auto">
                        <h6 class="site-footer-title">Company</h6>
                        <ul class="footer-menu">
                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">About</a></li>
                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Blog</a></li>
                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Jobs</a></li>
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
    </body>
</html>

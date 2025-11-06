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
    </body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gotto Online Job Portal')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --gotto-primary: #6c63ff;
            --gotto-secondary: #4834d4;
            --gotto-light: #f5f7ff;
            --gotto-green: #00b894;
        }
        body {
            background-color: var(--gotto-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .navbar-brand {
            font-weight: bold;
            color: var(--gotto-primary) !important;
        }
        .nav-link {
            color: #333 !important;
            font-weight: 500;
            margin-right: 20px;
            transition: color .2s;
        }
        .nav-link:hover {
            color: var(--gotto-primary) !important;
        }
        .btn-outline-primary {
            border-color: var(--gotto-primary);
            color: var(--gotto-primary);
        }
        .btn-outline-primary:hover {
            background-color: var(--gotto-primary);
            color: #fff;
        }
        .btn-primary {
            background-color: var(--gotto-primary);
            border: none;
        }
        .btn-primary:hover {
            background-color: var(--gotto-secondary);
        }
        footer {
            background-color: #fff;
            padding: 30px 0;
            margin-top: 60px;
            text-align: center;
            color: #777;
            border-top: 1px solid #eee;
        }
        .logo-image {
            width: 40px;
            height: auto;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg py-3 shadow-sm bg-white">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('employer.intro') }}">
            <img src="{{ asset('page/images/logo.png') }}" class="img-fluid logo-image me-2" alt="Logo" style="height: 40px; width: auto;">
            <div class="d-flex flex-column lh-1">
                <strong class="logo-text" style="font-size: 1.1rem; color: #5a47d1;">Gotto</strong>
                <small class="logo-slogan text-muted" style="font-size: 0.75rem;">Online Job Portal</small>
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            
            {{-- ✨ MENU ĐÃ SỬA: CHỈ CÓ INTRO, JOBS, CONTACT --}}
            <ul class="navbar-nav mx-auto fw-semibold">
                
                {{-- 1. MỤC INTRO (GIỮ LẠI) --}}
                <li class="nav-item"><a class="nav-link text-dark" href="{{ route('employer.intro') }}">INTRO</a></li>
                
                {{-- 2. MỤC JOBS (LẤY TỪ MAIN.BLADE.PHP) --}}
                <li class="nav-item"><a class="nav-link text-dark" href="{{ route('jobs.list') }}">JOBS</a></li>
                
                {{-- 3. MỤC CONTACT (LẤY TỪ MAIN.BLADE.PHP) --}}
                <li class="nav-item"><a class="nav-link text-dark" href="{{ route('emails.contact') }}">CONTACT</a></li>
            </ul>
            {{-- ✨ KẾT THÚC MENU ĐÃ SỬA --}}


            <ul class="navbar-nav align-items-center">
                @auth('employer')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center text-decoration-none"
                           href="#" id="navbarUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('page/images/avatar.png') }}"
                                 alt="avatar"
                                 class="rounded-circle me-2"
                                 style="width: 35px; height: 35px; object-fit: cover;"
                                 onerror="this.src='{{ asset('page/images/avatar-default.jpg') }}'">
                            <span class="fw-semibold text-dark">{{ auth('employer')->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarUser">
                            <li><a class="dropdown-item" href="{{ route('employer.dashboard') }}">Company Profile</a></li> 
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('employer.logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-semibold" href="{{ route('employer.register') }}">Register</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="btn btn-primary px-4 py-2 fw-semibold"
                           href="{{ route('employer.login') }}"
                           style="background-color: #5a47d1; border-color: #5a47d1; border-radius: 8px;">
                            Login
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>


<main>
    @yield('content')
</main>

<footer>
    <p>© 2025 Gotto Online Job Portal — Leading platform connecting employers & candidates.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
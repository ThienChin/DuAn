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
                    <a class="nav-link {{ request()->routeIs('jobs.index') ? 'active' : '' }}" href="{{ route('jobs.index') }}">Jobs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('emails.contact') ? 'active' : '' }}" href="{{ route('emails.contact') }}">Contact</a>
                </li>
            </ul>

            <!-- Right Side: Authenticated or Guest -->
            <ul class="navbar-nav align-items-center">
                @auth
                    <!-- Notification Bell -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle position-relative" href="#" 
                           id="notificationDropdown" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-regular fa-bell noti-icon"></i>

                            @if ($unreadNotifications > 0)
                                <span class="badge bg-danger rounded-pill notification-badge"
                                      style="font-size: 0.6rem; position: absolute; top: 8px; right: 8px;">
                                    {{ $unreadNotifications }}
                                </span>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end p-0" style="width: 320px;">
                            <li class="dropdown-header bg-light p-3 border-bottom d-flex justify-content-between">
                                <strong>Thông báo</strong>
                                <span class="badge bg-danger notification-count">{{ $unreadNotifications }}</span>
                            </li>

                            @forelse (auth()->user()->unreadNotifications()->latest()->take(5)->get() as $noti)
                                <li>
                                    <a href="{{ $noti->data['url'] ?? '#' }}"
                                       class="dropdown-item d-flex py-3 border-bottom notification-item"
                                       data-id="{{ $noti->id }}"
                                       style="white-space: normal; text-decoration: none;">
                                        <i class="fa {{ $noti->data['icon'] ?? 'fa-info-circle' }} text-primary me-3 mt-1"></i>
                                        <div class="flex-grow-1">
                                            <div class="small fw-bold">{{ $noti->data['message'] }}</div>
                                            <small class="text-muted">{{ $noti->created_at->diffForHumans() }}</small>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li>
                                    <a class="dropdown-item text-center text-muted py-4" href="#">
                                        <i class="fa fa-inbox fa-2x mb-2 d-block"></i>
                                        Chưa có thông báo mới
                                    </a>
                                </li>
                            @endforelse

                            <li>
                                <a class="dropdown-item text-center py-2 bg-light" href="{{ route('notifications.index') }}">
                                    <strong>Xem tất cả</strong>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- User Profile -->
                    <li class="nav-item dropdown">
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
                            <li><a class="dropdown-item" href="{{ route('profile.personal') }}">Hồ sơ cá nhân</a></li>
                            <li><a class="dropdown-item" href="{{ route('jobs.create') }}">Đăng tin tuyển dụng</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Đăng xuất</button>
                                </form>
                            </li>
                        </ul>
                    </li>

                    <!-- Employer Block -->
                    <li class="nav-item ms-3 d-none d-lg-block">
                        <div class="block-for-employer text-center text-lg-start">
                            <p class="mb-1 small">Bạn là nhà tuyển dụng?</p>
                            <a href="{{ route('jobs.create') }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <span>Đăng tuyển ngay</span>
                                <i class="fa-solid fa-chevrons-right ms-1"></i>
                            </a>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const dropdown = document.querySelector('#notificationDropdown');
    const badge = document.querySelector('.notification-badge');
    const countSpan = document.querySelector('.notification-count');

    // Hàm cập nhật badge
    function updateBadge(count) {
        if (count <= 0) {
            if (badge) badge.style.display = 'none';
            if (countSpan) countSpan.textContent = '0';
        } else {
            if (badge) {
                badge.style.display = 'inline';
                badge.textContent = count;
            }
            if (countSpan) countSpan.textContent = count;
        }
    }

    // 1. Click từng thông báo → đánh dấu đã đọc
    document.querySelectorAll('.notification-item').forEach(item => {
        item.addEventListener('click', function (e) {
            const id = this.getAttribute('data-id');
            const url = this.getAttribute('href');

            // Ngăn nhảy trang nếu không có URL hợp lệ
            if (!url || url === '#' || url === 'javascript:void(0)') {
                e.preventDefault();
            }

            if (!id) return;

            fetch(`/notifications/${id}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            }).then(() => {
                // Giảm số lượng
                let currentCount = parseInt(badge?.textContent || '0') || 0;
                currentCount--;
                updateBadge(currentCount);

                // Làm mờ thông báo đã đọc
                this.style.opacity = '0.6';
                this.style.pointerEvents = 'none';
            }).catch(() => {
                // Nếu lỗi, vẫn cho phép nhảy trang
                if (url && url !== '#') {
                    window.location.href = url;
                }
            });
        });
    });

    // 2. Mở dropdown → đánh dấu tất cả
    if (dropdown) {
        dropdown.addEventListener('shown.bs.dropdown', function () {
            fetch('{{ route("notifications.markAllAsRead") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            }).then(() => {
                updateBadge(0);
                document.querySelectorAll('.notification-item').forEach(el => {
                    el.style.opacity = '0.6';
                    el.style.pointerEvents = 'none';
                });
            });
        });
    }
});
</script>

</body>
</html>
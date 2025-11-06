<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/assets/images/favicon.png') }}">

    <!-- Core CSS -->
    <link href="{{ asset('admin/assets/libs/flot/css/float-chart.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/dist/css/style.min.css') }}" rel="stylesheet">

    {{-- CSS riêng cho từng trang --}}
    @stack('styles')
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper">
        <!-- ======================= Navbar ======================= -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <!-- Toggle sidebar (mobile) -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                        <i class="ti-menu ti-close"></i>
                    </a>

                    <!-- Logo -->
                    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                        <b class="logo-icon p-l-10">
                            <img src="{{ asset('admin/assets/images/logo-icon.png') }}" alt="homepage" class="light-logo" />
                        </b>
                        <span class="logo-text">
                            <img src="{{ asset('admin/assets/images/logo-text.png') }}" alt="homepage" class="light-logo" />
                        </span>
                    </a>

                    <!-- Toggle menu button -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>

                <!-- Navbar menu -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block">
                            <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)"
                                data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a>
                        </li>
                    </ul>

                    <ul class="navbar-nav float-right">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('admin/assets/images/users/1.jpg') }}" alt="user"
                                    class="rounded-circle" width="31">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                <a class="dropdown-item" href="#"><i class="ti-user m-r-5 m-l-5"></i> Hồ sơ</a>
                                <a class="dropdown-item" href="#"><i class="fa fa-power-off m-r-5 m-l-5"></i> Đăng xuất</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- ======================= Sidebar ======================= -->
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"
                               href="{{ route('admin.dashboard') }}">
                                <i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"
                               href="{{ route('admin.create') }}">
                                <i class="mdi mdi-plus"></i><span class="hide-menu">Thêm mới</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- ======================= Nội dung chính ======================= -->
        <div class="page-wrapper">
            <div class="container-fluid">
                @yield('content')
            </div>

            <footer class="footer text-center">
                © {{ date('Y') }} Matrix Admin Template. All Rights Reserved.
            </footer>
        </div>
    </div>

    <!-- ======================= Script chung ======================= -->
    <script src="{{ asset('admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/custom.min.js') }}"></script>

    {{-- JS riêng từng trang --}}
    @stack('scripts')
</body>
</html>

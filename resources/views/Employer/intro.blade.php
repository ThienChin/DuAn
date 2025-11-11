@extends('layouts.employer')

@section('title', 'Gotto Online Job Portal')

@section('content')
<!-- 🔹 HERO BANNER -->
<section class="banner position-relative text-white overflow-hidden" style="height: 480px;">
    <!-- Ảnh nền -->
    <img src="{{ asset('page/images/professional-asian-businesswoman-gray-blazer.jpg') }}" 
         alt="Gotto Employer Banner" 
         class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"
         style="opacity: 0.45; z-index: 1;">

    <!-- Lớp phủ màu tím -->
    <div class="position-absolute top-0 start-0 w-100 h-100" 
         style="background: rgba(108,99,255,0.5); z-index: 2;">
    </div>

    <!-- Nội dung chữ -->
    <div class="container position-relative z-3 text-center d-flex flex-column justify-content-center align-items-center h-100">
        <h1 class="fw-bold mb-3" style="font-size: 3rem; line-height: 1.2;">
            Nền tảng tuyển dụng thông minh <br> cùng <span style="color: #fff;">Gotto Online Job</span>
        </h1>
        <p class="lead text-white-50 mb-4" style="max-width: 700px;">
            Kết nối hàng nghìn ứng viên tiềm năng và xây dựng thương hiệu tuyển dụng chuyên nghiệp của bạn.
        </p>
        <div>
            <a href="{{ route('employer.login') }}" class="btn btn-light text-primary fw-semibold px-4 py-2 rounded-pill shadow-sm me-3">
                Đăng tuyển ngay
            </a>
        </div>
    </div>
</section>



<!-- 🔹 SECTION THÔNG TIN DƯỚI -->
<section class="py-5 bg-white text-center">
    <div class="container">
        <h2 class="fw-bold mb-3" style="color: var(--gotto-primary);">Tuyển dụng nhanh chóng cùng Gotto</h2>
        <p class="text-muted mb-5">Nền tảng giúp doanh nghiệp đăng tin, quản lý hồ sơ và tìm kiếm ứng viên phù hợp nhất.</p>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="p-4 shadow-sm rounded-4 h-100">
                    <h5 class="fw-bold text-primary mb-3">1. Đăng tin miễn phí</h5>
                    <p class="text-muted">Tạo tin tuyển dụng nhanh chóng, trực quan chỉ trong vài bước đơn giản.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 shadow-sm rounded-4 h-100">
                    <h5 class="fw-bold text-primary mb-3">2. Quản lý ứng viên</h5>
                    <p class="text-muted">Hệ thống quản lý hồ sơ tiện lợi, giúp bạn theo dõi tiến trình ứng tuyển dễ dàng.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 shadow-sm rounded-4 h-100">
                    <h5 class="fw-bold text-primary mb-3">3. Gợi ý thông minh</h5>
                    <p class="text-muted">Công nghệ AI tự động đề xuất ứng viên phù hợp nhất cho từng vị trí.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

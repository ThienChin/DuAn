@extends('layouts.main')

{{-- NHÚNG CSS TRỰC TIẾP VÀO BLADE ĐỂ GHI ĐÈ BỐ CỤC NGANG --}}
@section('styles')
<style>
    /*---------------------------------------
      CUSTOM STYLES TO FORCE HORIZONTAL LAYOUT (GHI ĐÈ)
    -----------------------------------------*/
    /* ... (CSS giữ nguyên) ... */
</style>
@endsection

@section('content')
    <main>
        <header class="site-header">
            <div class="section-overlay"></div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-12 text-center">
                        <h1 class="text-white">{{ $job->title }}</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="{{ route('page.index') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('jobs.list') }}">Job Listings</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $job->title }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </header>

        <section class="job-section section-padding">
            <div class="container-fluid px-5" style="max-width: 1400px;">
                <div class="row">
                    
                    {{-- Cột Nội dung Chính: col-lg-9 --}}
                    <div class="col-lg-9 col-12 order-lg-1 order-2">
                        <div class="job-thumb job-thumb-box shadow-lg border-0 mb-4 bg-white p-0" style="width: 100% !important;">
                            
                            {{-- 1. HEADER CÔNG VIỆC: Thông tin Chung & Logo --}}
                            <div class="d-flex p-4 align-items-center border-bottom">
                                <div class="job-image-wrap me-4">
                                    <img src="{{ asset('storage/' . $job->company_logo_url) }}" class="img-fluid rounded-circle" alt="{{ $job->company_name }}" style="width: 80px; height: 80px; object-fit: contain; border: 1px solid #eee;">
                                </div>
                                
                                <div class="job-header-info flex-grow-1">
                                    <h2 class="job-title text-primary mb-1">{{ $job->title }}</h2>
                                    <p class="mb-2 fw-bold text-dark">{{ $job->company_name ?? 'Unknown Company' }}</p>
                                    
                                    <div class="d-flex align-items-center small text-muted">
                                        {{-- ✨ Dùng locationItem --}}
                                        <p class="mb-0 me-3"><i class="bi bi-geo-alt me-1"></i> {{ $job->locationItem->value ?? 'N/A' }}</p>
                                        <p class="mb-0"><i class="bi bi-clock me-1"></i> Ngày đăng: {{ $job->posted_at ? (is_string($job->posted_at) ? \Carbon\Carbon::parse($job->posted_at)->format('d/m/Y') : $job->posted_at->format('d/m/Y')) : 'N/A' }}</p>
                                    </div>
                                </div>

                                <div class="job-actions ms-auto d-flex flex-column align-items-end">
                                    <a href="#" class="bi-bookmark text-secondary fs-5 mb-2" title="Save Job"></a>
                                    <a href="#" class="bi-heart text-danger fs-5" title="Favorite"></a>
                                </div>
                            </div>
                            
                            <div class="job-body p-4">
                                
                                {{-- 2. JOB DETAILS & REQUIREMENTS (SỬ DỤNG CSS GRID CHIA 2 CỘT LỚN) --}}
                                <div class="job-details-grid border-bottom pb-4 mb-4">
                                    
                                    {{-- Chi Tiết Công Việc --}}
                                    <div class="job-details-item col-lg-6 border-end">
                                        <h4 class="mb-3 text-secondary border-bottom pb-2">💼 Chi Tiết Công Việc</h4>
                                        <ul class="job-info-list info-columns">
                                            <li><i class="bi bi-cash-stack text-primary"></i> <strong>Lương:</strong> 
                                                @if ($job->salary > 0) {{ number_format($job->salary, 0) }} VND @else Thương Lượng @endif
                                            </li>
                                            {{-- ✨ Dùng levelItem --}}
                                            <li><i class="bi bi-briefcase-fill text-primary"></i> <strong>Cấp Bậc:</strong> {{ $job->levelItem->value ?? 'N/A' }}</li>
                                            {{-- ✨ Dùng remoteTypeItem --}}
                                            <li><i class="bi bi-clock-fill text-primary"></i> <strong>Loại Hình:</strong> {{ $job->remoteTypeItem->value ?? 'N/A' }}</li>
                                            {{-- ✨ Dùng categoryItem --}}
                                            <li><i class="bi bi-tag-fill text-primary"></i> <strong>Ngành Nghề:</strong> {{ $job->categoryItem->value ?? 'N/A' }}</li>
                                            <li><i class="bi bi-globe text-primary"></i> <strong>Từ Xa:</strong> {{ $job->remote ? 'Có' : 'Không' }}</li>
                                        </ul>
                                    </div>

                                    {{-- Yêu Cầu Ứng Viên --}}
                                    <div class="job-details-item col-lg-6 ps-lg-4">
                                        <h4 class="mb-3 text-secondary border-bottom pb-2">🎯 Yêu Cầu Ứng Viên</h4>
                                        <ul class="job-info-list info-columns">
                                            {{-- ✨ Dùng experienceItem --}}
                                            <li><i class="bi bi-puzzle-fill text-success"></i> <strong>Kinh nghiệm:</strong> {{ $job->experienceItem->value ?? 'Không yêu cầu' }}</li>
                                            {{-- ✨ Dùng degreeItem --}}
                                            <li><i class="bi bi-mortarboard-fill text-success"></i> <strong>Bằng cấp:</strong> {{ $job->degreeItem->value ?? 'Không yêu cầu' }}</li>
                                            {{-- ✨ Dùng genderItem --}}
                                            <li><i class="bi bi-person-fill text-success"></i> <strong>Giới tính:</strong> {{ $job->genderItem->value ?? 'Không yêu cầu' }}</li>
                                            <li><i class="bi bi-calendar-check-fill text-success"></i> <strong>Độ tuổi:</strong> {{ $job->age ?? 'N/A' }}</li>
                                        </ul>
                                    </div>
                                </div>

                                {{-- 3. Mô Tả Chi Tiết Công Việc --}}
                                <div class="job-details mb-5">
                                    <h4 class="mb-3 text-secondary border-bottom pb-2">📝 Mô Tả Công Việc</h4>
                                    <p style="white-space: pre-line;">{{ $job->description ?? 'No description available' }}</p>
                                </div>
                                
                                {{-- 4. Kỹ Năng Yêu Cầu Khác --}}
                                @if ($job->required_skills)
                                <div class="job-details mb-5">
                                    <h4 class="mb-3 text-secondary border-bottom pb-2">🔑 Kỹ Năng Yêu Cầu Khác</h4>
                                    <p style="white-space: pre-line;">{{ $job->required_skills }}</p>
                                </div>
                                @endif

                                {{-- 5. Thông Tin Công Ty & Ảnh --}}
                                <div class="job-details pt-4 border-top">
                                    <h4 class="mb-3 text-secondary border-bottom pb-2">🏢 Thông Tin Công Ty</h4>
                                    
                                    @if ($job->jobs_images)
                                    <img src="{{ asset('storage/' . $job->jobs_images) }}" class="img-fluid mb-4 rounded shadow-sm" alt="Job Image" style="max-height: 250px; object-fit: cover; width: 100%;">
                                    @endif
                                    
                                    <ul class="list-unstyled job-info-list small row g-2">
                                        <li class="col-md-6"><i class="bi bi-building-fill me-2 text-info"></i> <strong>Tên Công Ty:</strong> {{ $job->company_name }}</li>
                                        <li class="col-md-6"><i class="bi bi-at me-2 text-info"></i> <strong>Email:</strong> <a href="mailto:{{ $job->email }}">{{ $job->email ?? 'N/A' }}</a></li>
                                        <li class="col-md-6"><i class="bi bi-telephone-fill me-2 text-info"></i> <strong>Điện Thoại:</strong> {{ $job->phone ?? 'N/A' }}</li>
                                        <li class="col-md-6"><i class="bi bi-link-45deg me-2 text-info"></i> <strong>Website:</strong> <a href="{{ $job->website }}" target="_blank">{{ $job->website ?? 'N/A' }}</a></li>
                                    </ul>
                                    <p class="small text-muted mt-3">{{ $job->company_description ?? 'No description available' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Cột Sidebar: col-lg-3 (Giữ nguyên) --}}
                    <div class="col-lg-3 col-12 order-lg-2 order-1 mb-4 mb-lg-0">
                        <div class="job-sidebar bg-white p-4 shadow-sm rounded position-sticky" style="top: 20px;">
                            <h4 class="mb-3 text-center text-primary">Ứng Tuyển Ngay</h4>
                            <p class="text-center small">Quan tâm công việc này? Nhấn nút bên dưới.</p>
                            
                            <div class="d-grid gap-2 mb-4">
                                <a href="{{ route('jobs.apply.form', $job->id) }}" class="btn btn-primary btn-lg fw-bold">
                                    <i class="bi bi-send-fill me-2"></i> Apply Now
                                </a>
                            </div>

                            <h5 class="mb-3 border-top pt-3 text-center">Chia Sẻ Công Việc</h5>
                            <div class="social-share d-flex justify-content-center gap-3">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="bi-facebook text-primary fs-5"></a>
                                <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&title=Apply%20for%20{{ urlencode($job->title) }}" target="_blank" class="bi-twitter text-info fs-5"></a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}&title={{ urlencode($job->title) }}" target="_blank" class="bi-linkedin text-secondary fs-5"></a>
                                <a href="mailto:?subject=Job%20Opportunity:%20{{ urlencode($job->title) }}&body=Check%20out%20this%20job%20at:%20{{ url()->current() }}" class="bi-envelope text-warning fs-5"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Similar Jobs Section (Giữ nguyên cấu trúc) --}}
        <section class="job-section section-padding bg-light">
            <div class="container-fluid px-5" style="max-width: 1400px;">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-12 mb-lg-4">
                        <h3>Công Việc Tương Tự</h3>
                        <p class="text-muted"><strong>Hơn 10k công việc đang mở</strong> trong các lĩnh vực tương tự, đừng bỏ lỡ cơ hội!</p>
                    </div>
                    <div class="col-lg-4 col-12 d-flex ms-auto mb-5 mb-lg-4">
                        <a href="{{ route('jobs.list') }}" class="custom-btn custom-border-btn btn ms-lg-auto">Xem Tất Cả Công Việc</a>
                    </div>

                    {{-- LƯU Ý: ĐOẠN NÀY DÙNG TRUY VẤN CŨ VỚI CỘT STRING, CẦN CẬP NHẬT TRUY VẤN THEO ID --}}
                    @foreach (\App\Models\Job::where('category_id', $job->category_id)->where('id', '!=', $job->id)->take(3)->get() as $similarJob)
                        <div class="col-lg-4 col-md-6 col-12 mb-4">
                            <div class="job-thumb job-thumb-box shadow-sm border-0">
                                <div class="job-body p-3">
                                    <h5 class="job-title mb-2">
                                        <a href="{{ route('jobs.show', $similarJob->id) }}" class="job-title-link text-primary">{{ $similarJob->title }}</a>
                                    </h5>
                                    
                                    <div class="d-flex align-items-center mb-2">
                                        <p class="mb-0 small me-3">
                                            {{-- ✨ Dùng levelItem --}}
                                            <a href="{{ route('jobs.list') }}?job-level={{ $similarJob->level_id }}" class="badge bg-info text-white">{{ $similarJob->levelItem->value ?? 'N/A' }}</a>
                                        </p>
                                        <p class="mb-0 small">
                                            {{-- ✨ Dùng remoteTypeItem --}}
                                            <a href="{{ route('jobs.list') }}?job-remote={{ $similarJob->remote_type_id }}" class="badge bg-secondary text-white">{{ $similarJob->remoteTypeItem->value ?? 'N/A' }}</a>
                                        </p>
                                    </div>
                                    
                                    <div class="d-flex align-items-center pt-2 border-top">
                                        <p class="job-price mb-0 fw-bold text-success">
                                            <i class="custom-icon bi-cash me-1"></i>
                                            {{ number_format($similarJob->salary, 0) }} VND
                                        </p>
                                        <a href="{{ route('jobs.show', $similarJob->id) }}" class="custom-btn btn ms-auto btn-sm">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        
        <section class="cta-section">
            <div class="section-overlay"></div>
            <div class="container-fluid" style="max-width: 1400px;">
                <div class="row">
                    <div class="col-lg-6 col-10">
                        <h2 class="text-white mb-2">Hơn 10k công việc đang mở</h2>
                        <p class="text-white">Hãy tạo tài khoản ngay để nhận được các thông báo việc làm mới nhất và phù hợp nhất!</p>
                    </div>
                    <div class="col-lg-4 col-12 ms-auto">
                        <div class="custom-border-btn-wrap d-flex align-items-center mt-lg-4 mt-2">
                            <a href="{{ route('register') }}" class="custom-btn custom-border-btn btn me-4">Tạo Tài Khoản</a>
                            <a href="{{ route('create_cv.upload') }}" class="custom-link">Đăng Tin Tuyển Dụng</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
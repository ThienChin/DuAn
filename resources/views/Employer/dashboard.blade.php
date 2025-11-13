@extends('layouts.employer')

@section('title', 'Bảng Điều Khiển Nhà Tuyển Dụng')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-lg-3">
            <div class="list-group shadow-sm bg-white rounded-3 p-3">
                <h5 class="mb-3 text-muted">QUẢN LÝ CHUNG</h5>
                <a href="{{ route('employer.dashboard') }}" class="list-group-item list-group-item-action active" aria-current="true" style="background-color: var(--gotto-primary); border-color: var(--gotto-primary);"><i class="bi bi-house-door-fill me-2"></i> Trang chủ Dashboard</a> 
                <a href="{{ route('employer.create') }}" class="list-group-item list-group-item-action"><i class="bi bi-upload me-2"></i> Đăng tin tuyển dụng</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-list-task me-2"></i> Tất cả tuyển dụng</a>

                <h5 class="mt-4 mb-3 text-muted">ỨNG VIÊN</h5>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-cash me-2"></i> Mua dịch vụ</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-pin-map me-2"></i> Vị trí phỏng vấn</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-calendar-check me-2"></i> Biểu lịch phỏng vấn</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-bookmark-fill me-2"></i> Hồ sơ đã lưu</a>
                <a href="{{ route('employer.history') }}" class="list-group-item list-group-item-action"><i class="bi bi-file-earmark-person me-2"></i> Hồ sơ đã ứng tuyển</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-card-list me-2"></i> Ứng viên ứng tuyển - CV rút gọn</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-heart me-2"></i> Ứng viên quan tâm tin tuyển dụng <span class="badge bg-danger ms-2">NEW</span></a>
                <h5 class="mt-4 mb-3 text-muted">QUẢN LÝ DỊCH VỤ</h5>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-bell me-2"></i> Thông báo hồ sơ phù hợp</a>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="p-3 mb-4 text-center rounded-3 text-white fw-bold" style="background-color: #ff7675;">
                <h4 class="mb-0">CHỐT NGAY COMBO TUYỂN DỤNG GIÁ ƯU ĐÃI</h4>
                <a href="#" class="btn btn-warning mt-2 fw-bold text-dark">CLICK NGAY!!</a>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-4 col-lg-2">
                    <div class="card p-3 text-center shadow-sm border-0 h-100">
                        <div class="h3 mb-1 fw-bold" style="color: #4834d4;">0</div>
                        <p class="text-muted mb-0">Việc làm đã đăng</p>
                    </div>
                </div>
                <div class="col-md-4 col-lg-2">
                    <div class="card p-3 text-center shadow-sm border-0 h-100">
                        <div class="h3 mb-1 fw-bold" style="color: #ff7675;">0</div>
                        <p class="text-muted mb-0">Hồ sơ ứng tuyển</p>
                    </div>
                </div>
                <div class="col-md-4 col-lg-2">
                    <div class="card p-3 text-center shadow-sm border-0 h-100">
                        <div class="h3 mb-1 fw-bold" style="color: #00b894;">0</div>
                        <p class="text-muted mb-0">Hồ sơ đã lưu</p>
                    </div>
                </div>
                <div class="col-md-4 col-lg-2">
                    <div class="card p-3 text-center shadow-sm border-0 h-100">
                        <div class="h3 mb-1 fw-bold" style="color: #ff6b6b;">0</div>
                        <p class="text-muted mb-0">Lượt xem hồ sơ</p>
                    </div>
                </div>
                <div class="col-md-4 col-lg-2">
                    <div class="card p-3 text-center shadow-sm border-0 h-100">
                        <div class="h3 mb-1 fw-bold" style="color: #7bed9f;">0</div>
                        <p class="text-muted mb-0">Số lần làm mới</p>
                    </div>
                </div>
                <div class="col-md-4 col-lg-2">
                    <div class="card p-3 text-center shadow-sm border-0 h-100">
                        <div class="h3 mb-1 fw-bold" style="color: #a29bfe;">0</div>
                        <p class="text-muted mb-0">Lượt xem việc làm</p>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-4 p-4">
                <h5 class="card-title mb-3 fw-bold">Danh sách dịch vụ</h5>
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="text-center mb-3 mb-md-0">
                            <img src="https://via.placeholder.com/300x200/e8f0ff/6c63ff?text=Quản+Lý+Dịch+Vụ" class="img-fluid rounded-3" alt="Service Illustration">
                            <p class="mt-3 text-muted">Quý khách chưa đăng ký gói dịch vụ nào.</p>
                            <p class="small text-muted">Click vào đây để biết thêm chi tiết hoặc vui lòng liên hệ chuyên viên hỗ trợ, tư vấn.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Mua dịch vụ ngay</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                         <div class="p-3 rounded-3" style="background-color: #f7e1e6;">
                            <h6 class="fw-bold mb-2 text-danger">Tin tuyển dụng nổi bật</h6>
                            <p class="small mb-2 text-muted">Thanh toán khác nhau có thể mua các ngành nghề khác nhau trong cùng một lần tuyển dụng.</p>
                            <a href="#" class="btn btn-sm text-decoration-none fw-bold" style="background-color: #ff6b6b; color: white;">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0 pt-4 pb-0">
                    <h5 class="card-title fw-bold d-inline-block">Hồ sơ ứng tuyển mới nhất</h5>
                    <a href="#" class="float-end text-primary text-decoration-none fw-semibold small">Xem hết tất cả >></a>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex fw-bold text-white" style="background-color: var(--gotto-primary);">
                            <div class="col-4">Hồ sơ</div>
                            <div class="col-4">Vị trí ứng tuyển</div>
                            <div class="col-4">Ngày nộp</div>
                        </li>
                        <li class="list-group-item text-center text-muted py-4">
                            Không có dữ liệu phù hợp...
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
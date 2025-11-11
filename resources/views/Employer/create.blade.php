@extends('layouts.employer')

@section('title', 'Đăng Tin Tuyển Dụng')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-lg-3">
            <div class="list-group shadow-sm bg-white rounded-3 p-3">
                <h5 class="mb-3 text-muted">QUẢN LÝ CHUNG</h5>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-search me-2"></i> Tìm ứng viên phù hợp</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-robot me-2"></i> Ứng viên AI gợi ý <span class="badge bg-danger ms-2">NEW</span></a>
                <a href="#" class="list-group-item list-group-item-action active" aria-current="true" style="background-color: var(--gotto-primary); border-color: var(--gotto-primary);"><i class="bi bi-upload me-2"></i> Đăng tin tuyển dụng</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-list-task me-2"></i> Tất cả tuyển dụng</a>

                <h5 class="mt-4 mb-3 text-muted">ỨNG VIÊN</h5>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-cash me-2"></i> Mua dịch vụ</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-pin-map me-2"></i> Vị trí phỏng vấn</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-calendar-check me-2"></i> Biểu lịch phỏng vấn</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-bookmark-fill me-2"></i> Hồ sơ đã lưu</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-file-earmark-person me-2"></i> Hồ sơ đã ứng tuyển</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-card-list me-2"></i> Ứng viên ứng tuyển - CV rút gọn</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-heart me-2"></i> Ứng viên quan tâm tin tuyển dụng <span class="badge bg-danger ms-2">NEW</span></a>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-eye-fill me-2"></i> Hồ sơ đã xem</a>

                <h5 class="mt-4 mb-3 text-muted">QUẢN LÝ DỊCH VỤ</h5>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-bell me-2"></i> Thông báo hồ sơ phù hợp</a>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <h4 class="card-title mb-4 fw-bold" style="color: var(--gotto-primary);">THÔNG TIN CÔNG VIỆC</h4>
                    
                    <form>
                        <div class="mb-3">
                            <label for="jobTitle" class="form-label fw-semibold">Vị trí tuyển dụng:</label>
                            <input type="text" class="form-control" id="jobTitle" placeholder="VD: Nhân Viên Kinh Doanh, Trưởng Nhóm Marketing...">
                            <small class="form-text text-danger">(Lưu ý: Vị trí tuyển dụng **sẽ không được chỉnh sửa** sau khi tin tuyển dụng được duyệt!)</small>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="jobCode" class="form-label fw-semibold">Mã số:</label>
                                <input type="text" class="form-control" id="jobCode" placeholder="Nhập mã số tuyển dụng">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="quantity" class="form-label fw-semibold">Số lượng tuyển:</label>
                                <input type="number" class="form-control" id="quantity" placeholder="Số lượng tuyển dụng" min="1">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="level" class="form-label fw-semibold">Cấp bậc: <span class="text-danger">*</span></label>
                                <select class="form-select" id="level">
                                    <option>Mới tốt nghiệp / Thực tập sinh</option>
                                    <option>Nhân viên</option>
                                    <option>Trưởng nhóm</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="workType" class="form-label fw-semibold">Loại hình công việc: <span class="text-danger">*</span></label>
                                <select class="form-select" id="workType">
                                    <option>Làm việc Online / Tự xa</option>
                                    <option>Toàn thời gian</option>
                                    <option>Bán thời gian</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="salary" class="form-label fw-semibold">Mức lương: <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <select class="form-select" id="salary">
                                        <option>Thương lượng</option>
                                        <option>5 - 7 triệu</option>
                                        <option>7 - 10 triệu</option>
                                    </select>
                                    <span class="input-group-text">x</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 pt-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="commissionCheck">
                                    <label class="form-check-label fw-semibold" for="commissionCheck">
                                        Đảm nhận hoa hồng / Phần trăm hoa hồng
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="workLocation" class="form-label fw-semibold">Địa điểm làm việc: <span class="text-danger">*</span></label>
                                <select class="form-select" id="workLocation">
                                    <option>Chọn địa điểm làm việc</option>
                                    <option>Hà Nội</option>
                                    <option>TP Hồ Chí Minh</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="industry" class="form-label fw-semibold">Ngành nghề: <span class="text-danger">*</span></label>
                                <select class="form-select" id="industry">
                                    <option>Chọn ngành nghề</option>
                                    <option>IT Phần mềm</option>
                                    <option>Kinh doanh / Bán hàng</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="jobContent" class="form-label fw-semibold">Mô tả công việc: <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="jobContent" rows="10">
                                - Nhận đơn hàng qua mail.
                                - Tìm kiếm khách hàng mới cho công ty, chăm sóc khách hàng cũ của công ty.
                                - Tìm kiếm khách hàng, khách hàng tiềm năng.
                                - Đàm phán, thương lượng và chốt hợp đồng với khách hàng.
                                - Kiểm tra và theo dõi tình hình thanh toán của khách hàng.
                                - Liên hệ khách hàng để làm đơn đặt hàng, giao hàng.
                                - Các công việc hành chính khác, khi có yêu cầu từ ban lãnh đạo.
                                - Chi tiết trao đổi tại buổi phỏng vấn.
                            </textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg fw-semibold" style="background-color: var(--gotto-primary); border-color: var(--gotto-primary);">Tiếp tục</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-3">
                    <h5 class="text-success mb-3 fw-bold">📢 Rõ ràng, đầy đủ.</h5>
                    <ul class="list-unstyled small">
                        <li class="mb-2 d-flex">
                            <span class="badge bg-secondary rounded-pill me-2">3</span>
                            <span>**KHÔNG** đề cập nội dung tuyển dụng trong thông tin giới thiệu về công ty.</span>
                        </li>
                        <li class="mb-2 d-flex">
                            <span class="badge bg-secondary rounded-pill me-2">4</span>
                            <span>**KHÔNG** để các nội dung như: Tuyển gấp, hot, cần gấp, lương cao. **KHÔNG** sử dụng các ký tự đặc biệt % @ $ ~...</span>
                        </li>
                        <li class="mb-2 d-flex">
                            <span class="badge bg-secondary rounded-pill me-2">5</span>
                            <span>Tin **KHÔNG** được trùng với tin đã đăng trước còn hạn, hoặc ở một tài khoản khác của cùng một doanh nghiệp đã đăng trước.</span>
                        </li>
                        <li class="mb-2 d-flex">
                            <span class="badge bg-secondary rounded-pill me-2">6</span>
                            <span>**KHÔNG** để email liên hệ, số điện thoại liên hệ, website công ty ở các phần nội dung yêu cầu hay mô tả công việc.</span>
                        </li>
                    </ul>
                </div>
            </div>

            <a href="#" class="d-block">
                <img src="https://via.placeholder.com/300x250/{{ substr(str_shuffle('0123456789abcdef'), 0, 6) }}/fff?text=TIET+KIEM+CHI+PHI+%2B+TANG+TOC+TUYEN+DUNG" class="img-fluid rounded-3 shadow-sm" alt="Promotion Banner">
            </a>
        </div>
    </div>
</div>
@endsection
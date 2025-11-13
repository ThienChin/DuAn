@extends('layouts.employer')

@section('title', 'Đăng Tin Tuyển Dụng')

@section('content')
<div class="container-fluid py-4" style="max-width: 1400px;">
    
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-info text-center" role="alert">
                Quý khách đang sử dụng gói tài khoản **MIỄN PHÍ** hoặc tài khoản giới hạn.
                Hãy nâng cấp để có quyền lợi cao hơn như **HIỂN THỊ HỒ SƠ ỨNG VIÊN**...
            </div>
        </div>
    </div>

    {{-- ✨ ĐÃ GIỮ LẠI KHỐI NÀY, LOẠI BỎ KHỐI LẶP LẠI PHÍA TRÊN --}}
    @if(session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-lg-3">
            <div class="list-group shadow-sm bg-white rounded-3 p-3 mb-4">
                <h5 class="mb-3 text-muted">QUẢN LÝ CHUNG</h5>
                <a href="{{ route('employer.dashboard') }}" class="list-group-item list-group-item-action"><i class="bi bi-house-door-fill me-2"></i> Trang chủ Dashboard</a> 
                <a href="{{ route('employer.create') }}" class="list-group-item list-group-item-action active" aria-current="true" style="background-color: var(--gotto-primary); border-color: var(--gotto-primary);"><i class="bi bi-upload me-2"></i> Đăng tin tuyển dụng</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-list-task me-2"></i> Tất cả tuyển dụng</a>

                <h5 class="mt-4 mb-3 text-muted">ỨNG VIÊN</h5>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-bookmark-fill me-2"></i> Hồ sơ đã lưu</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-file-earmark-person me-2"></i> Hồ sơ đã ứng tuyển</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-eye-fill me-2"></i> Hồ sơ đã xem</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-cash me-2"></i> Mua dịch vụ</a>
            </div>
             
             <a href="#">
                <img src="https://via.placeholder.com/300x400/3498db/ffffff?text=DICH+VU+50%+OFF" class="img-fluid rounded-3 shadow-sm" alt="Promotion Banner">
             </a>
        </div>

        <div class="col-lg-9">
            <form method="POST" action="{{ route('employer.store') }}">
                @csrf 

                {{-- QUYỀN LỢI & QUY TẮC --}}
                <div class="card shadow-sm border-0 mb-4 p-3 bg-white">
                    <div class="row">
                        <div class="col-md-8 border-end">
                            <div class="p-3">
                                <h5 class="text-danger fw-bold">QUYỀN LỢI ĐĂNG TUYỂN DỤNG</h5>
                                <p class="small text-muted">Quý khách đang không sử dụng dịch vụ nâng cao, vui lòng liên hệ CSKH để được tư vấn.</p>
                                <div class="row small">
                                    <div class="col-6 mb-2">
                                        <i class="bi bi-check-circle-fill text-success me-2"></i> Được đề xuất ứng viên phù hợp
                                    </div>
                                    <div class="col-6 mb-2">
                                        <i class="bi bi-x-circle-fill text-danger me-2"></i> **Không** giới hạn tin đăng
                                    </div>
                                    <div class="col-6 mb-2">
                                        <i class="bi bi-check-circle-fill text-success me-2"></i> Cho phép chỉnh sửa tin đăng
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3">
                                <h5 class="fw-bold text-success">QUY TẮC ĐĂNG TIN</h5>
                                <ul class="list-unstyled small">
                                    <li class="mb-1"><i class="bi bi-dot me-2"></i> **KHÔNG** sao chép tin đăng của công ty khác.</li>
                                    <li class="mb-1"><i class="bi bi-dot me-2"></i> Tin đăng phải có nội dung **RÕ RÀNG**, phù hợp luật pháp.</li>
                                    <li class="mb-1"><i class="bi bi-dot me-2"></i> **KHÔNG** sử dụng các ký tự đặc biệt % @ $ ~...</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- THÔNG TIN CÔNG VIỆC --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="card-title fw-bold text-primary">THÔNG TIN CÔNG VIỆC</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Vị trí tuyển dụng (Title): <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="VD: Nhân Viên Kinh Doanh..." required>
                            <small class="form-text text-danger">(Lưu ý: Vị trí tuyển dụng **sẽ không được chỉnh sửa** sau khi tin tuyển dụng được duyệt!)</small>
                        </div>
                        
                        <div class="row">
                            {{-- Đã bỏ trường 'Mã số' và 'Số lượng tuyển' --}}
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="level" class="form-label fw-semibold">Cấp bậc (Level): <span class="text-danger">*</span></label>
                                <select class="form-select" id="level" name="level" required>
                                    <option value="Internship">Mới tốt nghiệp / Thực tập sinh</option>
                                    <option value="Junior">Nhân viên (Junior)</option>
                                    <option value="Senior">Trưởng nhóm/Quản lý (Senior)</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="remote_type" class="form-label fw-semibold">Loại hình công việc (Remote Type): <span class="text-danger">*</span></label>
                                <select class="form-select" id="remote_type" name="remote_type" required>
                                    <option value="Full Time">Toàn thời gian</option>
                                    <option value="Part Time">Bán thời gian</option>
                                    <option value="Contract">Hợp đồng</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="salary" class="form-label fw-semibold">Mức lương (Salary): <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="salary" name="salary" placeholder="Nhập mức lương (VD: 10000000)" min="0" step="1000" required>
                                    <span class="input-group-text">VND</span>
                                </div>
                                <small class="form-text text-muted">Nếu muốn Thương lượng, hãy nhập '0' và ghi rõ trong mô tả.</small>
                            </div>
                            
                            <div class="col-md-6 mb-3 pt-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="remote" name="remote">
                                    <label class="form-check-label fw-semibold" for="remote">
                                        Làm việc Online / Từ xa (Remote)
                                    </label>
                                </div>
                                
                                {{-- ✨ THÊM CHECKBOX YÊU CẦU NỔI BẬT --}}
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" value="1" id="request_featured" name="request_featured">
                                    <label class="form-check-label fw-semibold" for="request_featured">
                                        Yêu cầu Tin Nổi Bật (Cần mua gói dịch vụ)
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="location" class="form-label fw-semibold">Địa điểm làm việc (Location): <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="location" name="location" placeholder="Chọn địa điểm làm việc" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="category" class="form-label fw-semibold">Ngành nghề (Category): <span class="text-danger">*</span></label>
                                <select class="form-select" id="category" name="category" required>
                                    <option value="">Chọn ngành nghề</option>
                                    <option value="IT Phần mềm">IT Phần mềm</option>
                                    <option value="Kinh doanh / Bán hàng">Kinh doanh / Bán hàng</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">Mô tả công việc (Description): <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="description" name="description" rows="10" required>
- Nhận đơn hàng qua mail.
- Tìm kiếm khách hàng mới cho công ty...
                            </textarea>
                        </div>
                    </div>
                </div>

                {{-- YÊU CẦU CÔNG VIỆC --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="card-title fw-bold text-primary">YÊU CẦU CÔNG VIỆC</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="experience" class="form-label fw-semibold">Kinh nghiệm:</label>
                                <select class="form-select" id="experience" name="experience">
                                    <option>Không yêu cầu kinh nghiệm</option>
                                    <option>1 - 2 năm</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="degree" class="form-label fw-semibold">Bằng cấp:</label>
                                <select class="form-select" id="degree" name="degree">
                                    <option>Không yêu cầu</option>
                                    <option>Đại học</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="gender" class="form-label fw-semibold">Giới tính:</label>
                                <select class="form-select" id="gender" name="gender">
                                    <option>Không yêu cầu</option>
                                    <option>Nam</option>
                                    <option>Nữ</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="age" class="form-label fw-semibold">Độ tuổi:</label>
                                <input type="text" class="form-control" id="age" name="age" placeholder="VD: 22 - 30 tuổi">
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="required_skills" class="form-label fw-semibold">Kỹ năng / Yêu cầu khác:</label>
                            <textarea class="form-control" id="required_skills" name="required_skills" rows="5" placeholder="Nhập chi tiết các kỹ năng mềm, kiến thức chuyên môn..."></textarea>
                        </div>
                    </div>
                </div>

                {{-- THÔNG TIN CÔNG TY & LIÊN HỆ --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="card-title fw-bold text-primary">THÔNG TIN CÔNG TY & LIÊN HỆ</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label for="company_name" class="form-label fw-semibold">Tên công ty (Company Name): <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="company_name" name="company_name" placeholder="VD: Công ty TNHH Gotto" required>
                        </div>
                        <div class="mb-3">
                            <label for="company_description" class="form-label fw-semibold">Mô tả công ty (Company Description):</label>
                            <textarea class="form-control" id="company_description" name="company_description" rows="3"></textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label fw-semibold">Email liên hệ (Email): <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="tuyendung@company.com" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label fw-semibold">Số điện thoại (Phone):</label>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="0901234567">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="website" class="form-label fw-semibold">Website (Website):</label>
                            <input type="url" class="form-control" id="website" name="website" placeholder="https://company.com">
                        </div>

                        <div class="row">
                             <div class="col-md-6 mb-3">
                                <label for="company_logo_url" class="form-label fw-semibold">Logo công ty (URL):</label>
                                <input type="text" class="form-control" id="company_logo_url" name="company_logo_url" placeholder="Dán link logo công ty">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="jobs_images" class="form-label fw-semibold">Ảnh công việc (URL):</label>
                                <input type="text" class="form-control" id="jobs_images" name="jobs_images" placeholder="Dán link ảnh mô tả công việc">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mb-5">
                    <button type="button" class="btn btn-secondary px-5">HỦY</button>
                    <button type="submit" class="btn btn-success px-5">ĐĂNG TUYỂN</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
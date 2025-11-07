@extends('layouts.catadmin')

@section('content')
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-lg-11 col-xl-9">

            {{-- Main Card --}}
            <div class="card border-0 shadow-lg animate__animated animate__fadeIn">

                {{-- Card Header --}}
                <div class="card-header bg-success text-white p-4 rounded-top-3 d-flex justify-content-between align-items-center">
                    <h4 class="fw-bold m-0 d-flex align-items-center">
                        <i class="bi bi-person-workspace me-3 fs-2"></i>
                        <span class="ms-2">Đăng Tuyển Dụng Mới</span>
                    </h4>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light border-2 px-3 py-2">
                        <i class="bi bi-arrow-left"></i> Quay lại
                    </a>
                </div>

                <div class="card-body p-5">

                    {{-- Errors Block --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4 border-0 shadow-sm" role="alert">
                            <strong class="d-block mb-2">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i> Vui lòng kiểm tra lại thông tin:
                            </strong>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Form --}}
                    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- ===================================
                            JOB INFORMATION
                        ==================================== --}}
                        <h5 class="text-primary border-bottom pb-2 mb-4 mt-3">🔎 Thông tin công việc</h5>
                        <div class="row g-4 mb-4">

                            {{-- Title --}}
                            <div class="col-md-12">
                                <label for="title" class="form-label fw-semibold">Tên Công Việc <span class="text-danger">*</span></label>
                                <input type="text"
                                    class="form-control form-control-lg rounded-3 @error('title') is-invalid @enderror"
                                    id="title" name="title" value="{{ old('title') }}"
                                    placeholder="Ví dụ: Lập trình viên PHP/Laravel Senior">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Description --}}
                            <div class="col-md-12">
                                <label for="description" class="form-label fw-semibold">Mô Tả Công Việc / Yêu Cầu <span class="text-danger">*</span></label>
                                <textarea name="description" id="description" rows="8"
                                    class="form-control rounded-3 form-control-lg @error('description') is-invalid @enderror"
                                    placeholder="Mô tả chi tiết về công việc và các yêu cầu kỹ năng.">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-4 mb-5">
                            {{-- Location --}}
                            <div class="col-md-6">
                                <label for="location" class="form-label fw-semibold">Địa Điểm Làm Việc <span class="text-danger">*</span></label>
                                <input type="text"
                                    class="form-control form-control-lg rounded-3 @error('location') is-invalid @enderror"
                                    id="location" name="location" value="{{ old('location') }}"
                                    placeholder="VD: Quận 1, TP.HCM hoặc Hà Nội">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Salary --}}
                            <div class="col-md-6">
                                <label for="salary" class="form-label fw-semibold">Mức Lương (VND)</label>
                                <input type="text" {{-- Dùng text thay cho number để giữ định dạng tùy ý nếu cần --}}
                                    class="form-control form-control-lg rounded-3 @error('salary') is-invalid @enderror"
                                    id="salary" name="salary" value="{{ old('salary') }}"
                                    placeholder="VD: 15,000,000 - 25,000,000">
                                @error('salary')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-4 mb-5">
                            
                            {{-- TYPE (Đã Thêm!) --}}
                            <div class="col-md-4">
                                <label for="type" class="form-label fw-semibold">Loại Công Việc <span class="text-danger">*</span></label>
                                <select class="form-select form-select-lg rounded-3 @error('type') is-invalid @enderror" id="type" name="type">
                                    <option value="">-- Chọn loại hình --</option>
                                    <option value="Full-time" {{ old('type') == 'Full-time' ? 'selected' : '' }}>🕒 Toàn thời gian</option>
                                    <option value="Part-time" {{ old('type') == 'Part-time' ? 'selected' : '' }}>Half Bán thời gian</option>
                                    <option value="Contract" {{ old('type') == 'Contract' ? 'selected' : '' }}>✍️ Hợp đồng</option>
                                    <option value="Internship" {{ old('type') == 'Internship' ? 'selected' : '' }}>🎓 Thực tập</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            {{-- Level --}}
                            <div class="col-md-4">
                                <label for="level" class="form-label fw-semibold">Cấp Bậc <span class="text-danger">*</span></label>
                                <select class="form-select form-select-lg rounded-3 @error('level') is-invalid @enderror" id="level" name="level">
                                    <option value="">-- Chọn cấp bậc --</option>
                                    <option value="Intern" {{ old('level') == 'Intern' ? 'selected' : '' }}>Thực tập sinh</option>
                                    <option value="Junior" {{ old('level') == 'Junior' ? 'selected' : '' }}>Junior</option>
                                    <option value="Senior" {{ old('level') == 'Senior' ? 'selected' : '' }}>Senior</option>
                                    <option value="Manager" {{ old('level') == 'Manager' ? 'selected' : '' }}>Quản lý</option>
                                </select>
                                @error('level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Remote Type (Giả định trường này là Remote) --}}
                            <div class="col-md-4">
                                <label for="remote_type" class="form-label fw-semibold">Hình Thức Remote</label>
                                <select class="form-select form-select-lg rounded-3 @error('remote_type') is-invalid @enderror" id="remote_type" name="remote_type">
                                    <option value="On-site" {{ old('remote_type') == 'On-site' ? 'selected' : '' }}>📌 Làm tại văn phòng</option>
                                    <option value="Hybrid" {{ old('remote_type') == 'Hybrid' ? 'selected' : '' }}>🔄 Linh hoạt (Hybrid)</option>
                                    <option value="Fully Remote" {{ old('remote_type') == 'Fully Remote' ? 'selected' : '' }}>🏠 Làm việc từ xa (Remote)</option>
                                </select>
                                @error('remote_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        {{-- ===================================
                            COMPANY INFORMATION
                        ==================================== --}}
                        <h5 class="text-info border-bottom pb-2 mb-4">🏢 Thông tin Công ty</h5>
                        <div class="row g-4 mb-5">
                            {{-- Company Name --}}
                            <div class="col-md-6">
                                <label for="company_name" class="form-label fw-semibold">Tên Công ty <span class="text-danger">*</span></label>
                                <input type="text"
                                    class="form-control form-control-lg rounded-3 @error('company_name') is-invalid @enderror"
                                    id="company_name" name="company_name" value="{{ old('company_name') }}"
                                    placeholder="Tập đoàn ABC">
                                @error('company_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            {{-- Image (Logo) --}}
                            <div class="col-md-6">
                                <label for="image" class="form-label fw-semibold">Ảnh Logo Công ty</label>
                                <input type="file" 
                                    class="form-control @error('image') is-invalid @enderror" 
                                    id="image" name="image">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Website --}}
                            <div class="col-md-6">
                                <label for="website" class="form-label fw-semibold">Website Công ty</label>
                                <input type="url"
                                    class="form-control form-control-lg rounded-3 @error('website') is-invalid @enderror"
                                    id="website" name="website" value="{{ old('website') }}"
                                    placeholder="https://company.com">
                                @error('website')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            {{-- Category (Thêm lại vào đây cho hợp lý hơn) --}}
                            <div class="col-md-6">
                                <label for="category" class="form-label fw-semibold">Ngành Nghề</label>
                                <input type="text"
                                    class="form-control form-control-lg rounded-3 @error('category') is-invalid @enderror"
                                    id="category" name="category" value="{{ old('category') }}"
                                    placeholder="VD: Công nghệ thông tin, Kế toán...">
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Company Description --}}
                            <div class="col-md-12">
                                <label for="company_description" class="form-label fw-semibold">Mô tả về Công ty</label>
                                <textarea name="company_description" id="company_description" rows="3"
                                    class="form-control rounded-3 @error('company_description') is-invalid @enderror"
                                    placeholder="Giới thiệu về tầm nhìn, quy mô, văn hóa của công ty...">{{ old('company_description') }}</textarea>
                                @error('company_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        {{-- ===================================
                            CONTACT & OPTIONS
                        ==================================== --}}
                        <h5 class="text-warning border-bottom pb-2 mb-4">📞 Liên hệ & Tùy chọn</h5>
                        <div class="row g-4 mb-5">
                            {{-- Email --}}
                            <div class="col-md-4">
                                <label for="email" class="form-label fw-semibold">Email Liên Hệ</label>
                                <input type="email"
                                    class="form-control form-control-lg rounded-3 @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}"
                                    placeholder="hr@company.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Phone --}}
                            <div class="col-md-4">
                                <label for="phone" class="form-label fw-semibold">Số Điện Thoại</label>
                                <input type="tel"
                                    class="form-control form-control-lg rounded-3 @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" value="{{ old('phone') }}"
                                    placeholder="09xx-xxx-xxx">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Featured Checkbox --}}
                            <div class="col-md-4 d-flex align-items-center pt-2">
                                <div class="form-check form-switch form-check-inline mt-4">
                                    <input class="form-check-input @error('is_featured') is-invalid @enderror" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="is_featured">⭐ Nổi bật (Featured)</label>
                                </div>
                            </div>
                        </div>

                        {{-- Card Footer for Buttons --}}
                        <div class="d-flex justify-content-end gap-3 pt-5 border-top mt-5">
                            <button type="submit" class="btn btn-success btn-lg px-5 rounded-pill shadow-lg">
                                <i class="bi bi-send-fill me-2"></i> Đăng Tuyển Dụng
                            </button>

                            <a href="{{ route('admin.dashboard') }}"
                                class="btn btn-outline-secondary btn-lg px-5 rounded-pill">
                                <i class="bi bi-x-circle me-2"></i> Hủy Bỏ
                            </a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
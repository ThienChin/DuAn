@extends('layouts.employer')

@section('title', 'Chỉnh Sửa Tin Tuyển Dụng')

@section('content')
<div class="container-fluid py-4" style="max-width: 1400px;">
    <div class="row">
        
        {{-- COL 1: SIDEBAR MENU --}}
        <div class="col-lg-3">
            <div class="list-group shadow-sm bg-white rounded-3 p-3 mb-4">
                <h5 class="mb-3 text-muted">GENERAL MANAGEMENT</h5>
                <a href="{{ route('employer.dashboard') }}" class="list-group-item list-group-item-action @if(Route::is('employer.dashboard')) active @endif"><i class="bi bi-house-door-fill me-2"></i> Dashboard Home</a> 
                <a href="{{ route('employer.create') }}" class="list-group-item list-group-item-action @if(Route::is('employer.create')) active @endif"><i class="bi bi-upload me-2"></i> Post New Job</a>
                <a href="{{ route('employer.myJobs') }}" class="list-group-item list-group-item-action @if(Route::is('employer.myJobs')) active @endif"><i class="bi bi-list-task me-2"></i> All Job Postings</a>

                <h5 class="mt-4 mb-3 text-muted">CANDIDATES & APPLICATIONS</h5>
                <a href="{{ route('employer.history') }}" class="list-group-item list-group-item-action @if(Route::is('employer.history')) active @endif"><i class="bi bi-person-lines-fill me-2"></i> Application History</a>
                
                <h5 class="mt-4 mb-3 text-muted">SETTINGS</h5>
                <a href="{{ route('employer.companyInfo') }}" class="list-group-item list-group-item-action"><i class="bi bi-building me-2"></i> Company Info</a>
                <a href="{{ route('employer.accountSettings') }}" class="list-group-item list-group-item-action"><i class="bi bi-gear-fill me-2"></i> Account Settings</a>
                <a href="{{ route('employer.logout') }}" 
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                    class="list-group-item list-group-item-action text-danger">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </a>

                <form id="logout-form" action="{{ route('employer.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>

        {{-- COL 2: FORM CHỈNH SỬA --}}
        <div class="col-lg-9">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-white border-bottom p-3">
                    <h4 class="card-title mb-0">
                        <i class="bi bi-pencil-square me-2 text-warning"></i> Chỉnh Sửa Tin: {{ $job->title }}
                    </h4>
                </div>
                <div class="card-body p-4">
                    
                    <form action="{{ route('employer.updateJob', $job->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- THÔNG BÁO LỖI VÀ THÀNH CÔNG --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">Vui lòng kiểm tra lại các trường thông tin bên dưới.</div>
                        @endif

                        {{-- PHẦN 1: THÔNG TIN CÔNG VIỆC BẮT BUỘC --}}
                        <h5 class="mb-3 text-primary">1. Thông tin công việc bắt buộc</h5>
                        
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Tiêu đề công việc *</label>
                            <input type="text" class="form-control" id="title" name="title" 
                                   value="{{ old('title', $job->title) }}" required>
                        </div>
                        
                        {{-- DÒNG 1: NGÀNH NGHỀ & ĐỊA ĐIỂM --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label fw-semibold">Ngành nghề *</label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    <option value="">-- Chọn Ngành nghề --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" 
                                            {{ old('category_id', $job->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="location_id" class="form-label fw-semibold">Địa điểm làm việc *</label>
                                <select class="form-select" id="location_id" name="location_id" required>
                                    <option value="">-- Chọn Địa điểm --</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}" 
                                            {{ old('location_id', $job->location_id) == $location->id ? 'selected' : '' }}>
                                            {{ $location->value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                         {{-- DÒNG 2: CẤP BẬC & HÌNH THỨC LÀM VIỆC --}}
                         <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="level_id" class="form-label fw-semibold">Cấp bậc *</label>
                                <select class="form-select" id="level_id" name="level_id" required>
                                    <option value="">-- Chọn Cấp bậc --</option>
                                    @foreach($levels as $level)
                                        <option value="{{ $level->id }}" 
                                            {{ old('level_id', $job->level_id) == $level->id ? 'selected' : '' }}>
                                            {{ $level->value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="remote_type_id" class="form-label fw-semibold">Hình thức làm việc *</label>
                                <select class="form-select" id="remote_type_id" name="remote_type_id" required>
                                    <option value="">-- Chọn Hình thức --</option>
                                    @foreach($remote_types as $remote_type)
                                        <option value="{{ $remote_type->id }}" 
                                            {{ old('remote_type_id', $job->remote_type_id) == $remote_type->id ? 'selected' : '' }}>
                                            {{ $remote_type->value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- DÒNG 3: MỨC LƯƠNG & REMOTE CHECKBOX --}}
                        <div class="row align-items-center">
                            <div class="col-md-6 mb-3">
                                <label for="salary" class="form-label fw-semibold">Mức lương (VND)</label>
                                <input type="number" class="form-control" id="salary" name="salary" 
                                       value="{{ old('salary', $job->salary) }}" placeholder="Ví dụ: 10000000">
                                <small class="form-text text-muted">Để trống nếu muốn thương lượng.</small>
                            </div>
                             <div class="col-md-6 mb-3 pt-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remote" name="remote" value="1"
                                           {{ old('remote', $job->remote) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="remote">
                                        Cho phép làm việc từ xa (Remote)
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">Mô tả công việc *</label>
                            <textarea class="form-control" id="description" name="description" rows="8" required>{{ old('description', $job->description) }}</textarea>
                        </div>

                        {{-- PHẦN 2: YÊU CẦU CÔNG VIỆC TÙY CHỌN --}}
                        <h5 class="mb-3 mt-4 text-primary">2. Yêu cầu ứng viên (Tùy chọn)</h5>

                         <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="experience_id" class="form-label fw-semibold">Kinh nghiệm</label>
                                <select class="form-select" id="experience_id" name="experience_id">
                                    <option value="">-- Không yêu cầu --</option>
                                    @foreach($experiences as $experience)
                                        <option value="{{ $experience->id }}" 
                                            {{ old('experience_id', $job->experience_id) == $experience->id ? 'selected' : '' }}>
                                            {{ $experience->value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="degree_id" class="form-label fw-semibold">Bằng cấp</label>
                                <select class="form-select" id="degree_id" name="degree_id">
                                    <option value="">-- Chọn --</option>
                                    @foreach($degrees as $degree)
                                        <option value="{{ $degree->id }}" 
                                            {{ old('degree_id', $job->degree_id) == $degree->id ? 'selected' : '' }}>
                                            {{ $degree->value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="gender_id" class="form-label fw-semibold">Giới tính</label>
                                <select class="form-select" id="gender_id" name="gender_id">
                                    <option value="">-- Không yêu cầu/Tùy chọn --</option>
                                    @foreach($genders as $gender)
                                        <option value="{{ $gender->id }}" 
                                            {{ old('gender_id', $job->gender_id) == $gender->id ? 'selected' : '' }}>
                                            {{ $gender->value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="age" class="form-label fw-semibold">Độ tuổi</label>
                                <input type="text" class="form-control" id="age" name="age" 
                                       value="{{ old('age', $job->age) }}" placeholder="Ví dụ: 22-30">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="required_skills" class="form-label fw-semibold">Kỹ năng yêu cầu</label>
                            <textarea class="form-control" id="required_skills" name="required_skills" rows="3" placeholder="Liệt kê các kỹ năng cần thiết (mỗi dòng một kỹ năng)">{{ old('required_skills', $job->required_skills) }}</textarea>
                        </div>
                        
                         {{-- PHẦN 3: THÔNG TIN CÔNG TY VÀ FILE --}}
                        <h5 class="mb-3 mt-4 text-primary">3. Thông tin Công ty & File</h5>

                        <div class="row">
                             <div class="col-md-6 mb-3">
                                <label for="company_name" class="form-label fw-semibold">Tên công ty *</label>
                                <input type="text" class="form-control" id="company_name" name="company_name" 
                                       value="{{ old('company_name', $job->company_name) }}" required>
                            </div>
                             <div class="col-md-6 mb-3">
                                <label for="email" class="form-label fw-semibold">Email liên hệ *</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="{{ old('email', $job->email) }}" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label fw-semibold">Điện thoại liên hệ</label>
                                <input type="text" class="form-control" id="phone" name="phone" 
                                       value="{{ old('phone', $job->phone) }}">
                            </div>
                             <div class="col-md-6 mb-3">
                                <label for="website" class="form-label fw-semibold">Website công ty</label>
                                <input type="url" class="form-control" id="website" name="website" 
                                       value="{{ old('website', $job->website) }}" placeholder="https://">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="company_description" class="form-label fw-semibold">Mô tả ngắn về công ty</label>
                            <textarea class="form-control" id="company_description" name="company_description" rows="3">{{ old('company_description', $job->company_description) }}</textarea>
                        </div>
                        
                        {{-- UPLOAD FILES --}}
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="company_logo_url_new" class="form-label fw-semibold">Logo công ty (Mới)</label>
                                <input type="file" class="form-control" id="company_logo_url_new" name="company_logo_url_new" accept="image/*">
                                @if($job->company_logo_url)
                                    <small class="text-muted">Đang dùng file: <a href="{{ Storage::url($job->company_logo_url) }}" target="_blank">Xem</a></small>
                                @endif
                            </div>
                             <div class="col-md-6">
                                <label for="jobs_images_new" class="form-label fw-semibold">Ảnh banner (Mới)</label>
                                <input type="file" class="form-control" id="jobs_images_new" name="jobs_images_new" accept="image/*">
                                @if($job->jobs_images)
                                    <small class="text-muted">Đang dùng file: <a href="{{ Storage::url($job->jobs_images) }}" target="_blank">Xem</a></small>
                                @endif
                            </div>
                        </div>
                        
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold">
                                <i class="bi bi-save me-2"></i> CẬP NHẬT TIN TUYỂN DỤNG
                            </button>
                            <a href="{{ route('employer.myJobs') }}" class="btn btn-secondary mt-2">Hủy bỏ</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
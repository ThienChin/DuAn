@extends('layouts.employer')

@section('title', 'Đăng Tin Tuyển Dụng')

@section('content')
<div class="container-fluid py-4" style="max-width: 1400px;">
    
    {{-- ... (Phần thông báo và sidebar giữ nguyên) ... --}}

    <div class="row">
        {{-- COL 1: SIDEBAR MENU (Lấy từ Dashboard/Create) --}}
        <div class="col-lg-3">
            <div class="list-group shadow-sm bg-white rounded-3 p-3 mb-4">
                <h5 class="mb-3 text-muted">QUẢN LÝ CHUNG</h5>
                <a href="{{ route('employer.dashboard') }}" class="list-group-item list-group-item-action @if(Route::is('employer.dashboard')) active @endif"><i class="bi bi-house-door-fill me-2"></i> Trang chủ Dashboard</a> 
                <a href="{{ route('employer.create') }}" class="list-group-item list-group-item-action @if(Route::is('employer.create')) active @endif "><i class="bi bi-upload me-2"></i> Đăng tin tuyển dụng</a>
                {{-- Đánh dấu ACTIVE cho menu này --}}
                <a href="{{ route('employer.myJobs') }}" class="list-group-item list-group-item-action @if(Route::is('employer.myJobs')) active @endif"><i class="bi bi-list-task me-2"></i> Tất cả tuyển dụng</a>

                <h5 class="mt-4 mb-3 text-muted">ỨNG VIÊN & HỒ SƠ</h5>
                <a href="{{ route('employer.history') }}" class="list-group-item list-group-item-action @if(Route::is('employer.history')) active @endif "><i class="bi bi-person-lines-fill me-2"></i> Hồ sơ ứng tuyển</a>
                
                <h5 class="mt-4 mb-3 text-muted">CÀI ĐẶT</h5>
                <a href="" class="list-group-item list-group-item-action"><i class="bi bi-building me-2"></i> Thông tin công ty</a>
                <a href="" class="list-group-item list-group-item-action"><i class="bi bi-gear-fill me-2"></i> Cài đặt tài khoản</a>
                <a href="{{ route('employer.logout') }}" 
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                    class="list-group-item list-group-item-action text-danger">
                    <i class="bi bi-box-arrow-right me-2"></i> Đăng xuất
                </a>

                <form id="logout-form" action="{{ route('employer.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>

        <div class="col-lg-9">
            {{-- CHỈNH SỬA: Thêm enctype để cho phép upload file --}}
            <form action="{{ route('employer.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">1. Thông tin công việc bắt buộc</h4>
                    </div>
                    <div class="card-body">
                        
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold required">Tiêu đề công việc:</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="Ví dụ: Chuyên viên Marketing, Kỹ sư IT..." required>
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label fw-semibold required">Ngành nghề:</label>
                                <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                    <option value="">-- Chọn Ngành Nghề --</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="location_id" class="form-label fw-semibold required">Địa điểm làm việc:</label>
                                <select class="form-select @error('location_id') is-invalid @enderror" id="location_id" name="location_id" required>
                                    <option value="">-- Chọn Địa Điểm --</option>
                                    @foreach ($locations as $loc)
                                        <option value="{{ $loc->id }}" {{ old('location_id') == $loc->id ? 'selected' : '' }}>
                                            {{ $loc->value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('location_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="level_id" class="form-label fw-semibold required">Cấp bậc:</label>
                                <select class="form-select @error('level_id') is-invalid @enderror" id="level_id" name="level_id" required>
                                    <option value="">-- Chọn Cấp Bậc --</option>
                                    @foreach ($levels as $lvl)
                                        <option value="{{ $lvl->id }}" {{ old('level_id') == $lvl->id ? 'selected' : '' }}>
                                            {{ $lvl->value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('level_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="remote_type_id" class="form-label fw-semibold required">Hình thức làm việc:</label>
                                <select class="form-select @error('remote_type_id') is-invalid @enderror" id="remote_type_id" name="remote_type_id" required>
                                    <option value="">-- Chọn Hình Thức --</option>
                                    @foreach ($remote_types as $rt)
                                        <option value="{{ $rt->id }}" {{ old('remote_type_id') == $rt->id ? 'selected' : '' }}>
                                            {{ $rt->value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('remote_type_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="salary" class="form-label fw-semibold">Mức lương (VNĐ):</label>
                                <input type="number" class="form-control @error('salary') is-invalid @enderror" id="salary" name="salary" value="{{ old('salary') }}" placeholder="Ví dụ: 10000000 (Để trống nếu không muốn hiển thị)">
                                @error('salary') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3 d-flex align-items-end">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="remote_job" name="remote" {{ old('remote') ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="remote_job">
                                        Làm việc từ xa (Remote)
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold required">Mô tả công việc:</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h4 class="mb-0">2. Yêu cầu công việc (Tùy chọn)</h4>
                    </div>
                    <div class="card-body">
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="experience_id" class="form-label fw-semibold">Kinh nghiệm:</label>
                                <select class="form-select @error('experience_id') is-invalid @enderror" id="experience_id" name="experience_id">
                                    <option value="">-- Không yêu cầu/Chọn --</option>
                                    @foreach ($experiences as $exp)
                                        <option value="{{ $exp->id }}" {{ old('experience_id') == $exp->id ? 'selected' : '' }}>
                                            {{ $exp->value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('experience_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="degree_id" class="form-label fw-semibold">Bằng cấp:</label>
                                <select class="form-select @error('degree_id') is-invalid @enderror" id="degree_id" name="degree_id">
                                    <option value="">-- Không yêu cầu/Chọn --</option>
                                    @foreach ($degrees as $deg)
                                        <option value="{{ $deg->id }}" {{ old('degree_id') == $deg->id ? 'selected' : '' }}>
                                            {{ $deg->value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('degree_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="gender_id" class="form-label fw-semibold">Giới tính:</label>
                                <select class="form-select @error('gender_id') is-invalid @enderror" id="gender_id" name="gender_id">
                                    <option value="">-- Không yêu cầu/Chọn --</option>
                                    @foreach ($genders as $gen)
                                        <option value="{{ $gen->id }}" {{ old('gender_id') == $gen->id ? 'selected' : '' }}>
                                            {{ $gen->value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('gender_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="age" class="form-label fw-semibold">Độ tuổi:</label>
                                <input type="text" class="form-control @error('age') is-invalid @enderror" id="age" name="age" value="{{ old('age') }}" placeholder="Ví dụ: 22-30 tuổi">
                                @error('age') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="required_skills" class="form-label fw-semibold">Kỹ năng yêu cầu:</label>
                            <textarea class="form-control @error('required_skills') is-invalid @enderror" id="required_skills" name="required_skills" rows="3" placeholder="Liệt kê các kỹ năng cần thiết...">{{ old('required_skills') }}</textarea>
                            @error('required_skills') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
                
                {{-- ... (Phần thông tin công ty và nút submit giữ nguyên) ... --}}
                
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0">3. Thông tin Công ty và Liên hệ</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="company_name" class="form-label fw-semibold required">Tên công ty:</label>
                            <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" value="{{ old('company_name') }}" required>
                            @error('company_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="company_description" class="form-label fw-semibold">Mô tả công ty:</label>
                            <textarea class="form-control @error('company_description') is-invalid @enderror" id="company_description" name="company_description" rows="3">{{ old('company_description') }}</textarea>
                            @error('company_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold required">Email liên hệ (Email):</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required placeholder="contact@company.com">
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label fw-semibold">Số điện thoại (Phone):</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="090...">
                            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="website" class="form-label fw-semibold">Website (Website):</label>
                            <input type="url" class="form-control @error('website') is-invalid @enderror" id="website" name="website" value="{{ old('website') }}" placeholder="https://company.com">
                            @error('website') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                             <div class="col-md-6 mb-3">
                                <label for="company_logo_url" class="form-label fw-semibold">Logo công ty (Chọn File):</label>
                                <input type="file" class="form-control @error('company_logo_url') is-invalid @enderror" id="company_logo_url" name="company_logo_url">
                                @error('company_logo_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="jobs_images" class="form-label fw-semibold">Ảnh công việc (Chọn File):</label>
                                <input type="file" class="form-control @error('jobs_images') is-invalid @enderror" id="jobs_images" name="jobs_images">
                                @error('jobs_images') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mb-5">
                    <a href="{{ route('employer.dashboard') }}" class="btn btn-secondary px-5">HỦY</a>
                    <button type="submit" class="btn btn-success px-5">ĐĂNG TUYỂN</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
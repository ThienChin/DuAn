@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-10 offset-lg-1">
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom">
                <h3 class="card-title text-dark mb-0">
                    <i class="mdi mdi-pencil me-2 text-primary"></i> 
                    Chỉnh Sửa Tin Tuyển Dụng: {{ $job->title }}
                </h3>
            </div>
            
            <div class="card-body">
                
                {{-- HIỂN THỊ LỖI VALIDATION --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Vui lòng kiểm tra lại:</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                {{-- FORM CẬP NHẬT - enctype cho upload file --}}
                <form method="POST" action="{{ route('admin.jobs.update', $job->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    {{-- Trạng thái & Tùy chọn nổi bật --}}
                    <div class="row mb-4 bg-light p-3 rounded">
                        <div class="col-md-6">
                            <label for="status" class="form-label fw-bold">Trạng thái:</label>
                            <select class="form-control" id="status" name="status">
                                <option value="pending" {{ old('status', $job->status) === 'pending' ? 'selected' : '' }}>Chờ Duyệt</option>
                                <option value="approved" {{ old('status', $job->status) === 'approved' ? 'selected' : '' }}>Đã Duyệt</option>
                                <option value="rejected" {{ old('status', $job->status) === 'rejected' ? 'selected' : '' }}>Từ Chối</option>
                            </select>
                        </div>
                        <div class="col-md-6 pt-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="is_featured" name="is_featured" {{ old('is_featured', $job->is_featured) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="is_featured">
                                    Tin Nổi Bật
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" value="1" id="remote" name="remote" {{ old('remote', $job->remote) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="remote">
                                    Làm Việc Từ Xa
                                </label>
                            </div>
                        </div>
                    </div>

                    <h5 class="mb-3 text-secondary">Thông Tin Cơ Bản</h5>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="title" class="form-label">Tiêu đề <span class="text-danger">*</span>:</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $job->title) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="company_name" class="form-label">Tên Công ty <span class="text-danger">*</span>:</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name', $job->company_name) }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="location_id" class="form-label">Địa điểm:</label>
                            <select class="form-control" id="location_id" name="location_id">
                                <option value="">--- Chọn Địa điểm ---</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}" {{ old('location_id', $job->location_id) == $location->id ? 'selected' : '' }}>
                                        {{ $location->value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="level_id" class="form-label">Cấp bậc:</label>
                            <select class="form-control" id="level_id" name="level_id">
                                <option value="">--- Chọn Cấp bậc ---</option>
                                @foreach ($levels as $level)
                                    <option value="{{ $level->id }}" {{ old('level_id', $job->level_id) == $level->id ? 'selected' : '' }}>
                                        {{ $level->value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="salary" class="form-label">Mức lương (VND):</label>
                            <input type="number" class="form-control" id="salary" name="salary" value="{{ old('salary', $job->salary) }}" min="0">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="category_id" class="form-label">Ngành nghề:</label>
                            <select class="form-control" id="category_id" name="category_id">
                                <option value="">--- Chọn Ngành nghề ---</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $job->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="experience_id" class="form-label">Kinh nghiệm:</label>
                            <select class="form-control" id="experience_id" name="experience_id">
                                <option value="">--- Chọn Kinh nghiệm ---</option>
                                @foreach ($experiences as $experience)
                                    <option value="{{ $experience->id }}" {{ old('experience_id', $job->experience_id) == $experience->id ? 'selected' : '' }}>
                                        {{ $experience->value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="remote_type" class="form-label">Loại hình:</label>
                            <select class="form-control" id="remote_type" name="remote_type">
                                <option value="">--- Chọn Loại hình ---</option>
                                <option value="Full Time" {{ old('remote_type', $job->remote_type) === 'Full Time' ? 'selected' : '' }}>Full Time</option>
                                <option value="Part Time" {{ old('remote_type', $job->remote_type) === 'Part Time' ? 'selected' : '' }}>Part Time</option>
                                <option value="Contract" {{ old('remote_type', $job->remote_type) === 'Contract' ? 'selected' : '' }}>Contract</option>
                            </select>
                        </div>
                    </div>

                    <h5 class="mb-3 text-secondary">Yêu Cầu Ứng Viên</h5>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="gender_id" class="form-label">Giới tính:</label>
                            <select class="form-control" id="gender_id" name="gender_id">
                                <option value="">--- Chọn Giới tính ---</option>
                                @foreach ($genders as $gender)
                                    <option value="{{ $gender->id }}" {{ old('gender_id', $job->gender_id) == $gender->id ? 'selected' : '' }}>
                                        {{ $gender->value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="degree_id" class="form-label">Bằng cấp:</label>
                            <select class="form-control" id="degree_id" name="degree_id">
                                <option value="">--- Chọn Bằng cấp ---</option>
                                @foreach ($degrees as $degree)
                                    <option value="{{ $degree->id }}" {{ old('degree_id', $job->degree_id) == $degree->id ? 'selected' : '' }}>
                                        {{ $degree->value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="age" class="form-label">Độ tuổi:</label>
                            <input type="text" class="form-control" id="age" name="age" value="{{ old('age', $job->age) }}" placeholder="Ví dụ: 22-35">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả công việc <span class="text-danger">*</span>:</label>
                        <textarea class="form-control" id="description" name="description" rows="8" required>{{ old('description', $job->description) }}</textarea>
                    </div>

                    {{-- Upload Ảnh --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="company_logo_url" class="form-label">Logo công ty:</label>
                            <input type="file" class="form-control" id="company_logo_url" name="company_logo_url" accept="image/*">
                            @if($job->company_logo_url)
                                <small class="text-success">Đã có logo</small>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="jobs_images" class="form-label">Ảnh tin tuyển dụng:</label>
                            <input type="file" class="form-control" id="jobs_images" name="jobs_images" accept="image/*">
                            @if($job->jobs_images)
                                <small class="text-success">Đã có ảnh</small>
                            @endif
                        </div>
                    </div>

                    {{-- NÚT HÀNH ĐỘNG --}}
                    <div class="d-flex justify-content-end mt-4 gap-2">
                        <a href="{{ route('admin.jobs.show', $job->id) }}" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left"></i> Quay lại
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-content-save"></i> Lưu Thay Đổi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
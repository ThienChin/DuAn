@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-10 offset-lg-1">
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom">
                <h3 class="card-title text-dark mb-0">
                    <i class="mdi mdi-pencil me-2 text-primary"></i> Chỉnh Sửa Tin Tuyển Dụng: {{ $job->title }}
                </h3>
            </div>
            
            <div class="card-body">
                
                {{-- HIỂN THỊ TẤT CẢ LỖI (Quan trọng cho Admin) --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        Vui lòng kiểm tra lại các trường bị lỗi.
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                {{-- FORM CẬP NHẬT --}}
                <form method="POST" action="{{ route('admin.jobs.update', $job->id) }}">
                    @csrf
                    @method('PUT')
                    
                    {{-- Thông tin Trạng thái và Featured --}}
                    <div class="row mb-4 bg-light p-3 rounded">
                        <div class="col-md-6">
                            <label for="status" class="form-label fw-bold">Trạng thái (Status):</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="pending" {{ old('status', $job->status) === 'pending' ? 'selected' : '' }}>Chờ Duyệt</option>
                                <option value="approved" {{ old('status', $job->status) === 'approved' ? 'selected' : '' }}>Đã Duyệt</option>
                                <option value="rejected" {{ old('status', $job->status) === 'rejected' ? 'selected' : '' }}>Từ Chối</option>
                            </select>
                        </div>
                        <div class="col-md-6 pt-4">
                             <div class="form-check mt-1">
                                <input class="form-check-input" type="checkbox" value="1" id="is_featured" name="is_featured" {{ old('is_featured', $job->is_featured) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="is_featured">
                                    Tin Nổi Bật (Featured)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="remote" name="remote" {{ old('remote', $job->remote) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="remote">
                                    Làm việc Từ Xa (Remote)
                                </label>
                            </div>
                        </div>
                    </div>

                    <h5 class="mb-3 text-secondary">Thông Tin Cơ Bản</h5>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="title" class="form-label">Tiêu đề:</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $job->title) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="company_name" class="form-label">Tên Công ty:</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name', $job->company_name) }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="location" class="form-label">Địa điểm:</label>
                            <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $job->location) }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="level" class="form-label">Cấp bậc:</label>
                            <select class="form-control" id="level" name="level" required>
                                <option value="Internship" {{ old('level', $job->level) === 'Internship' ? 'selected' : '' }}>Internship</option>
                                <option value="Junior" {{ old('level', $job->level) === 'Junior' ? 'selected' : '' }}>Junior</option>
                                <option value="Senior" {{ old('level', $job->level) === 'Senior' ? 'selected' : '' }}>Senior</option>
                            </select>
                        </div>
                         <div class="col-md-4 mb-3">
                            <label for="salary" class="form-label">Mức lương:</label>
                            <input type="number" class="form-control" id="salary" name="salary" value="{{ old('salary', $job->salary) }}" min="0">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="remote_type" class="form-label">Loại hình:</label>
                            {{-- ✨ ĐÃ THÊM: remote_type --}}
                            <select class="form-control" id="remote_type" name="remote_type" required>
                                <option value="Full Time" {{ old('remote_type', $job->remote_type) === 'Full Time' ? 'selected' : '' }}>Full Time</option>
                                <option value="Part Time" {{ old('remote_type', $job->remote_type) === 'Part Time' ? 'selected' : '' }}>Part Time</option>
                                <option value="Contract" {{ old('remote_type', $job->remote_type) === 'Contract' ? 'selected' : '' }}>Contract</option>
                            </select>
                        </div>
                         <div class="col-md-4 mb-3">
                            <label for="category" class="form-label">Ngành nghề:</label>
                             {{-- ✨ ĐÃ THÊM: category --}}
                            <input type="text" class="form-control" id="category" name="category" value="{{ old('category', $job->category) }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="experience" class="form-label">Kinh nghiệm:</label>
                             {{-- ✨ ĐÃ THÊM: experience --}}
                            <input type="text" class="form-control" id="experience" name="experience" value="{{ old('experience', $job->experience) }}">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả Công việc:</label>
                        <textarea class="form-control" id="description" name="description" rows="8" required>{{ old('description', $job->description) }}</textarea>
                    </div>

                    {{-- NÚT LƯU --}}
                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('admin.jobs.show', $job->id) }}" class="btn btn-secondary me-2">Hủy bỏ</a>
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
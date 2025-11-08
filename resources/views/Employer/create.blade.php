@extends('layouts.employer')

@section('title', 'Đăng tin tuyển dụng')

@section('content')
<div class="container py-5">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-5">
            <h3 class="fw-bold text-success mb-4">Đăng tin tuyển dụng</h3>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('Employer.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Tiêu đề *</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Cấp độ *</label>
                        <select name="level" class="form-select" required>
                            <option value="">-- Chọn cấp độ --</option>
                            <option>Internship</option>
                            <option>Junior</option>
                            <option>Senior</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Hình thức làm việc *</label>
                        <select name="remote_type" class="form-select" required>
                            <option value="">-- Chọn hình thức --</option>
                            <option>Full Time</option>
                            <option>Part Time</option>
                            <option>Contract</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Lương (VND) *</label>
                    <input type="number" step="0.01" name="salary" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Địa điểm *</label>
                    <input type="text" name="location" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Danh mục</label>
                    <input type="text" name="category" class="form-control" placeholder="VD: IT, Marketing...">
                </div>

                <div class="mb-3">
                    <label class="form-label">Mô tả công việc *</label>
                    <textarea name="description" rows="5" class="form-control" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tên công ty *</label>
                    <input type="text" name="company_name" class="form-control" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Số điện thoại</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Website</label>
                    <input type="url" name="website" class="form-control">
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="is_featured" value="1">
                    <label class="form-check-label">Tin tuyển dụng nổi bật</label>
                </div>

                <button type="submit" class="btn btn-success px-4">Đăng tin</button>
            </form>
        </div>
    </div>
</div>
@endsection

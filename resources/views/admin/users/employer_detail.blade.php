@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                <h3 class="card-title text-dark mb-0">
                    <i class="mdi mdi-bank me-2 text-info"></i> Chi Tiết Nhà Tuyển Dụng: {{ $employer->company_name }}
                </h3>
                <a href="{{ route('admin.users.employers') }}" class="btn btn-sm btn-secondary">
                    <i class="mdi mdi-arrow-left"></i> Quay lại danh sách
                </a>
            </div>
            
            <div class="card-body">
                <div class="row">
                    
                    {{-- Cột 1: Thông tin Công ty & Liên hệ --}}
                    <div class="col-lg-6 mb-4 border-right">
                        <h4 class="mb-3 text-primary border-bottom pb-2">Thông Tin Công Ty</h4>
                        <ul class="list-unstyled detail-list">
                            <li class="mb-2"><strong>Tên công ty:</strong> {{ $employer->company_name }}</li>
                            <li class="mb-2"><strong>Người đại diện:</strong> {{ $employer->name }}</li>
                            <li class="mb-2"><strong>Chức vụ:</strong> {{ $employer->position ?? 'N/A' }}</li>
                            <li class="mb-2"><strong>Email:</strong> <a href="mailto:{{ $employer->email }}">{{ $employer->email }}</a></li>
                            <li class="mb-2"><strong>Phone:</strong> {{ $employer->phone ?? 'N/A' }}</li>
                            <li class="mb-2"><strong>Địa chỉ:</strong> {{ $employer->address ?? 'N/A' }}</li>
                            <li class="mb-2"><strong>Website:</strong> <a href="{{ $employer->website }}" target="_blank">{{ $employer->website ?? 'N/A' }}</a></li>
                            <li class="mb-2"><strong>Ngày đăng ký:</strong> {{ \Carbon\Carbon::parse($employer->created_at)->format('d/m/Y H:i') }}</li>
                            {{-- Bạn có thể thêm nút Khóa/Mở khóa ở đây sau khi tạo logic đó --}}
                        </ul>
                    </div>

                    {{-- Cột 2: Mô tả & Thống kê --}}
                        <div class="col-lg-6 mb-4">
                            {{-- Phần mô tả công ty giữ nguyên --}}
                            <h4 class="mb-3 text-primary border-bottom pb-2">Mô Tả & Thông Tin Khác</h4>
                            <div class="p-2 border rounded bg-light text-muted small" style="min-height: 150px; white-space: pre-line;">
                                {{ $employer->description ?? 'Không có mô tả về công ty.' }}
                            </div>
                            
                            {{-- ✨ PHẦN THÔNG TIN HOẠT ĐỘNG MỚI ✨ --}}
                            <h4 class="mt-4 mb-3 text-primary border-bottom pb-2">Thống Kê Hoạt Động Đăng Tin</h4>
                            
                            <ul class="list-unstyled detail-list">
                                <li class="mb-2"><strong>Tổng số tin đã đăng:</strong> <span class="badge bg-secondary">{{ $totalJobs }}</span></li> 
                                <li class="mb-2"><strong>Tin đang hoạt động (Đã duyệt):</strong> <span class="badge bg-success">{{ $activeJobs }}</span></li>
                                <li class="mb-2"><strong>Tin chờ duyệt:</strong> <span class="badge bg-warning">{{ $pendingJobs }}</span></li>
                                <li class="mb-2"><strong>Tin đã từ chối:</strong> <span class="badge bg-danger">{{ $rejectedJobs }}</span></li>
                            </ul>

                            {{-- NÚT XEM DANH SÁCH JOB ĐÃ LỌC --}}
                            <div class="mt-4">
                                <a href="{{ route('admin.jobs.employer_index', $employer->id) }}" class="btn btn-primary">
                                    <i class="mdi mdi-format-list-bulleted me-1"></i> Xem Tất Cả Tin Tuyển Dụng
                                </a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
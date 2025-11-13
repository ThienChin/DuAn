@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                <h3 class="card-title text-dark mb-0">
                    <i class="mdi mdi-account-card-details me-2 text-info"></i> Chi Tiết Ứng Viên: {{ $user->name }}
                </h3>
                <a href="{{ route('admin.users.candidates') }}" class="btn btn-sm btn-secondary">
                    <i class="mdi mdi-arrow-left"></i> Quay lại danh sách
                </a>
            </div>
            
            <div class="card-body">
                <div class="row">
                    
                    {{-- Cột 1: Thông tin cơ bản & Hành động sửa --}}
                    <div class="col-lg-6 mb-4 border-right">
                        <h4 class="mb-3 text-primary border-bottom pb-2">Thông Tin Cá Nhân & Hành động</h4>
                        <ul class="list-unstyled detail-list">
                            <li class="mb-2"><strong>ID Ứng Viên:</strong> {{ $user->id }}</li>
                            
                            {{-- Nút Sửa Thông Tin --}}
                            <li class="mb-3">
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal">
                                    <i class="mdi mdi-pencil-box-outline me-1"></i> Sửa Thông Tin
                                </button>
                            </li>
                            
                            {{-- Hiển thị thông tin sau khi có thể sửa --}}
                            <li class="mb-2"><strong>Tên:</strong> {{ $user->name }}</li>
                            <li class="mb-2"><strong>Email:</strong> <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></li>
                            <li class="mb-2"><strong>Ngày đăng ký:</strong> {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i') }}</li>
                            <li class="mb-2"><strong>Trạng thái Email:</strong> {{ $user->email_verified_at ? 'Đã xác minh' : 'Chưa xác minh' }}</li>
                            
                            
                            <h4 class="mt-4 mb-3 text-primary border-bottom pb-2">Hồ sơ & CV</h4>
                            <li class="mb-2 d-flex flex-wrap align-items-center">
                                <strong>Đường dẫn CV:</strong> 
                                @if ($user->cv_path)
                                    {{-- Nút Xem/Tải CV --}}
                                    <a href="{{ asset('storage/' . $user->cv_path) }}" target="_blank" class="btn btn-sm btn-primary ms-2 me-2">Xem/Tải CV</a>
                                    
                                    {{-- **THAO TÁC CV: Nút Xóa CV** --}}
                                    <form action="{{ route('admin.users.delete_cv', $user->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa CV này?')" class="d-inline me-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="mdi mdi-delete"></i> Xóa CV</button>
                                    </form>
                                @else
                                    <span class="ms-2 me-2">N/A</span>
                                @endif
                                
                                {{-- **THAO TÁC CV: Nút Tải lên CV mới** --}}
                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#uploadCvModal">
                                    <i class="mdi mdi-upload"></i> Tải lên CV mới
                                </button>
                            </li>
                        </ul>
                    </div>

                    {{-- Cột 2: Thống kê & Lịch sử --}}
                    <div class="col-lg-6 mb-4">
                        <h4 class="mb-3 text-primary border-bottom pb-2">Thống Kê Ứng Tuyển</h4>
                        <ul class="list-unstyled detail-list">
                            {{-- Dữ liệu này vẫn là placeholder, cần xử lý ở Controller/Model --}}
                            <li class="mb-2"><strong>Tổng số lần ứng tuyển:</strong> [Số lần ứng tuyển]</li> 
                            <li class="mb-2"><strong>Hồ sơ đã lưu:</strong> [Số lượng hồ sơ đã lưu]</li>
                            <li class="mb-2"><strong>Lần hoạt động cuối:</strong> [Thời gian hoạt động cuối]</li>
                        </ul>
                        
                        <h4 class="mt-4 mb-3 text-primary border-bottom pb-2">Hành động Admin</h4>
                        {{-- Hành động Khóa Tài Khoản --}}
                        <button class="btn btn-danger"><i class="mdi mdi-lock"></i> Khóa Tài Khoản (Ví dụ)</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
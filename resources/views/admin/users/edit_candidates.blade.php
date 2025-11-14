@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                <h3 class="card-title text-dark mb-0">
                    <i class="mdi mdi-pencil me-2 text-warning"></i> Chỉnh Sửa Thông Tin Ứng Viên: **{{ $user->name }}**
                </h3>
                <a href="{{ route('admin.users.candidate_show', $user->id) }}" class="btn btn-sm btn-secondary">
                    <i class="mdi mdi-arrow-left"></i> Quay lại chi tiết
                </a>
            </div>
            
            <div class="card-body">
                
                {{-- Bắt đầu Form Chỉnh Sửa --}}
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    {{-- Thông báo lỗi chung nếu có --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            **Lỗi Validation!** Vui lòng kiểm tra lại các trường dữ liệu dưới đây.
                        </div>
                    @endif
                    
                    <div class="row">
                        <div class="col-md-6">
                            {{-- Trường Tên Ứng Viên --}}
                            <div class="mb-3">
                                <label for="edit_name" class="form-label">Tên Ứng Viên</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="edit_name" name="name" 
                                       value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            {{-- Trường Email --}}
                            <div class="mb-3">
                                <label for="edit_email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="edit_email" name="email" 
                                       value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <h5 class="mt-4 mb-3 text-primary border-bottom pb-2">Thay Đổi Mật Khẩu (Không bắt buộc)</h5>
                    
                    <div class="row">
                        <div class="col-md-6">
                            {{-- Trường Mật khẩu mới --}}
                            <div class="mb-3">
                                <label for="edit_password" class="form-label">Mật khẩu mới</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="edit_password" name="password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Bỏ trống nếu không muốn thay đổi.</small>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            {{-- Trường Xác nhận Mật khẩu --}}
                            <div class="mb-3">
                                <label for="edit_password_confirmation" class="form-label">Xác nhận Mật khẩu mới</label>
                                <input type="password" class="form-control" 
                                       id="edit_password_confirmation" name="password_confirmation">
                            </div>
                        </div>
                    </div>
                    
                    {{-- Nút Submit --}}
                    <div class="border-top p-t-20 mt-4">
                        <button type="submit" class="btn btn-warning me-2">
                            <i class="mdi mdi-content-save"></i> Lưu Thay Đổi
                        </button>
                        <a href="{{ route('admin.users.candidate_show', $user->id) }}" class="btn btn-secondary">Hủy</a>
                    </div>
                </form>
                {{-- Kết thúc Form --}}

            </div>
        </div>
    </div>
</div>
@endsection
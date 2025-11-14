@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            {{-- Header --}}
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
                            
                            {{-- Nút Sửa Thông Tin (Mở Modal/Chuyển trang) --}}
                            <li class="mb-3">
                                <a href="{{ route('admin.users.edit', $user->id) }}" 
                                class="btn btn-warning btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editUserModal">
                                    <i class="mdi mdi-pencil-box-outline me-1"></i> Sửa Thông Tin
                                </a>
                            </li>
                                                                
                            {{-- Hiển thị thông tin --}}
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
                            </li>
                        </ul>
                    </div>

                    {{-- Cột 2: Thống kê & Hành động --}}
                    <div class="col-lg-6 mb-4">
                        <h4 class="mb-3 text-primary border-bottom pb-2">Thống Kê Hoạt Động</h4>
                        <ul class="list-unstyled detail-list">
                            <li class="mb-2"><strong>Tổng số lần ứng tuyển:</strong> {{ $stats['total_applications'] ?? 0 }}</li> 
                            <li class="mb-2"><strong>Tổng CV/Hồ sơ đã tạo:</strong> {{ $stats['total_created_cvs'] ?? 0 }}</li>
                            <li class="mb-2"><strong>Tổng files tải lên khác:</strong> {{ $stats['total_files_uploaded'] ?? 0 }}</li>
                            <li class="mb-2"><strong>Lần hoạt động cuối:</strong> {{ $stats['last_activity'] ?? 'Chưa rõ' }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            {{-- Bảng Lịch Sử Ứng Tuyển --}}
            <div class="card-footer bg-white border-top">
                <h4 class="mb-3 text-primary border-bottom pb-2"><i class="mdi mdi-history me-2"></i> Lịch Sử Ứng Tuyển</h4>
                
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="bg-info text-white">
                            <tr>
                                <th>ID</th>
                                <th>Công việc Ứng tuyển</th>
                                <th>Ngày Ứng tuyển</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($applications as $app)
                                <tr>
                                    <td>{{ $app->id }}</td>
                                    <td>
                                        {{-- Giả định mỗi JobApplication liên kết với 1 Job qua $app->job --}}
                                        <a href="{{ route('admin.jobs.show', $app->job_id) }}" target="_blank">
                                            {{ $app->job->title ?? 'Công việc đã xóa' }} 
                                        </a>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($app->created_at)->format('d/m/Y H:i') }}</td>
                                    <td>
                                        {{-- Hiển thị trạng thái --}}
                                        <span class="badge 
                                            @if ($app->status == 'pending') bg-warning text-dark 
                                            @elseif ($app->status == 'accepted') bg-success 
                                            @elseif ($app->status == 'rejected') bg-danger 
                                            @else bg-secondary @endif">
                                            {{ ucfirst($app->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.users.applications.show', $app->id) }}" class="btn btn-sm btn-info text-white">
                                            <i class="mdi mdi-eye"></i> Xem Đơn
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted p-3">Ứng viên này chưa từng ứng tuyển công việc nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                {{-- Phân trang --}}
                <div class="d-flex justify-content-center mt-3">{{ $applications->links() }}</div>

            </div>
            
        </div>
    </div>
</div>
@endsection

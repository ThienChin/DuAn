@extends('layouts.employer')

@section('title', 'Tất Cả Tuyển Dụng')

@section('content')
<div class="container-fluid py-4" style="max-width: 1400px;">
    <div class="row">
        
        {{-- COL 1: SIDEBAR MENU (Lấy từ Dashboard/Create) --}}
        <div class="col-lg-3">
            <div class="list-group shadow-sm bg-white rounded-3 p-3 mb-4">
                <h5 class="mb-3 text-muted">QUẢN LÝ CHUNG</h5>
                <a href="{{ route('employer.dashboard') }}" class="list-group-item list-group-item-action"><i class="bi bi-house-door-fill me-2"></i> Trang chủ Dashboard</a> 
                <a href="{{ route('employer.create') }}" class="list-group-item list-group-item-action"><i class="bi bi-upload me-2"></i> Đăng tin tuyển dụng</a>
                {{-- Đánh dấu ACTIVE cho menu này --}}
                <a href="{{ route('employer.myJobs') }}" class="list-group-item list-group-item-action active" aria-current="true" style="background-color: var(--gotto-primary); border-color: var(--gotto-primary);"><i class="bi bi-list-task me-2"></i> Tất cả tuyển dụng</a>

                <h5 class="mt-4 mb-3 text-muted">ỨNG VIÊN & HỒ SƠ</h5>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-person-lines-fill me-2"></i> Hồ sơ ứng tuyển</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-cash me-2"></i> Mua dịch vụ</a>
                
                <h5 class="mt-4 mb-3 text-muted">CÀI ĐẶT</h5>
                <a href="" class="list-group-item list-group-item-action"><i class="bi bi-building me-2"></i> Thông tin công ty</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-gear-fill me-2"></i> Cài đặt tài khoản</a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="list-group-item list-group-item-action text-danger">
                    <i class="bi bi-box-arrow-right me-2"></i> Đăng xuất
                </a>
            </div>
        </div>

        {{-- COL 2: NỘI DUNG CHÍNH --}}
        <div class="col-lg-9">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">
                        <i class="bi bi-list-task me-2 text-primary"></i> Danh Sách Tin Tuyển Dụng Đã Đăng
                    </h4>
                    <a href="{{ route('employer.create') }}" class="btn btn-sm btn-success">
                        <i class="bi bi-plus-circle-fill me-1"></i> Đăng tin mới
                    </a>
                </div>

                <div class="card-body p-0">
                    @if(session('success'))
                        <div class="alert alert-success m-3">{{ session('success') }}</div>
                    @endif
                    
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th style="width: 30%;">Tiêu đề</th>
                                    <th>Mức lương</th>
                                    <th>Cấp bậc</th>
                                    <th>Ngày đăng</th>
                                    <th>Trạng thái</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jobs as $job)
                                <tr>
                                    <td>
                                        <div class="fw-bold">{{ $job->title }}</div>
                                        <div class="small text-muted">{{ $job->locationItem->value ?? 'N/A' }}</div>
                                    </td>
                                    <td>{{ number_format($job->salary) }} đ</td>
                                    <td>{{ $job->levelItem->value ?? 'N/A' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($job->posted_at)->format('d/m/Y') }}</td>
                                    
                                    <td>
                                        {{-- Hiển thị trạng thái bằng Badge --}}
                                        @if($job->status == 'pending')
                                            <span class="badge bg-warning text-dark">Chờ duyệt</span>
                                        @elseif($job->status == 'approved')
                                            <span class="badge bg-success">Đã duyệt</span>
                                        @else
                                            <span class="badge bg-danger">Bị từ chối</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        {{-- Nút Hành động --}}
                                        <a href="" class="btn btn-sm btn-info text-white me-1" title="Xem Ứng Tuyển">
                                            <i class="bi bi-people-fill"></i> (0)
                                        </a>
                                        <a href="" class="btn btn-sm btn-warning me-1" title="Chỉnh Sửa">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger" title="Xóa">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach

                                @if($jobs->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center text-muted p-4">
                                            Bạn chưa đăng tin tuyển dụng nào.
                                            <a href="{{ route('employer.create') }}" class="btn btn-sm btn-link">Đăng ngay!</a>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{-- Thêm phân trang nếu $jobs là đối tượng phân trang: {{ $jobs->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
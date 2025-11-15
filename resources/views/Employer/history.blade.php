@extends('layouts.employer') 

@section('title', 'Hồ sơ đã ứng tuyển')

@section('content')
<div class="container-fluid py-4" style="max-width: 1400px;">
    <div class="row">
        {{-- COL-LG-3: THANH MENU BÊN TRÁI (Giữ nguyên) --}}
        <div class="col-lg-3">
            <div class="list-group shadow-sm bg-white rounded-3 p-3 mb-4">
                <h5 class="mb-3 text-muted">QUẢN LÝ CHUNG</h5>
                <a href="{{ route('employer.dashboard') }}" class="list-group-item list-group-item-action @if(Route::is('employer.dashboard')) active @endif"><i class="bi bi-house-door-fill me-2"></i> Trang chủ Dashboard</a> 
                <a href="{{ route('employer.create') }}" class="list-group-item list-group-item-action @if(Route::is('employer.create')) active @endif"><i class="bi bi-upload me-2"></i> Đăng tin tuyển dụng</a>
                <a href="{{ route('employer.myJobs') }}" class="list-group-item list-group-item-action @if(Route::is('employer.myJobs')) active @endif"><i class="bi bi-list-task me-2"></i> Tất cả tuyển dụng</a>

                <h5 class="mt-2 mb-3 text-muted">ỨNG VIÊN</h5>
                <a href="{{ route('employer.history') }}" class="list-group-item list-group-item-action @if(Route::is('employer.history')) active @endif"><i class="bi bi-file-earmark-person me-2"></i> Hồ sơ đã ứng tuyển</a>

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
             
             <a href="#">
                <img src="https://via.placeholder.com/300x400/3498db/ffffff?text=DICH+VU+50%+OFF" class="img-fluid rounded-3 shadow-sm" alt="Promotion Banner">
             </a>
        </div>

        {{-- COL-LG-9: NỘI DUNG CHÍNH --}}
        <div class="col-lg-9">
            <div class="card shadow-sm border-0 p-4">
                <h2 class="fw-bold text-primary mb-4">Hồ sơ đã ứng tuyển</h2>
                <p>Tổng số hồ sơ: {{ $applications->count() }}</p>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Tên Ứng viên</th>
                                <th>Vị trí ứng tuyển</th>
                                <th>Email</th>
                                <th>Ngày ứng tuyển</th>
                                <th>Trạng thái</th> 
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($applications as $application)
                                <tr>
                                    <td>{{ $application->name }}</td>
                                    <td>{{ $application->job->title ?? 'Không tìm thấy Job' }}</td>
                                    <td>
                                        {{ $application->email }}<br>
                                    </td>
                                    <td>{{ $application->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        {{-- CỘT TRẠNG THÁI HIỆN TẠI --}}
                                        <span class="badge 
                                            @if ($application->status == 'pending') bg-warning text-dark 
                                            @elseif ($application->status == 'accepted') bg-success 
                                            @elseif ($application->status == 'rejected') bg-danger 
                                            @else bg-secondary @endif">
                                            {{ ucfirst($application->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        {{-- Nút Xem CV --}}
                                        <a href="{{ route('employer.viewCV', $application) }}" class="btn btn-sm btn-info mb-1" target="_blank">
                                            <i class="fas fa-eye"></i> Xem CV
                                        </a>

                                        @if ($application->status === 'pending')
                                            {{-- Nút CHẤP NHẬN: Chuyển đến trang form nhập chi tiết PV --}}
                                            <a href="{{ route('employer.application_form', ['application' => $application->id, 'action' => 'accepted']) }}" class="btn btn-sm btn-success mb-1">
                                                <i class="fas fa-check"></i> Chấp nhận
                                            </a>

                                            {{-- Nút TỪ CHỐI: Chuyển đến trang form nhập tin nhắn từ chối --}}
                                            <a href="{{ route('employer.application_form', ['application' => $application->id, 'action' => 'rejected']) }}" class="btn btn-sm btn-danger mb-1">
                                                <i class="fas fa-times"></i> Từ chối
                                            </a>
                                        @else
                                            {{-- Nút Lưu hồ sơ --}}
                                            <form action="{{ route('employer.candidate.save', $application->user_id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-secondary mb-1">
                                                    <i class="far fa-bookmark"></i> Lưu hồ sơ
                                                </button>
                                            </form>
                                        @endif 
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Chưa có hồ sơ ứng tuyển nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
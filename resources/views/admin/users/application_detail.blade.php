@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            
            {{-- Header --}}
            <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                <h3 class="card-title text-dark mb-0">
                    <i class="mdi mdi-email-open-outline me-2 text-primary"></i> Chi Tiết Đơn Ứng Tuyển ID: {{ $application->id }}
                </h3>
                {{-- Quay lại trang chi tiết ứng viên --}}
                <a href="{{ route('admin.users.candidate_show', $application->user->id) }}" class="btn btn-sm btn-secondary">
                    <i class="mdi mdi-arrow-left"></i> Quay lại hồ sơ ứng viên
                </a>
            </div>
            
            <div class="card-body">
                <div class="row">
                    
                    {{-- Cột 1: Thông tin Ứng viên và Trạng thái --}}
                    <div class="col-lg-6 mb-4 border-right">
                        <h4 class="mb-3 text-info border-bottom pb-2">Thông Tin Ứng Viên</h4>
                        <ul class="list-unstyled detail-list">
                            <li class="mb-2"><strong>Ứng viên:</strong> 
                                <a href="{{ route('admin.users.candidate_show', $application->user->id) }}">
                                    {{ $application->user->name ?? $application->name }}
                                </a>
                            </li>
                            <li class="mb-2"><strong>Email liên hệ:</strong> <a href="mailto:{{ $application->email }}">{{ $application->email }}</a></li>
                            <li class="mb-2"><strong>Ngày ứng tuyển:</strong> {{ \Carbon\Carbon::parse($application->created_at)->format('d/m/Y H:i') }}</li>
                            
                            <li class="mb-3">
                                <strong>Trạng thái Đơn:</strong>
                                <span class="badge fs-6 
                                    @if ($application->status == 'pending') bg-warning text-dark 
                                    @elseif ($application->status == 'accepted') bg-success 
                                    @elseif ($application->status == 'rejected') bg-danger 
                                    @else bg-secondary @endif">
                                    {{ ucfirst($application->status) }}
                                </span>
                            </li>
                        </ul>

                        <h4 class="mt-4 mb-3 text-info border-bottom pb-2">CV và Files</h4>
                        <ul class="list-unstyled detail-list">
                            <li class="mb-2">
                                <strong>CV Đính kèm:</strong>
                                @if ($application->cv)
                                    <a href="{{ asset('storage/' . $application->cv) }}" target="_blank" class="btn btn-sm btn-primary ms-2">
                                        <i class="mdi mdi-download"></i> Xem/Tải CV
                                    </a>
                                @else
                                    <span class="ms-2">Không có CV đính kèm trực tiếp</span>
                                @endif
                            </li>
                        </ul>
                    </div>

                    {{-- Cột 2: Thông tin Công việc --}}
                    <div class="col-lg-6 mb-4">
                        <h4 class="mb-3 text-primary border-bottom pb-2">Chi Tiết Công Việc</h4>
                        <ul class="list-unstyled detail-list">
                            @if ($application->job)
                                <li class="mb-2"><strong>Tiêu đề Job:</strong> 
                                    <a href="{{ route('admin.jobs.show', $application->job->id) }}" target="_blank">
                                        {{ $application->job->title }}
                                    </a>
                                </li>
                                <li class="mb-2"><strong>Công ty:</strong> {{ $application->job->company_name }}</li>
                                <li class="mb-2"><strong>Địa điểm:</strong> {{ optional($application->job->locationItem)->value ?? 'N/A' }}</li>
                                <li class="mb-2"><strong>Trạng thái Job:</strong> 
                                    <span class="badge bg-secondary">{{ ucfirst($application->job->status) }}</span>
                                </li>
                            @else
                                <li class="text-danger">Công việc này đã bị xóa khỏi hệ thống.</li>
                            @endif
                        </ul>
                    </div>

                    <div class="col-12 mt-4">
                        <h4 class="mb-3 text-info border-bottom pb-2">Lời Nhắn Của Ứng Viên</h4>
                        <div class="p-3 border rounded bg-light" style="white-space: pre-line;">
                            {{ $application->message ?? 'Không có lời nhắn.' }}
                        </div>
                    </div>

                </div>
            </div>
            
            <div class="card-footer bg-light border-top text-end">
                <small class="text-muted">Quyết định tuyển dụng do Nhà Tuyển Dụng thực hiện.</small>
            </div>
            
        </div>
    </div>
</div>
@endsection
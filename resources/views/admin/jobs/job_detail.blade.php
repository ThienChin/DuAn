@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                <h3 class="card-title text-dark mb-0">
                    <i class="mdi mdi-buffer me-2 text-primary"></i> Chi Tiết Tin Tuyển Dụng: {{ $job->title }}
                </h3>
                
                {{-- NÚT QUAY LẠI --}}
                <a href="{{ route('admin.jobs.index') }}" class="btn btn-sm btn-secondary">
                    <i class="mdi mdi-arrow-left"></i> Quay lại
                </a>
            </div>
            
            <div class="card-body">

                {{-- KHỐI HÀNH ĐỘNG DUYỆT/TỪ CHỐI/XÓA (Đặt full width trước) --}}
                <div class="alert alert-info d-flex justify-content-between align-items-center p-3 mb-4">
                    <h5 class="mb-0 text-dark">Trạng thái: 
                        <span class="badge bg-{{ $job->status === 'approved' ? 'success' : ($job->status === 'pending' ? 'warning text-dark' : 'danger') }}">
                            {{ ucfirst($job->status) }}
                        </span>
                    </h5>
                    
                    <div class="action-buttons">
                        {{-- Nút Chỉnh Sửa --}}
                        <a href="{{ route('admin.jobs.edit', $job->id) }}" class="btn btn-primary me-3">
                            <i class="mdi mdi-pencil"></i> Chỉnh Sửa Chi Tiết
                        </a>

                        @if ($job->status === 'pending')
                            {{-- Nút Duyệt --}}
                            <form action="{{ route('admin.jobs.approve', $job->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success me-2">
                                    <i class="mdi mdi-check"></i> Duyệt Bài
                                </button>
                            </form>
                        @endif
                        
                        {{-- Nút XÓA VĨNH VIỄN (DELETE) --}}
                        <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Bạn có chắc chắn muốn XÓA VĨNH VIỄN tin tuyển dụng này? Hành động không thể hoàn tác!');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="mdi mdi-delete-forever"></i> Xóa Vĩnh Viễn
                            </button>
                        </form>
                        
                        @if ($job->status === 'pending')
                            {{-- Nút Từ chối (chỉ hiện khi pending) --}}
                            <form action="{{ route('admin.jobs.reject', $job->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-warning text-dark">
                                    <i class="mdi mdi-close"></i> Từ Chối
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <div class="row">
                    
                    {{-- CỘT 1: THÔNG TIN CÔNG VIỆC CƠ BẢN (col-lg-4) --}}
                    <div class="col-lg-4 col-md-6 mb-4">
                        <h4 class="mb-3 text-primary border-bottom pb-2">Thông Tin Công Việc</h4>
                        <ul class="list-unstyled detail-list">
                            <li class="mb-2"><strong>Tiêu đề:</strong> {{ $job->title }}</li>
                            <li class="mb-2"><strong>Công ty:</strong> {{ $job->company_name }}</li>
                            <li class="mb-2"><strong>Địa điểm:</strong> {{ $job->location }} ({{ $job->remote ? 'Remote' : 'Tại văn phòng' }})</li>
                            <li class="mb-2"><strong>Loại hình:</strong> {{ $job->remote_type }}</li>
                            <li class="mb-2"><strong>Cấp bậc:</strong> {{ $job->level }}</li>
                            <li class="mb-2"><strong>Ngành nghề:</strong> {{ $job->category ?? 'N/A' }}</li>
                            <li class="mb-2"><strong>Mức lương:</strong> 
                                @if ($job->salary > 0)
                                    {{ number_format($job->salary) }} đ
                                @else
                                    <span class="text-info">Thương lượng</span>
                                @endif
                            </li>
                            <li class="mb-2"><strong>Ngày đăng:</strong> {{ \Carbon\Carbon::parse($job->posted_at)->format('d/m/Y H:i') }}</li>
                            <li class="mb-2"><strong>Nổi bật (Featured):</strong> {{ $job->is_featured ? 'Có' : 'Không' }}</li>
                        </ul>
                    </div>

                    {{-- CỘT 2: YÊU CẦU ỨNG VIÊN & LIÊN HỆ (col-lg-4) --}}
                    <div class="col-lg-4 col-md-6 mb-4">
                        <h4 class="mb-3 text-primary border-bottom pb-2">Yêu Cầu Ứng Viên</h4>
                        <ul class="list-unstyled detail-list">
                            <li class="mb-2"><strong>Kinh nghiệm:</strong> {{ $job->experience ?? 'Không yêu cầu' }}</li>
                            <li class="mb-2"><strong>Bằng cấp:</strong> {{ $job->degree ?? 'N/A' }}</li>
                            <li class="mb-2"><strong>Giới tính:</strong> {{ $job->gender ?? 'N/A' }}</li>
                            <li class="mb-2"><strong>Độ tuổi:</strong> {{ $job->age ?? 'N/A' }}</li>
                        </ul>
                        
                        <h4 class="mt-4 mb-3 text-primary border-bottom pb-2">Thông Tin Liên Hệ</h4>
                        <ul class="list-unstyled detail-list">
                            <li class="mb-2"><strong>Email:</strong> {{ $job->email ?? 'N/A' }}</li>
                            <li class="mb-2"><strong>Phone:</strong> {{ $job->phone ?? 'N/A' }}</li>
                            <li class="mb-2"><strong>Website:</strong> <a href="{{ $job->website }}" target="_blank">{{ $job->website ?? 'N/A' }}</a></li>
                        </ul>
                    </div>

                    {{-- CỘT 3: PREVIEW & MÔ TẢ CÔNG TY (col-lg-4) --}}
                    <div class="col-lg-4 col-md-12 mb-4">
                        <h4 class="mb-3 text-primary border-bottom pb-2">Mô Tả Công Ty</h4>
                        <div class="p-2 border rounded bg-light text-muted small" style="min-height: 120px; white-space: pre-line;">
                            {{ $job->company_description ?? 'Không có mô tả chi tiết về công ty.' }}
                        </div>
                        
                        <h4 class="mt-4 mb-3 text-primary border-bottom pb-2">Preview Media</h4>
                        <div class="row">
                            <div class="col-6">
                                <h6>Logo</h6>
                                @if ($job->company_logo_url)
                                    <img src="{{ asset('storage/' . $job->company_logo_url ?? 'default-logo.png') }}" class="img-fluid rounded border p-1" style="max-height: 80px; object-fit: contain;" alt="Logo">
                                @else
                                    <p class="text-muted small">N/A</p>
                                @endif
                            </div>
                            <div class="col-6">
                                <h6>Ảnh Job</h6>
                                @if ($job->jobs_images)
                                    <img src="{{ asset('storage/' . $job->jobs_images) }}" class="img-fluid rounded border p-1" style="max-height: 80px; object-fit: cover;" alt="Job Image">
                                @else
                                    <p class="text-muted small">N/A</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                {{-- MÔ TẢ CHI TIẾT CÔNG VIỆC (Full Width) --}}
                <div class="mb-4">
                    <h4 class="mb-3 text-primary border-bottom pb-2">Mô Tả Chi Tiết Công Việc</h4>
                    <div class="p-3 border rounded" style="white-space: pre-line;">
                        {{ $job->description }}
                    </div>
                </div>
                
                {{-- KỸ NĂNG YÊU CẦU KHÁC (Full Width) --}}
                <div class="mb-4">
                    <h4 class="mb-3 text-primary border-bottom pb-2">Kỹ Năng Yêu Cầu Khác</h4>
                    <div class="p-3 border rounded bg-light text-muted" style="white-space: pre-line;">
                        {{ $job->required_skills ?? 'Không có yêu cầu kỹ năng bổ sung.' }}
                    </div>
                </div>

            </div> {{-- end card-body --}}
        </div> {{-- end card --}}
    </div>
</div>
@endsection
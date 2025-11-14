@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                <h3 class="card-title text-dark mb-0">
                    <i class="mdi mdi-buffer me-2 text-primary"></i> 
                    Chi Tiết Tin Tuyển Dụng: {{ $job->title }}
                </h3>
                
                <a href="{{ route('admin.jobs.index') }}" class="btn btn-sm btn-secondary">
                    <i class="mdi mdi-arrow-left"></i> Quay lại
                </a>
            </div>
            
            <div class="card-body">

                {{-- KHỐI HÀNH ĐỘNG --}}
                <div class="alert alert-info d-flex justify-content-between align-items-center p-3 mb-4">
                    <h5 class="mb-0 text-dark">Trạng thái: 
                        <span class="badge bg-{{ 
                            $job->status === 'approved' ? 'success' : 
                            ($job->status === 'pending' ? 'warning text-dark' : 'danger') 
                        }}">
                            {{ ucfirst($job->status) }}
                        </span>
                    </h5>
                    
                    <div class="action-buttons d-flex gap-2 flex-wrap">
                        <a href="{{ route('admin.jobs.edit', $job->id) }}" class="btn btn-primary">
                            <i class="mdi mdi-pencil"></i> Chỉnh Sửa
                        </a>

                        @if ($job->status !== 'approved')
                            @if ($job->status === 'pending')
                                <form action="{{ route('admin.jobs.update_status', $job->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="action" value="approved">
                                    <button type="submit" class="btn btn-success">
                                        <i class="mdi mdi-check"></i> Duyệt
                                    </button>
                                </form>
                            @endif

                            @if ($job->status !== 'rejected')
                                <form action="{{ route('admin.jobs.update_status', $job->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="action" value="rejected">
                                    <button type="submit" class="btn btn-warning text-dark">
                                        <i class="mdi mdi-close"></i> Từ Chối
                                    </button>
                                </form>
                            @endif
                        @endif

                        <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Bạn có chắc chắn muốn XÓA VĨNH VIỄN?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="mdi mdi-delete-forever"></i> Xóa
                            </button>
                        </form>
                    </div>
                </div>

                <div class="row">
                    
                    {{-- CỘT 1: THÔNG TIN CÔNG VIỆC --}}
                    <div class="col-lg-4 col-md-6 mb-4">
                        <h4 class="mb-3 text-primary border-bottom pb-2">Thông Tin Công Việc</h4>
                        <ul class="list-unstyled detail-list">
                            <li class="mb-2"><strong>Tiêu đề:</strong> {{ $job->title }}</li>
                            <li class="mb-2"><strong>Công ty:</strong> {{ $job->company_name }}</li>
                            
                            <li class="mb-2"><strong>Địa điểm:</strong> 
                                {{ optional($job->locationItem)->value ?? 'N/A' }}
                                <small class="text-muted">({{ $job->remote ? 'Remote' : 'Tại văn phòng' }})</small>
                            </li>
                            
                            {{-- SỬA: Lấy giá trị từ quan hệ remoteTypeItem --}}
                            <li class="mb-2"><strong>Loại hình:</strong> 
                                <span class="badge bg-info">
                                    {{ optional($job->remoteTypeItem)->value ?? 'N/A' }}
                                </span>
                            </li>
                            
                            <li class="mb-2"><strong>Cấp bậc:</strong> {{ optional($job->levelItem)->value ?? 'N/A' }}</li>
                            <li class="mb-2"><strong>Ngành nghề:</strong> {{ optional($job->categoryItem)->value ?? 'N/A' }}</li>
                            
                            <li class="mb-2"><strong>Mức lương:</strong> 
                                @if ($job->salary && $job->salary > 0)
                                    <strong class="text-success">{{ number_format($job->salary) }} đ</strong>
                                @else
                                    <em class="text-info">Thương lượng</em>
                                @endif
                            </li>
                            <li class="mb-2"><strong>Ngày đăng:</strong> 
                                {{ $job->posted_at ? \Carbon\Carbon::parse($job->posted_at)->format('d/m/Y H:i') : 'Chưa đăng' }}
                            </li>
                            <li class="mb-2"><strong>Nổi bật:</strong> 
                                <span class="badge bg-{{ $job->is_featured ? 'success' : 'secondary' }}">
                                    {{ $job->is_featured ? 'Có' : 'Không' }}
                                </span>
                            </li>
                        </ul>
                    </div>

                    {{-- CỘT 2: YÊU CẦU ỨNG VIÊN & LIÊN HỆ --}}
                    <div class="col-lg-4 col-md-6 mb-4">
                        <h4 class="mb-3 text-primary border-bottom pb-2">Yêu Cầu Ứng Viên</h4>
                        <ul class="list-unstyled detail-list">
                            <li class="mb-2"><strong>Kinh nghiệm:</strong> {{ optional($job->experienceItem)->value ?? 'Không yêu cầu' }}</li>
                            <li class="mb-2"><strong>Bằng cấp:</strong> {{ optional($job->degreeItem)->value ?? 'N/A' }}</li>
                            <li class="mb-2"><strong>Giới tính:</strong> {{ optional($job->genderItem)->value ?? 'N/A' }}</li>
                            <li class="mb-2"><strong>Độ tuổi:</strong> {{ $job->age ?? 'N/A' }}</li>
                        </ul>
                        
                        <h4 class="mt-4 mb-3 text-primary border-bottom pb-2">Thông Tin Liên Hệ</h4>
                        <ul class="list-unstyled detail-list">
                            <li class="mb-2"><strong>Email:</strong> 
                                <a href="mailto:{{ $job->email }}">{{ $job->email ?? 'N/A' }}</a>
                            </li>
                            <li class="mb-2"><strong>Phone:</strong> {{ $job->phone ?? 'N/A' }}</li>
                            <li class="mb-2"><strong>Website:</strong> 
                                @if ($job->website)
                                    <a href="{{ $job->website }}" target="_blank" class="text-primary">
                                        {{ Str::limit($job->website, 40) }}
                                    </a>
                                @else
                                    N/A
                                @endif
                            </li>
                        </ul>
                    </div>

                    {{-- CỘT 3: HÌNH ẢNH --}}
                    <div class="col-lg-4 col-md-12 mb-4">
                        <h4 class="mb-3 text-primary border-bottom pb-2">Mô Tả Công Ty</h4>
                        <div class="p-3 border rounded bg-light text-muted small" style="min-height: 100px; white-space: pre-line;">
                            {{ $job->company_description ?? 'Không có mô tả về công ty.' }}
                        </div>
                        
                        <h4 class="mt-4 mb-3 text-primary border-bottom pb-2">Hình Ảnh</h4>
                        <div class="row g-3">
                            <div class="col-6 text-center">
                                <small class="text-muted d-block mb-1">Logo</small>
                                @if ($job->company_logo_url)
                                    <img src="{{ asset('storage/' . $job->company_logo_url) }}" 
                                         class="img-fluid rounded border" 
                                         style="max-height: 80px; object-fit: contain;" alt="Logo">
                                @else
                                    <div class="bg-light border rounded d-flex align-items-center justify-content-center" style="height: 80px;">
                                        <small class="text-muted">N/A</small>
                                    </div>
                                @endif
                            </div>
                            <div class="col-6 text-center">
                                <small class="text-muted d-block mb-1">Ảnh Job</small>
                                @if ($job->jobs_images)
                                    <img src="{{ asset('storage/' . $job->jobs_images) }}" 
                                         class="img-fluid rounded border" 
                                         style="max-height: 80px; object-fit: cover;" alt="Job Image">
                                @else
                                    <div class="bg-light border rounded d-flex align-items-center justify-content-center" style="height: 80px;">
                                        <small class="text-muted">N/A</small>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                {{-- MÔ TẢ CHI TIẾT --}}
                <div class="mb-4">
                    <h4 class="mb-3 text-primary border-bottom pb-2">Mô Tả Chi Tiết Công Việc</h4>
                    <div class="p-3 border rounded bg-white" style="white-space: pre-line; line-height: 1.6;">
                        {!! nl2br(e($job->description)) !!}
                    </div>
                </div>
                
                {{-- KỸ NĂNG KHÁC --}}
                <div class="mb-4">
                    <h4 class="mb-3 text-primary border-bottom pb-2">Kỹ Năng Yêu Cầu Khác</h4>
                    <div class="p-3 border rounded bg-light text-muted" style="white-space: pre-line;">
                        {{ $job->required_skills ?? 'Không có yêu cầu kỹ năng bổ sung.' }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- DEBUG (xóa sau khi xong) --}}
{{-- 
<div class="alert alert-warning mt-3">
    <strong>DEBUG:</strong><br>
    gender_id: {{ $job->gender_id }} → {{ optional($job->genderItem)->value ?? 'NULL' }}<br>
    degree_id: {{ $job->degree_id }} → {{ optional($job->degreeItem)->value ?? 'NULL' }}<br>
    remote_type_id: [{{ $job->remote_type_id }}]
</div>
--}}
@endsection
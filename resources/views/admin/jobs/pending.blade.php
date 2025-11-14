@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom">
                <h3 class="card-title text-dark mb-0">
                    <i class="mdi mdi-briefcase-search me-2 text-primary"></i> Quản Lý Tin Tuyển Dụng
                </h3>
            </div>
            
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success mt-2">{{ session('success') }}</div>
                @endif
                
                {{-- KHỐI LỌC THEO TRẠNG THÁI --}}
                <div class="d-flex mb-4 border-bottom pb-2">
                    @php
                        // Lấy trạng thái hiện tại từ URL query string
                        $currentStatus = request('status', 'pending'); 
                        $baseRoute = route('admin.jobs.index'); 
                        $totalPending = \App\Models\Job::where('status', 'pending')->count();
                    @endphp

                    <a href="{{ $baseRoute }}?status=pending" class="btn btn-sm me-2 
                       {{ $currentStatus === 'pending' ? 'btn-warning text-dark' : 'btn-outline-warning' }}">
                        <i class="mdi mdi-alert-circle"></i> Chờ Duyệt ({{ $totalPending }})
                    </a>

                    <a href="{{ $baseRoute }}?status=approved" class="btn btn-sm me-2 
                       {{ $currentStatus === 'approved' ? 'btn-success' : 'btn-outline-success' }}">
                        <i class="mdi mdi-check-all"></i> Đã Duyệt
                    </a>
                    
                    <a href="{{ $baseRoute }}?status=rejected" class="btn btn-sm me-2 
                       {{ $currentStatus === 'rejected' ? 'btn-danger' : 'btn-outline-danger' }}">
                        <i class="mdi mdi-close-circle"></i> Đã Từ Chối
                    </a>
                    
                    <a href="{{ $baseRoute }}?status=all" class="btn btn-sm me-2 
                       {{ $currentStatus === 'all' ? 'btn-info' : 'btn-outline-info' }}">
                        <i class="mdi mdi-filter-variant"></i> Tất Cả
                    </a>
                </div>

                <div class="table-responsive mt-4">
                    <table class="table table-hover table-striped">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>Tiêu đề</th>
                                <th>Công ty</th>
                                <th>Mức lương</th>
                                <th>Ngày đăng</th>
                                <th>Trạng thái</th>
                                <th class="text-center">Chi tiết</th>
                                <th class="text-center" style="min-width: 180px;">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobs as $job)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.jobs.show', $job->id) }}" class="text-primary fw-semibold">{{ $job->title }}</a>
                                    </td>
                                    <td>{{ $job->company_name }}</td>
                                    <td>
                                        @if ($job->salary > 0)
                                            {{ number_format($job->salary) }} đ
                                        @else
                                            <span class="badge badge-info text-white">Thương lượng</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($job->posted_at)->format('d/m/Y') }}</td>
                                    
                                    <td>
                                        @if ($job->status === 'pending')
                                            <span class="badge bg-warning text-dark">Chờ Duyệt</span>
                                        @elseif ($job->status === 'approved')
                                            <span class="badge bg-success">Đã Duyệt</span>
                                        @else
                                            <span class="badge bg-danger">Từ Chối</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <a href="{{ route('admin.jobs.show', $job->id) }}" class="btn btn-info btn-sm text-white">
                                            <i class="mdi mdi-eye"></i> Xem
                                        </a>
                                    </td>

                                    <td class="text-center">
                                        @if ($job->status === 'pending' || $job->status === 'rejected')
                                            {{-- Nút Duyệt: Gửi kèm status hiện tại để redirect về đúng trang --}}
                                            <form action="{{ route('admin.jobs.approve', $job->id) }}?status={{ $currentStatus }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm me-1" title="Duyệt">
                                                    <i class="mdi mdi-check"></i>
                                                </button>
                                            </form>
                                        @endif
                                        
                                        @if ($job->status === 'pending' || $job->status === 'approved')
                                            {{-- Nút Từ chối: Gửi kèm status hiện tại để redirect về đúng trang --}}
                                            <form action="{{ route('admin.jobs.reject', $job->id) }}?status={{ $currentStatus }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm" title="Từ chối">
                                                    <i class="mdi mdi-close"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            @if($jobs->isEmpty())
                                <tr>
                                    <td colspan="7" class="text-center text-muted p-3">
                                        <i class="mdi mdi-information-outline me-2"></i> Không có tin nào trong trạng thái này.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    
                    {{-- PHÂN TRANG --}}
                    <div class="d-flex justify-content-center mt-3">
                        {{ $jobs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
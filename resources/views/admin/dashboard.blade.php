@extends('layouts.admin')
@section('content')

{{-- Bắt đầu nội dung chính trong Page Wrapper --}}
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Dashboard Tuyển Dụng</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Phân Tích Hoạt Động Hệ Thống</h4>
                                <h5 class="card-subtitle">Tổng quan trong 7 ngày gần nhất</h5>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-lg-9">
                                <div class="flot-chart">
                                    <div class="flot-chart-content" id="flot-line-chart">
                                        <div style="height: 300px; background-color: #f8f9fa; border: 1px dashed #ccc; text-align: center; line-height: 300px;">[Placeholder Biểu đồ Tăng trưởng Người dùng & Tin đăng]</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-3">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="bg-danger p-10 text-white text-center">
                                           <i class="fa fa-table m-b-5 font-16"></i>
                                           <h5 class="m-b-0 m-t-5">{{ $stats['pending_jobs'] ?? 0 }}</h5>
                                           <small class="font-light">Tin Chờ Duyệt</small>
                                        </div>
                                    </div>
                                     <div class="col-6">
                                        <div class="bg-info p-10 text-white text-center">
                                           <i class="fa fa-user m-b-5 font-16"></i>
                                           <h5 class="m-b-0 m-t-5">{{ $stats['new_candidates'] ?? 0 }}</h5>
                                           <small class="font-light">Ứng Viên Mới</small>
                                        </div>
                                    </div>
                                    <div class="col-6 m-t-15">
                                        <div class="bg-warning p-10 text-dark text-center">
                                           <i class="fa fa-plus m-b-5 font-16"></i>
                                           <h5 class="m-b-0 m-t-5">{{ $stats['new_employers'] ?? 0 }}</h5>
                                           <small class="font-light">Employer Mới</small>
                                        </div>
                                    </div>
                                     <div class="col-6 m-t-15">
                                        <div class="bg-success p-10 text-white text-center">
                                           <i class="fa fa-cart-plus m-b-5 font-16"></i>
                                           <h5 class="m-b-0 m-t-5">{{ $stats['total_applications'] ?? 0 }}</h5>
                                           <small class="font-light">Tổng Đơn Ứng Tuyển</small>
                                        </div>
                                    </div>
                                    <div class="col-6 m-t-15">
                                        <div class="bg-dark p-10 text-white text-center">
                                           <i class="fa fa-tag m-b-5 font-16"></i>
                                           <h5 class="m-b-0 m-t-5">{{ $stats['active_jobs'] ?? 0 }}</h5>
                                           <small class="font-light">Tin Đang Hoạt Động</small>
                                        </div>
                                    </div>
                                    <div class="col-6 m-t-15">
                                        <div class="bg-dark p-10 text-white text-center">
                                           <i class="fa fa-globe m-b-5 font-16"></i>
                                           <h5 class="m-b-0 m-t-5">{{ $stats['total_users'] ?? 0 }}</h5>
                                           <small class="font-light">Tổng Users</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-danger">5 Tin Tuyển Dụng Chờ Duyệt Mới</h4>
                            </div>
                            <div class="comment-widgets scrollable" style="max-height: 400px;">
                                
                                @forelse ($recentPendingJobs as $job)
                                <div class="d-flex flex-row comment-row m-t-0 border-bottom">
                                    <div class="p-2"><img src="{{ asset('storage/' . $job->company_logo_url ?? 'default-logo.png') }}" alt="logo" width="50" class="rounded-circle"></div>
                                    <div class="comment-text w-100">
                                        <h6 class="font-medium">{{ Str::limit($job->title, 40) }}</h6>
                                        <span class="m-b-15 d-block text-muted">{{ $job->company_name }} tại {{ $job->locationItem->value ?? 'N/A' }}</span>
                                        <div class="comment-footer">
                                            <span class="text-muted float-right">{{ $job->created_at->diffForHumans() }}</span> 
                                            <a href="{{ route('admin.jobs.show', $job->id) }}" class="btn btn-cyan btn-sm">Xem & Duyệt</a>
                                            <a href="{{ route('admin.jobs.edit', $job->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="p-4 text-center text-muted">
                                    Không có tin tuyển dụng nào đang chờ duyệt.
                                </div>
                                @endforelse
                                
                            </div>
                        </div>
                        
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-info">Ứng Viên Mới Nhất</h4>
                            </div>
                            <div class="comment-widgets scrollable" style="max-height: 250px;">
                                @forelse ($recentCandidates as $candidate)
                                <div class="d-flex flex-row comment-row m-t-0 border-bottom">
                                    <div class="p-2"><i class="fa fa-user font-24 text-info"></i></div>
                                    <div class="comment-text w-100">
                                        <h6 class="font-medium">{{ $candidate->name }}</h6>
                                        <span class="m-b-15 d-block text-muted">{{ $candidate->email }}</span>
                                        <div class="comment-footer">
                                            <span class="text-muted float-right">{{ $candidate->created_at->diffForHumans() }}</span> 
                                            <a href="{{ route('admin.users.candidate_show', $candidate->id) }}" class="btn btn-cyan btn-sm">Xem Hồ Sơ</a>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="p-4 text-center text-muted">Không có ứng viên mới nào.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Top 5 Ngành Nghề Đang Hot</h4>
                                <div class="flot-chart-content" id="flot-pie-chart" style="height:350px;">
                                    <div style="height: 350px; background-color: #f8f9fa; border: 1px dashed #ccc; text-align: center; line-height: 350px;">[Placeholder Biểu đồ Tròn Ngành Nghề]</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title m-b-0 text-warning">5 Nhà Tuyển Dụng Mới Nhất</h4>
                            </div>
                            <ul class="list-style-none">
                                @forelse ($recentEmployers as $employer)
                                <li class="d-flex no-block card-body border-top">
                                    <i class="fa fa-bank w-30px m-t-5 text-warning"></i>
                                    <div>
                                        <a href="{{ route('admin.users.employer_show', $employer->id) }}" class="m-b-0 font-medium p-0">{{ $employer->company_name ?? $employer->name }}</a>
                                        <span class="text-muted d-block">{{ $employer->email }}</span>
                                    </div>
                                    <div class="ml-auto">
                                        <div class="tetx-right">
                                            <h5 class="text-muted m-b-0">{{ $employer->created_at->diffForHumans() }}</h5>
                                        </div>
                                    </div>
                                </li>
                                @empty
                                <li class="p-4 text-center text-muted">Chưa có nhà tuyển dụng mới nào.</li>
                                @endforelse
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            
            <footer class="footer text-center">
                All Rights Reserved by GottoJob. Designed and Developed by <a href="https://yourwebsite.com">Your Team</a>.
            </footer>
        </div>
    </div>

@endsection
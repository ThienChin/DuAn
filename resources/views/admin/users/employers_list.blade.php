@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom">
                <h3 class="card-title text-dark mb-0 fw-bold">
                    <i class="mdi mdi-bank me-2 text-info"></i> Danh Sách Nhà Tuyển Dụng
                </h3>
            </div>
            
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-borderless mb-0">
                        <thead style="background-color: #343a40;">
                            <tr class="text-white">
                                <th style="width: 5%;">ID</th>
                                <th style="width: 25%;">Công ty</th>
                                <th style="width: 25%;">Email</th>
                                <th style="width: 15%;">Số điện thoại</th>
                                <th style="width: 25%;">Website</th>
                                <th class="text-center" style="width: 5%;">Chi tiết</th>
                                {{-- Cột "Vị trí (Người đăng)" đã được loại bỏ --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employers as $employer)
                                <tr>
                                    <td class="fw-bold text-muted">{{ $employer->id }}</td>
                                    <td>
                                        <div class="fw-semibold text-primary">{{ $employer->company_name }}</div>
                                        <div class="small text-muted">{{ $employer->name }} (Người đại diện)</div>
                                    </td>
                                    <td>
                                        <i class="mdi mdi-email-outline me-1 text-info"></i>
                                        {{ $employer->email }}
                                    </td>
                                    
                                    <td><i class="mdi mdi-phone-in-talk me-1 text-secondary"></i> {{ $employer->phone ?? 'N/A' }}</td>
                                    <td>
                                        @if ($employer->website)
                                            <a href="{{ $employer->website }}" target="_blank" class="text-success small fw-semibold">
                                                <i class="mdi mdi-web me-1"></i> {{ Str::limit($employer->website, 30) }}
                                            </a>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.users.employer_show', $employer->id) }}" class="btn btn-sm btn-info text-white">
                                            <i class="mdi mdi-eye"></i> Xem
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            @if($employers->isEmpty())
                                <tr><td colspan="6" class="text-center text-muted p-3">Không có nhà tuyển dụng nào.</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                {{-- Phân trang --}}
                <div class="card-footer d-flex justify-content-center">
                    {{ $employers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
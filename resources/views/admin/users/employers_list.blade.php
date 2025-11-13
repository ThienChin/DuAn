@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom">
                <h3 class="card-title text-dark mb-0"><i class="mdi mdi-bank me-2 text-info"></i> Danh Sách Nhà Tuyển Dụng</h3>
            </div>
            
            <div class="card-body">
                <div class="table-responsive mt-4">
                    <table class="table table-hover table-striped">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>ID</th>
                                <th>Công ty</th>
                                <th>Email</th>
                                <th>Vị trí (Người đăng)</th>
                                <th>Số điện thoại</th>
                                <th>Website</th>
                                <th class="text-center">Xem chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employers as $employer)
                                <tr>
                                    <td>{{ $employer->id }}</td>
                                    <td>{{ $employer->company_name }}</td>
                                    <td>{{ $employer->email }}</td>
                                    <td>{{ $employer->position ?? 'N/A' }}</td>
                                    <td>{{ $employer->phone ?? 'N/A' }}</td>
                                    <td>
                                        @if ($employer->website)
                                            <a href="{{ $employer->website }}" target="_blank" class="text-primary small">{{ Str::limit($employer->website, 30) }}</a>
                                        @else
                                            N/A
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
                                <tr><td colspan="7" class="text-center text-muted p-3">Không có nhà tuyển dụng nào.</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-3">{{ $employers->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
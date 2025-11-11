@extends('admin.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="card-title">Danh sách tin tuyển dụng chờ duyệt</h3>

                @if(session('success'))
                    <div class="alert alert-success mt-2">{{ session('success') }}</div>
                @endif

                <div class="table-responsive mt-4">
                    <table class="table table-hover">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>Tiêu đề</th>
                                <th>Công ty</th>
                                <th>Mức lương</th>
                                <th>Ngày đăng</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobs as $job)
                                <tr>
                                    <td>{{ $job->title }}</td>
                                    <td>{{ $job->company_name }}</td>
                                    <td>{{ number_format($job->salary) }} đ</td>
                                    <td>{{ $job->posted_at }}</td>

                                    <td>
                                        <form action="{{ route('admin.jobs.approve', $job->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="mdi mdi-check"></i> Duyệt
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.jobs.reject', $job->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="mdi mdi-close"></i> Từ chối
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            @if($jobs->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center text-muted p-3">
                                        <h5>Không có tin nào chờ duyệt</h5>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

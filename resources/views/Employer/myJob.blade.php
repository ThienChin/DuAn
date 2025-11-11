@extends('layouts.employer')

@section('content')
<div class="container py-5">

    <h2 class="mb-4">Tin tuyển dụng của bạn</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped mt-3">
        <thead class="bg-primary text-white">
            <tr>
                <th>Tiêu đề</th>
                <th>Mức lương</th>
                <th>Ngày đăng</th>
                <th>Trạng thái</th>
            </tr>
        </thead>

        <tbody>
            @foreach($jobs as $job)
            <tr>
                <td>{{ $job->title }}</td>
                <td>{{ number_format($job->salary) }} đ</td>
                <td>{{ $job->posted_at }}</td>

                <td>
                    @if($job->status == 'pending')
                        <span class="badge badge-warning">Đang chờ duyệt</span>
                    @elseif($job->status == 'approved')
                        <span class="badge badge-success">Đã duyệt</span>
                    @else
                        <span class="badge badge-danger">Bị từ chối</span>
                    @endif
                </td>

            </tr>
            @endforeach

            @if($jobs->isEmpty())
                <tr>
                    <td colspan="4" class="text-center text-muted p-4">
                        Bạn chưa đăng tin tuyển dụng nào.
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection

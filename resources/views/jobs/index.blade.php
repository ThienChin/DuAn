@extends('layouts.main')

@section('title', 'Job Listings')

@section('content')
    <!-- Search Section -->
    <div class="container my-4 search-bg">
        <h4>Tìm việc làm</h4>
        <form method="GET" action="{{ route('jobs.index') }}" class="row g-2">
            <div class="col-md-4">
                <input type="text" name="keyword" class="form-control" placeholder="Từ khóa (VD: Kế toán, IT)">
            </div>
            <div class="col-md-3">
                <input type="text" name="location" class="form-control" placeholder="Vị trí (VD: Hà Nội)">
            </div>
            <div class="col-md-2">
                <input type="text" name="salary" class="form-control" placeholder="Lương (VD: 10-20 triệu)">
            </div>
            <div class="col-md-2">
                <select name="category" class="form-control">
                    <option value="">Chọn ngành</option>
                    <option value="IT">IT</option>
                    <option value="Marketing">Marketing</option>
                    <!-- Thêm các category khác từ bảng nếu cần -->
                </select>
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-success">Tìm kiếm</button>
            </div>
        </form>
    </div>

    <!-- Job Listings -->
    <div class="container">
        <h3>Kết quả việc làm</h3>
        <div class="row">
            @forelse ($jobs as $job)
                <div class="col-md-4 mb-3">
                    <div class="job-card">
                        <h5>{{ $job->title }}</h5>
                        <p><strong>Vị trí:</strong> {{ $job->location }}</p>
                        <p><strong>Lương:</strong> {{ number_format($job->salary, 0, ',', '.') }} VNĐ</p>
                        <p><strong>Đăng:</strong> {{ $job->posted_at->diffForHumans() }}</p>
                        <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-apply">Ứng tuyển ngay</a>
                    </div>
                </div>
            @empty
                <p>Không có công việc nào.</p>
            @endforelse
        </div>
        {{ $jobs->links() }}
    </div>
@endsection

@push('styles')
    <style>
        .job-card { border: 1px solid #ddd; margin-bottom: 15px; padding: 10px; background-color: #f9f9f9; }
        .job-card h5 { font-size: 1.1em; margin-bottom: 5px; }
        .job-card p { margin: 0; font-size: 0.9em; color: #555; }
        .btn-apply { background-color: #ff4500; color: white; }
        .btn-apply:hover { background-color: #e03a00; }
        .search-bg { background-color: #e9ecef; padding: 20px; margin-bottom: 20px; }
    </style>
@endpush
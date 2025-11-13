@extends('layouts.employer') 

@section('title', 'Trạng Thái Tải CV')

@section('content')
<main class="section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <h2 class="text-center mb-4">Thông Báo Tải Hồ Sơ</h2>
                <hr>

                {{-- View này CHỈ hiển thị khi Controller gọi đến nó và gửi 'error' --}}
                @if (session('error'))
                    <div class="alert alert-danger text-center shadow-sm p-4">
                        <h4 class="alert-heading"><i class="fas fa-times-circle me-2"></i> Lỗi Tải Xuống CV</h4>
                        <p class="mb-3">{{ session('error') }}</p>
                        
                        {{-- Dùng Route history đã được xác nhận --}}
                        <a href="{{ route('employer.history') }}" class="custom-btn btn-danger mt-2">
                            <i class="fas fa-arrow-left me-2"></i> Quay lại Danh sách Hồ sơ
                        </a>
                    </div>
                @else
                    {{-- Trường hợp này có thể xảy ra nếu người dùng truy cập trực tiếp URL này --}}
                    <div class="alert alert-info text-center shadow-sm p-4">
                        <h4 class="alert-heading"><i class="fas fa-question-circle me-2"></i> Thông Tin Chung</h4>
                        <p class="mb-3">Trang này được thiết kế để hiển thị thông báo lỗi khi bạn cố gắng tải CV.</p>
                        <a href="{{ route('employer.history') }}" class="custom-btn btn-info mt-2">
                            <i class="fas fa-arrow-left me-2"></i> Quay lại Danh sách Hồ sơ
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection
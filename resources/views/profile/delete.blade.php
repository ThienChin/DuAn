@extends('layouts.main') 

@section('content')

@section('content')
    <div class="container" style="max-width: 600px; padding: 0;">
        <h2 class="text-danger">Xác nhận xóa CV</h2>
        
        @if ($file)
            <div class="alert alert-warning" role="alert">
                <strong>Cảnh báo:</strong> Bạn sắp xóa file CV sau. Hành động này không thể hoàn tác.
            </div>
            
            <div class="card p-4 mb-4">
                <h5 class="card-title">Chi tiết File:</h5>
                <p><strong>Tên File:</strong> {{ $file->name ?? pathinfo($file->path, PATHINFO_BASENAME) }}</p>
                <p><strong>Ngày tải lên:</strong> {{ $file->created_at->format('d/m/Y H:i:s') }}</p>
                <p><strong>Đường dẫn (Public):</strong> <a href="{{ asset($file->path) }}" target="_blank">{{ asset($file->path) }}</a></p>
            </div>
            
            <form action="{{ route('cv.delete.confirm', $file->id) }}" method="POST">
                @csrf
                {{-- Laravel cần phương thức DELETE, ngay cả khi route là GET/POST --}}
                @method('DELETE') 
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('profile.personal') }}" class="btn btn-secondary">Hủy bỏ</a>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi-trash me-2"></i> CHẮC CHẮN XÓA
                    </button>
                </div>
            </form>
        @else
            <div class="alert alert-danger" role="alert">
                Không tìm thấy file CV để xóa.
            </div>
             <a href="{{ route('profile.personal') }}" class="btn btn-secondary">Quay lại</a>
        @endif
        
    </div>
@endsection
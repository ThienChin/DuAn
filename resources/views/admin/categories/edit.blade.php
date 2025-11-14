@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-white">
                <h3 class="card-title mb-0">
                    <i class="mdi mdi-pencil me-2"></i> Chỉnh Sửa Danh Mục: **{{ $category->value }}**
                </h3>
            </div>
            
            <div class="card-body">
                
                {{-- Thông báo lỗi chung --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        Vui lòng kiểm tra lại thông tin đã nhập!
                    </div>
                @endif
                
                {{-- Form SỬA SỬ DỤNG CHUNG ROUTE STORE --}}
                {{-- Controller sẽ dùng category_id ẩn để phân biệt Create và Update --}}
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    
                    {{-- KHÓA ẨN QUYẾT ĐỊNH CẬP NHẬT --}}
                    <input type="hidden" name="category_id" value="{{ $category->id }}"> 
                    
                    {{-- 1. Loại Danh mục (KEY) - Chỉ hiển thị, không cho sửa Key --}}
                    <div class="mb-3">
                        <label for="category_key" class="form-label">Loại Danh Mục (Key: {{ $category->key }})</label>
                        {{-- Truyền key qua input hidden để Controller biết category thuộc loại nào --}}
                        <input type="hidden" name="key" value="{{ $category->key }}"> 
                        {{-- Hiển thị tên loại danh mục, không cho sửa --}}
                        <input type="text" class="form-control" value="{{ $keys[$category->key] ?? 'Không xác định' }}" disabled>
                    </div>

                    {{-- 2. Giá Trị (VALUE) --}}
                    <div class="mb-3">
                        <label for="edit_value" class="form-label required">Tên Giá Trị Mới</label>
                        <input type="text" name="value" id="edit_value" class="form-control @error('value') is-invalid @enderror" 
                               placeholder="Ví dụ: Senior, TP. Hồ Chí Minh..." 
                               {{-- HIỂN THỊ DỮ LIỆU CŨ TỪ DATABASE --}}
                               value="{{ old('value', $category->value) }}" required> 
                        @error('value')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    {{-- 3. Thứ tự (ORDER) --}}
                    <div class="mb-3">
                        <label for="edit_order" class="form-label">Thứ tự hiển thị (0 = Mặc định)</label>
                        <input type="number" name="order" id="edit_order" class="form-control @error('order') is-invalid @enderror" 
                               placeholder="0, 1, 2..." 
                               {{-- HIỂN THỊ DỮ LIỆU CŨ TỪ DATABASE --}}
                               value="{{ old('order', $category->order) }}">
                        @error('order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <div class="border-top p-t-20 mt-4">
                        <button type="submit" class="btn btn-warning me-2">
                            <i class="mdi mdi-content-save"></i> Lưu Thay Đổi
                        </button>
                        {{-- Nút Hủy: Quay lại trang Index của loại danh mục này --}}
                        <a href="{{ route('admin.categories.index', $category->key) }}" class="btn btn-secondary">Hủy</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h3 class="card-title mb-0"><i class="mdi mdi-plus-box me-2"></i> Thêm Danh Mục Mới</h3>
            </div>
            
            <div class="card-body">
                
                {{-- Thông báo lỗi chung --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        Vui lòng kiểm tra lại thông tin đã nhập!
                    </div>
                @endif
                
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    
                    {{-- 1. Chọn loại danh mục (KEY) --}}
                    <div class="mb-3">
                        <label for="category_key" class="form-label required">Chọn Loại Danh Mục</label>
                        <select name="key" id="category_key" class="form-control @error('key') is-invalid @enderror" required>
                            <option value="">-- Chọn một loại --</option>
                            @foreach ($keys as $key => $title)
                                <option value="{{ $key }}" {{ old('key') == $key ? 'selected' : '' }}>
                                    {{ $title }} (Key: {{ $key }})
                                </option>
                            @endforeach
                        </select>
                        @error('key')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- 2. Giá Trị (VALUE) --}}
                    <div class="mb-3">
                        <label for="new_value" class="form-label required">Tên Giá Trị Mới</label>
                        <input type="text" name="value" id="new_value" class="form-control @error('value') is-invalid @enderror" 
                               placeholder="Ví dụ: Senior, TP. Hồ Chí Minh, IT..." 
                               value="{{ old('value') }}" required>
                        @error('value')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    {{-- 3. Thứ tự (ORDER) --}}
                    <div class="mb-3">
                        <label for="new_order" class="form-label">Thứ tự hiển thị (0 = Mặc định)</label>
                        <input type="number" name="order" id="new_order" class="form-control @error('order') is-invalid @enderror" 
                               placeholder="0, 1, 2..." value="{{ old('order', 0) }}">
                        @error('order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <div class="border-top p-t-20 mt-4">
                        <button type="submit" class="btn btn-success me-2">
                            <i class="mdi mdi-content-save"></i> Thêm Danh Mục
                        </button>
                        
                        {{-- FIX: LOGIC HỦY AN TOÀN --}}
                        @php
                            $currentCreateRouteName = 'admin.categories.create_page';
                            $fallbackUrl = route('admin.categories.index', 'category');
                            $previousUrl = url()->previous();
                            
                            if (str_contains($previousUrl, route($currentCreateRouteName)) || empty($previousUrl)) {
                                $cancelUrl = $fallbackUrl; 
                            } else {
                                $cancelUrl = $previousUrl;
                            }
                        @endphp
                        
                        <a href="{{ $cancelUrl }}" class="btn btn-secondary">Hủy</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
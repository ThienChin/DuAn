@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0"><i class="mdi mdi-buffer me-2"></i> Quản Lý Danh Mục: {{ $title }}</h3>
                
                {{-- Nút Mở Modal Thêm Nhanh (Dùng cho Create Modal) --}}
                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="mdi mdi-plus-circle-outline"></i> Thêm Nhanh
                </button>
            </div>
            
            <div class="card-body">
                
                {{-- Thông báo SUCCESS (Nếu có) --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                {{-- Hiển thị lỗi Validation chung --}}
                @if ($errors->any())
                    <div class="alert alert-danger">Vui lòng kiểm tra lại thông tin nhập.</div>
                @endif
                
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="bg-light">
                            <tr>
                                <th>ID</th>
                                <th>Khóa (Key)</th>
                                <th>Giá trị (Value)</th>
                                <th>Thứ tự</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td><span class="badge bg-secondary">{{ $category->key }}</span></td>
                                <td>{{ $category->value }}</td>
                                <td>{{ $category->order ?? '0' }}</td>
                                <td>
                                    {{-- Nút Sửa (Mở Modal Sửa) --}}
                                    <button class="btn btn-sm btn-warning me-2" data-bs-toggle="modal" data-bs-target="#editModal-{{ $category->id }}">
                                        <i class="mdi mdi-pencil"></i> Sửa
                                    </button>
                                    
                                    {{-- Nút Xóa (Form inline) --}}
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa giá trị [{{ $category->value }}] này không? Hành động này không thể hoàn tác.')" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="mdi mdi-delete"></i> Xóa</button>
                                    </form>
                                </td>
                            </tr>
                            {{-- INCLUDE MODAL SỬA CHO TỪNG DANH MỤC --}}
                            @include('admin.categories.edit_modal', ['category' => $category, 'keys' => $keys]) 
                            
                            @empty
                            <tr><td colspan="5" class="text-center text-muted p-3">Chưa có giá trị nào cho danh mục **{{ $title }}**</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- *************************************************************** --}}
{{-- INCLUDE MODAL THÊM MỚI VÀ SCRIPT TỰ MỞ KHI CÓ LỖI --}}
{{-- *************************************************************** --}}

{{-- 1. Modal Thêm Mới (Cần đảm bảo file này tồn tại) --}}
@include('admin.categories.create_modal', ['key' => $key, 'title' => $title]) 

{{-- 2. Script tự động mở Modal khi có lỗi Validation --}}
@if ($errors->any() && (old('category_id') || old('key') == $key))
<script>
    $(document).ready(function() {
        @if(old('category_id'))
            // Mở modal sửa nếu lỗi từ form edit
            $('#editModal-{{ old('category_id') }}').modal('show');
        @elseif(old('key') == $key)
            // Mở modal thêm mới nếu lỗi từ form create (chỉ khi key khớp)
            $('#createModal').modal('show');
        @endif
    });
</script>
@endif

@endsection
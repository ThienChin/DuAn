@extends('layouts.catadmin')
@section('content')
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-semibold">Thêm mới dữ liệu</h2>
                <a href="{{ route('admin.dashboard') }}" class="inline-block px-4 py-2 border rounded hover:bg-gray-100">Quay lại</a>
            </div>

            {{-- Hiển thị lỗi validation --}}
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded">
                    <ul class="list-disc pl-5 text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form thêm dữ liệu Laravel chuẩn --}}
            <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label for="title" class="block text-sm font-medium mb-1">Tiêu đề</label>
                        <input type="text" name="title" id="title" class="form-control w-full border rounded px-3 py-2" value="{{ old('title') }}" placeholder="Nhập tiêu đề">
                    </div>

                    <div class="form-group">
                        <label for="slug" class="block text-sm font-medium mb-1">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control w-full border rounded px-3 py-2" value="{{ old('slug') }}" placeholder="slug-vi-du">
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium mb-1">Mô tả</label>
                        <textarea name="description" id="description" rows="5" class="form-control w-full border rounded px-3 py-2" placeholder="Nhập mô tả">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="image" class="block text-sm font-medium mb-1">Ảnh</label>
                        <input type="file" name="image" id="image" class="form-control w-full">
                    </div>

                    <div class="form-group">
                        <label for="status" class="block text-sm font-medium mb-1">Trạng thái</label>
                        <select name="status" id="status" class="form-select w-full border rounded px-3 py-2">
                            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Kích hoạt</option>
                            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Chưa kích hoạt</option>
                        </select>
                    </div>
                </div>

                <div class="mt-6 flex items-center gap-3">
                    <button type="submit" class="btn btn-primary px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Lưu</button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary px-4 py-2 border rounded">Hủy</a>
                </div>
            </form>
        </div>
    </div>
@endsection
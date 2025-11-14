{{-- Tên file: resources/views/admin/categories/edit_modal.blade.php --}}

<div class="modal fade" id="editModal-{{ $category->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $category->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            {{-- SỬA LỖI LOGIC: Form phải gửi đến route UPDATE --}}
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="editModalLabel-{{ $category->id }}">Chỉnh Sửa Giá Trị: {{ $category->value }}</h5>
                    
                    {{-- SỬA LỖI ĐÓNG MODAL & HIỂN THỊ: Dùng data-dismiss và cấu trúc HTML V4/V3 --}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white; opacity: 1;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                
                {{-- KHÓA ẨN: Quan trọng nhất --}}
                <input type="hidden" name="category_id" value="{{ $category->id }}">
                <input type="hidden" name="key" value="{{ $category->key }}"> 
                
                <div class="modal-body">
                    
                    <div class="mb-3">
                        <label class="form-label">Loại Danh Mục</label>
                        <input type="text" class="form-control" value="{{ $keys[$category->key] ?? 'Không xác định' }}" disabled> 
                    </div>
                    
                    {{-- Tên Giá Trị (VALUE) --}}
                    <div class="mb-3">
                        <label for="edit_value_{{ $category->id }}" class="form-label">Tên Giá Trị</label>
                        <input type="text" name="value" id="edit_value_{{ $category->id }}" class="form-control @error('value') is-invalid @enderror" 
                               value="{{ old('value', $category->value) }}" required>
                        {{-- SỬA HIỂN THỊ LỖI: Chỉ hiển thị lỗi nếu lỗi đó liên quan đến việc sửa Modal hiện tại --}}
                        @if ($errors->has('value') && old('category_id') == $category->id)
                            <div class="invalid-feedback d-block">{{ $errors->first('value') }}</div>
                        @endif
                    </div>
                    
                    {{-- Thứ tự (ORDER) --}}
                    <div class="mb-3">
                        <label for="edit_order_{{ $category->id }}" class="form-label">Thứ tự hiển thị</label>
                        <input type="number" name="order" id="edit_order_{{ $category->id }}" class="form-control @error('order') is-invalid @enderror" 
                               value="{{ old('order', $category->order) }}">
                        {{-- SỬA HIỂN THỊ LỖI: Chỉ hiển thị lỗi nếu lỗi đó liên quan đến việc sửa Modal hiện tại --}}
                        @if ($errors->has('order') && old('category_id') == $category->id)
                            <div class="invalid-feedback d-block">{{ $errors->first('order') }}</div>
                        @endif
                    </div>
                </div>
                
                <div class="modal-footer">
                    {{-- SỬA LỖI ĐÓNG MODAL: Dùng data-dismiss V4 --}}
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-warning">Lưu Thay Đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>
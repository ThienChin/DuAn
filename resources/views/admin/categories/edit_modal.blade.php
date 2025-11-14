{{-- Tên file: resources/views/admin/categories/edit_modal.blade.php --}}

<div class="modal fade" id="editModal-{{ $category->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $category->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="editModalLabel-{{ $category->id }}">Chỉnh Sửa Giá Trị: {{ $category->value }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                
                {{-- KHÓA ẨN: Quan trọng nhất, để Controller biết đây là UPDATE --}}
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
                        @error('value')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    {{-- Thứ tự (ORDER) --}}
                    <div class="mb-3">
                        <label for="edit_order_{{ $category->id }}" class="form-label">Thứ tự hiển thị</label>
                        <input type="number" name="order" id="edit_order_{{ $category->id }}" class="form-control @error('order') is-invalid @enderror" 
                               value="{{ old('order', $category->order) }}">
                        @error('order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-warning">Lưu Thay Đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>
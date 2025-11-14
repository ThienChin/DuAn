{{-- Tên file: resources/views/admin/categories/create_modal.blade.php --}}

<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="createModalLabel">Thêm Giá Trị Mới cho: **{{ $title }}**</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                
                {{-- Khóa ẩn quyết định loại danh mục hiện tại --}}
                <input type="hidden" name="key" value="{{ $key }}"> 
                
                <div class="modal-body">
                    
                    {{-- Tên Giá Trị (VALUE) --}}
                    <div class="mb-3">
                        <label for="create_value" class="form-label">Tên Giá Trị (Ví dụ: Senior, Hà Nội...)</label>
                        <input type="text" name="value" id="create_value" class="form-control" 
                               value="{{ old('value') }}" required>
                    </div>
                    
                    {{-- Thứ tự (ORDER) --}}
                    <div class="mb-3">
                        <label for="create_order" class="form-label">Thứ tự hiển thị (0 = Mặc định)</label>
                        <input type="number" name="order" id="create_order" class="form-control" 
                               placeholder="0, 1, 2..." value="{{ old('order') }}">
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-success">Lưu và Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>
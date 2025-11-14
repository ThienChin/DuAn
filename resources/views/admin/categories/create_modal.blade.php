{{-- File: admin/categories/create_modal.blade.php --}}
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="createModalLabel">Thêm Giá Trị Mới cho: {{ $title }}</h5>
                    
                    {{-- SỬA HIỂN THỊ: Dùng cấu trúc chuẩn <button class="close"> và data-dismiss (v4/v3) --}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white; opacity: 1;">
                        <span aria-hidden="true">&times;</span> 
                    </button>
                </div>
                <div class="modal-body">
                    
                    <input type="hidden" name="key" value="{{ $key }}">
                    
                    <div class="mb-3">
                        <label for="create-value" class="form-label required">Giá trị (Value):</label>
                        <input type="text" class="form-control @error('value') is-invalid @enderror" id="create-value" name="value" value="{{ old('value') }}" required>
                        @if ($errors->has('value') && old('key') == $key)
                            <div class="invalid-feedback d-block">{{ $errors->first('value') }}</div>
                        @endif
                    </div>
                    
                    <div class="mb-3">
                        <label for="create-order" class="form-label">Thứ tự (Order):</label>
                        <input type="number" class="form-control @error('order') is-invalid @enderror" id="create-order" name="order" value="{{ old('order', 0) }}" min="0">
                        @if ($errors->has('order') && old('key') == $key)
                            <div class="invalid-feedback d-block">{{ $errors->first('order') }}</div>
                        @endif
                    </div>

                </div>
                <div class="modal-footer">
                    {{-- SỬA CHỨC NĂNG: Dùng data-dismiss (v4/v3) --}}
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button> 
                    <button type="submit" class="btn btn-success"><i class="mdi mdi-content-save"></i> Lưu Giá Trị</button>
                </div>
            </form>
        </div>
    </div>
</div>
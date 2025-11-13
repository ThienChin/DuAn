{{-- Modal Sửa Thông Tin Ứng Viên --}}
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="editUserModalLabel">Sửa Thông Tin Ứng Viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            {{-- Form Sửa Thông Tin --}}
            {{-- CHÚ Ý: Cần định nghĩa route 'admin.users.update' trong web.php --}}
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Tên Ứng Viên</label>
                        <input type="text" class="form-control" id="edit_name" name="name" value="{{ old('name', $user->name) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="email" value="{{ old('email', $user->email) }}" required>
                    </div>
                    {{-- Có thể thêm các trường khác như Trạng thái tài khoản, Role (nếu cần) --}}
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-warning">Lưu Thay Đổi</button>
                </div>
            </form>
        </div>
    </div>
@extends('layouts.employer')

@section('title', 'Thông tin nhà tuyển dụng')

@section('content')
<div class="container py-5">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-5">
            <h3 class="fw-bold text-success mb-4">Chào mừng <span class="text-dark">Nhà tuyển dụng</span></h3>
            <p>Vui lòng điền các thông tin bên dưới để chúng tôi hỗ trợ bạn tốt hơn.</p>

            <form action="{{ route('Employer.create') }}" method="GET">
                <div class="mb-3">
                    <label class="form-label">Họ và tên *</label>
                    <input type="text" class="form-control" name="name" placeholder="Nhập họ và tên" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Giới tính *</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="Nam" checked>
                            <label class="form-check-label">Nam</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="Nữ">
                            <label class="form-check-label">Nữ</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Số điện thoại *</label>
                    <input type="text" class="form-control" name="phone" placeholder="Nhập số điện thoại" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Công ty *</label>
                    <input type="text" class="form-control" name="company" placeholder="Nhập tên công ty" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tỉnh/Thành phố</label>
                        <input type="text" class="form-control" name="city" placeholder="Nhập tỉnh/thành phố">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Quận/Huyện</label>
                        <input type="text" class="form-control" name="district" placeholder="Nhập quận/huyện">
                    </div>
                </div>

                <button type="submit" class="btn btn-success px-4">Lưu và Tiếp tục →</button>
            </form>
        </div>
    </div>
</div>
@endsection

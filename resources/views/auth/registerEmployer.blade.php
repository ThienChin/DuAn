@extends('layouts.employer')
@section('title', 'Đăng ký Nhà Tuyển Dụng - Gotto')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <h2 class="card-title text-center mb-5" style="color: var(--gotto-primary);">
                        Đăng ký Tài khoản Nhà Tuyển Dụng
                    </h2>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            Vui lòng kiểm tra lại các trường thông tin bên dưới.
                        </div>
                    @endif

                    <form method="POST" action="{{ route('employer.register') }}">
                        @csrf
                        
                        <h4 class="mb-4">Email đăng nhập</h4>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold"><i class="fa fa-envelope me-2"></i> Email đăng nhập *</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                            <small class="form-text text-muted">Trường hợp bạn đăng ký tài khoản bằng email không phải email tên miền công ty, một số dịch vụ trên tài khoản có thể sẽ bị giới hạn mua hoặc sử dụng.</small>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label fw-semibold"><i class="fa fa-lock me-2"></i> Mật khẩu *</label>
                                <div class="input-group">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Mật khẩu (từ 6 đến 25 ký tự)" required autocomplete="new-password">
                                    <span class="input-group-text"><i class="fa fa-eye-slash"></i></span>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label fw-semibold"><i class="fa fa-lock me-2"></i> Nhập lại mật khẩu *</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu" required autocomplete="new-password">
                                    <span class="input-group-text"><i class="fa fa-eye-slash"></i></span>
                                </div>
                            </div>
                        </div>

                        <h4 class="mb-4 mt-4">Thông tin nhà tuyển dụng</h4>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-semibold">Họ và tên *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Họ và tên" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3 d-flex align-items-center pt-2">
                                <label class="form-label fw-semibold me-3 mb-0">Giới tính: *</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="genderNam" value="Nam" {{ old('gender') == 'Nam' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="genderNam">Nam</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="genderNu" value="Nữ" {{ old('gender') == 'Nữ' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="genderNu">Nữ</label>
                                </div>
                                @error('gender')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label fw-semibold"><i class="fa fa-phone me-2"></i> Số điện thoại cá nhân *</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Số điện thoại cá nhân" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="company_name" class="form-label fw-semibold"><i class="fa fa-building me-2"></i> Công ty *</label>
                            <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" value="{{ old('company_name') }}" placeholder="Tên công ty" required>
                            @error('company_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="address_city" class="form-label fw-semibold">Địa điểm làm việc *</label>
                                <select class="form-select @error('address') is-invalid @enderror" id="address_city" name="address" required>
                                    <option value="" disabled selected>Chọn tỉnh/thành phố</option>
                                    <option value="Hà Nội">Hà Nội</option>
                                    <option value="TP.HCM">TP. Hồ Chí Minh</option>
                                </select>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <label for="address_district" class="form-label fw-semibold">Quận/huyện</label>
                                <select class="form-select" id="address_district">
                                    <option value="" disabled selected>Chọn quận/huyện</option>
                                    </select>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary fw-bold py-2" style="background-color: var(--gotto-primary);">
                                ĐĂNG KÝ NGAY
                            </button>
                        </div>

                        <p class="text-center mt-4">
                            Bạn đã có tài khoản?
                            <a href="{{ route('employer.login') }}" class="text-decoration-none" style="color: var(--gotto-primary);">Đăng nhập</a>
                            <span class="text-muted"></span>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
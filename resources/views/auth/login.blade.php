@extends('layouts.main')

@section('content')
    <style>
        .register-card {
            background-color: #ffffffff !important; /* Nền trắng */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Shadow */
            border-radius: 10px; /* Bo góc */
            max-width: 500px; /* Chiều rộng cố định */
            margin: 50px auto; /* Căn giữa */
        }
        .register-header {
            background-color: #ff8f52ff !important; /* Màu cam cho header */
            color: white !important;
            text-align: center;
            border-radius: 10px 10px 0 0 !important;
            padding: 20px;
        }
        .submit-btn {
            background-color: #ff8f52ff; /* Màu cam cho nút */
            border-color: #ff8f52ff;
            width: 100; /* Full width trên mobile */
            padding: 12px;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s; /* Hiệu ứng hover */
        }
        .submit-btn:hover {
            background-color: #45a049; /* Màu tối hơn khi hover */
        }
        .form-control {
            border-radius: 5px; /* Bo góc input */
            border: 1px solid #ccc;
        }
    </style>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card register-card">
                <div class="card-header register-header">
                    <h3>{{ __('Account Login') }}</h3>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- E-Mail Address -->
                        <div class="form-group mb-3">
                            <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group mb-3">
                            <label for="password" class="col-form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="form-group mb-0 text-center">
                            <button type="submit" class="btn btn-primary submit-btn">
                                {{ __('Login') }}
                            </button>
                        </div>

                        <!-- Forgot Password Link -->
                        <div class="text-center mt-3">
                            @if (Route::has('password.request'))
                                <a class="text-decoration-none" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.employer')

@section('title', 'Employer Login - Gotto')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <h2 class="card-title text-center mb-4" style="color: var(--gotto-primary);">
                        Employer Account Login
                    </h2>
                    <p class="text-center text-muted mb-5">Welcome back! Please enter your login information.</p>

                    @if(session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('employer.login') }}"> 
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                            <label class="form-check-label" for="remember_me">Remember me</label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary fw-bold py-2" style="background-color: var(--gotto-primary);">
                                LOG IN
                            </button>
                        </div>
                        
                        <div class="text-center mt-3">
                            @if (Route::has('password.request'))
                                <a class="text-sm text-muted text-decoration-none" href="{{ route('password.request') }}">
                                    Forgot your password?
                                </a>
                            @endif
                        </div>

                        <p class="text-center mt-4">
                            Don't have an account?
                            <a href="{{ route('employer.register') }}" class="text-decoration-none" style="color: var(--gotto-primary);">Register now</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
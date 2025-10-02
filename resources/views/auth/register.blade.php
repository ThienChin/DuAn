@extends('layouts.main')
@section('content')
    <x-guest-layout>
        <style>
            .register-card {
                background-color: #ffffffff !important; /* Light blue background from HubSpot-inspired theme */
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for modern look */
                border-radius: 10px; /* Rounded corners */
                max-width: 500px; /* Fixed width like HubSpot previews */
                margin: 50px auto; /* Centered with top margin */
            }
            .register-header {
                background-color: #ff8f52ff !important; /* Green header */
                color: white !important;
                text-align: center;
                border-radius: 10px 10px 0 0 !important;
                padding: 20px;
            }
            .submit-btn {
                background-color: #ff8f52ff; /* Green button */
                border-color: #ff8f52ff;
                width: 100%; /* Full width on mobile */
                padding: 12px;
                font-weight: bold;
                border-radius: 5px;
                transition: background-color 0.3s; /* Hover effect */
            }
            .submit-btn:hover {
                background-color: #45a049; /* Darker green on hover */
            }
            .form-control {
                border-radius: 5px; /* Rounded inputs */
                border: 1px solid #ccc;
            }
            .gender-group .form-check-inline {
                margin-right: 20px; /* Spacing for radio buttons */
            }
        </style>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card register-card">
                        <div class="card-header register-header">
                            <h3>{{ __('Customer Register') }}</h3>
                        </div>
                        <div class="card-body p-4"> <!-- Increased padding for airy feel -->
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                
                                <!-- Name and Email in row for better layout -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="name" class="col-form-label">{{ __('Name') }}</label>
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name') }}" required />
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" required />
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Address and Phone in row -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="address" class="col-form-label">{{ __('Address') }}</label>
                                            <input id="address" type="text"
                                                class="form-control @error('address') is-invalid @enderror" name="address"
                                                value="{{ old('address') }}" required  />
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="phone" class="col-form-label">{{ __('Phone') }}</label>
                                            <input id="phone" type="text"
                                                class="form-control @error('phone') is-invalid @enderror" name="phone"
                                                value="{{ old('phone') }}" required  />
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Gender -->
                                <div class="form-group mb-3 gender-group">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-md-4">
                                            <label class="col-form-label">{{ __('Gender') }}</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="male" value="1">
                                                <label class="form-check-label" for="male">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="female" value="0">
                                                <label class="form-check-label" for="female">Female</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Password and Confirm in row -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="password" class="col-form-label">{{ __('Password') }}</label>
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required  />    
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}</label>
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required />
                                            @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-primary submit-btn">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-guest-layout>
@endsection
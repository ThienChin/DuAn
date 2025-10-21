@extends('layouts.createcv')
@section('content')
<div class="container section-padding">
    <nav class="nav d-flex justify-content-center mb-5">
        <span class="px-3 py-2">CONTACT</span>
        <span class="px-3 py-2">EXPERIENCE</span>
        <span class="px-3 py-2 active">EDUCATION</span>
        <span class="px-3 py-2">ABOUT</span>
        <span class="px-3 py-2">FINISH IT</span>
    </nav>

    <div class="row">
        <div class="col-lg-8 col-12 mx-auto text-center">
            <h2 class="mb-4">Please enter your contact info</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-12 mx-auto">
            <form class="custom-form contact-form" action="{{ route('contract.store') }}" method="POST" role="form">
                @csrf

                <!-- First Name -->
                <div class="form-floating mb-4">
                    <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" placeholder="First Name" required>
                    <label for="first_name">First Name (Mandatory)</label>
                    @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Last Name -->
                <div class="form-floating mb-4">
                    <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" placeholder="Last Name" required>
                    <label for="last_name">Last Name (Mandatory)</label>
                    @error('last_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- City -->
                <div class="form-floating mb-4">
                    <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}" placeholder="City">
                    <label for="city">City</label>
                    @error('city')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Postal Code -->
                <div class="form-floating mb-4">
                    <input type="text" name="postal_code" id="postal_code" class="form-control @error('postal_code') is-invalid @enderror" value="{{ old('postal_code') }}" placeholder="Postal Code">
                    <label for="postal_code">Postal Code</label>
                    @error('postal_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Phone -->
                <div class="form-floating mb-4">
                    <input type="tel" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="Phone">
                    <label for="phone">Phone</label>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-floating mb-4">
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email address" required>
                    <label for="email">Email (Mandatory)</label>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn custom-btn">Next to Experience</button>
            </form>
        </div>
    </div>
</div>
@endsection
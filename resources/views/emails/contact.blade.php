@extends('layouts.main')

@section('content')
<main>
    <header class="site-header">
        <div class="section-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12 text-center">
                    <h1 class="text-white">Get in touch</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contact</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <section class="contact-section section-padding">
        <div class="container">
            <div class="row justify-content-center">

                {{-- Bản đồ và thông tin --}}
                <div class="col-lg-6 col-12 mb-lg-5 mb-3">
                            <iframe class="google-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4722.…rb%20garden)!5e1!3m2!1sen!2sth!4v1680951932259!5m2!1sen!2sth" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>

                        <div class="col-lg-5 col-12 mb-3 mx-auto">
                            <div class="contact-info-wrap">
                                <div class="contact-info d-flex align-items-center mb-3">
                                    <i class="custom-icon bi-building"></i>

                                    <p class="mb-0">
                                        <span class="contact-info-small-title">Office</span>

                                        Akershusstranda 20, 0150 Oslo, Norway
                                    </p>
                                </div>

                                <div class="contact-info d-flex align-items-center">
                                    <i class="custom-icon bi-globe"></i>

                                    <p class="mb-0">
                                        <span class="contact-info-small-title">Website</span>

                                        <a href="#" class="site-footer-link">
                                            www.jobportal.co
                                        </a>
                                    </p>
                                </div>

                                <div class="contact-info d-flex align-items-center">
                                    <i class="custom-icon bi-telephone"></i>

                                    <p class="mb-0">
                                        <span class="contact-info-small-title">Phone</span>

                                        <a href="tel: 305-240-9671" class="site-footer-link">
                                            305-240-9671
                                        </a>
                                    </p>
                                </div>

                                <div class="contact-info d-flex align-items-center">
                                    <i class="custom-icon bi-envelope"></i>

                                    <p class="mb-0">
                                        <span class="contact-info-small-title">Email</span>

                                        <a href="mailto:info@yourgmail.com" class="site-footer-link">
                                            info@jobportal.co
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>

                {{-- Form liên hệ --}}
                <div class="col-lg-8 col-12 mx-auto">

                    {{-- Thông báo gửi mail thành công hoặc lỗi --}}
                        @if(session('success'))
                            <div class="alert alert-success text-center mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger text-center mb-4">
                                {{ session('error') }}
                            </div>
                        @endif

                    <form action="{{ route('contact.send') }}" method="POST">
                        @csrf
                        <h2 class="text-center mb-4">Project in mind? Let’s Talk</h2>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <label for="full-name">Full Name</label>
                                <input type="text" name="full-name" id="full-name"
                                       class="form-control @error('full-name') is-invalid @enderror"
                                       placeholder="Jack Doe" required>
                                @error('full-name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6 col-md-6 col-12">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" id="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       placeholder="Jackdoe@gmail.com" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-12 col-12">
                                <label for="message">Message</label>
                                <textarea name="message" rows="6" id="message"
                                          class="form-control @error('message') is-invalid @enderror"
                                          placeholder="What can we help you?"></textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-4 col-md-4 col-6 mx-auto">
                                <button type="submit" class="form-control btn btn-primary">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
</main>
@endsection
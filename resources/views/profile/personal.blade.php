@extends('layouts.main')

@section('content')

<body>
<div class="container">
    <h2>Personal Information</h2>
    <p><strong>First Name:</strong> {{ $user['first_name'] ?? $user->first_name ?? '' }}</p>
    <p><strong>Last Name:</strong> {{ $user['last_name'] ?? $user->last_name ?? '' }}</p>
    <p><strong>Email:</strong> {{ $user['email'] ?? $user->email ?? '' }}</p>
    <p><strong>Phone:</strong> {{ $user['phone'] ?? $user->phone ?? '' }}</p>
    <p><strong>City:</strong> {{ $user['city'] ?? $user->city ?? '' }}</p>
    <p><strong>Postal Code: </strong> {{ $user['postal_code'] ?? $user->postal_code ?? '' }}</p>

    @if(!empty($user['cv_path']))
        <div class="cv-link">
            <strong>Uploaded CV:</strong> 
            <a href="{{ asset($user['cv_path']) }}" target="_blank">View CV</a>
        </div>
    @endif
</div>
</body>
</html>
@endsection

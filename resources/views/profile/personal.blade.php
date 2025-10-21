@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Personal Information</title>
    <style>
        body { font-family: Arial; margin: 40px; background: #f9f9f9; }
        .container { background: #fff; padding: 20px; border-radius: 8px; width: 600px; margin: auto; }
        h2 { color: #333; border-bottom: 2px solid #ddd; padding-bottom: 8px; }
        p { font-size: 16px; margin: 8px 0; }
        .cv-link { margin-top: 10px; }
        a { color: #007bff; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
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

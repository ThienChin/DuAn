<<<<<<< HEAD
=======
@extends('layouts.main') 
@section('content')

>>>>>>> 2be0006e4aea4aec1de0bbbbddf017b2ce3787cb
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload CV</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .upload-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
            width: 400px;
        }
        input[type="file"] {
            display: block;
            margin: 15px auto;
        }
        button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .cv-link {
            margin-top: 20px;
        }
        .alert {
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="upload-container">
        <h2>Upload Your CV (PDF only)</h2>
        
        {{-- Hiển thị thông báo thành công (Flash Session) --}}
        @if (session('success'))
            <p class="message-success">{{ session('success') }}</p>
        @endif
        
        {{-- Hiển thị thông báo lỗi (Flash Session) --}}
        @if (session('error'))
            <p class="message-error">{{ session('error') }}</p>
        @endif

        {{-- Hiển thị lỗi Validation chuẩn của Laravel --}}
        @if ($errors->any())
            <div class="message-error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data">
            @csrf {{-- Thêm CSRF Token bảo mật --}}
            <input type="file" name="pdfFile" accept="application/pdf" required>
            <button type="submit">Upload</button>
        </form>

        {{-- Hiển thị file mới nhất --}}
        @if(!empty($cvPath))
            <div class="cv-link">
                <p><strong>Current CV:</strong></p>
                {{-- ⚡ Thêm timestamp để tránh cache --}}
                <a href="{{ asset($cvPath) }}?v={{ time() }}" target="_blank">
                    {{ basename($cvPath) }}
                </a>
            </div>
        @endif
    </div>
</body>
</html>

@endsection

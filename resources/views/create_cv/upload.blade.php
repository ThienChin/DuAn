@extends('layouts.main') 
@section('content')

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
        /* Style cho thông báo */
        .message-success { color: green; font-weight: bold; margin-bottom: 15px; }
        .message-error { color: red; font-weight: bold; margin-bottom: 15px; }
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
    </div>
</body>
</html>

@endsection
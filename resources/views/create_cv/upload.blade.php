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
        <h2>Upload Your CV (PDF, DOC, DOCX)</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="pdfFile" accept=".pdf,.doc,.docx" required>
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



                                <td style="border: 1px solid #ddd; padding: 10px;">
                                {{-- ❗ ĐÃ SỬA: Thay thế route() bằng asset() để trỏ thẳng tới file --}}
                                <a href="{{ asset($file->path) }}" target="_blank" style="color: #007bff; text-decoration: none;">
                                {{ $file->name ?? pathinfo($file->path, PATHINFO_BASENAME) }}
                                </a>
                                </td>
                                 <p>Thời gian tải lên: {{ $file->created_at->format('d/m/Y H:i') }}</p>

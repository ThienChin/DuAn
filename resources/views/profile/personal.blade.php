@extends('layouts.main')

@section('content')
    <div class="container">
        <h2>Personal Information</h2>
        <p><strong>Name:</strong> {{ $user->name ?? '' }}</p>
        <p><strong>Email:</strong> {{ $user->email ?? '' }}</p>

        <div style="margin-top: 30px;">
            <h3>Danh sách CV đã Tải Lên:</h3>
            
            @if (isset($uploadedFiles) && $uploadedFiles->isNotEmpty())
                <table class="table" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #f2f2f2;">
                            <th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Tên File</th>
                            <th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Thời gian Tải lên</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($uploadedFiles as $file)
                            <tr>
                                <td style="border: 1px solid #ddd; padding: 10px;">
                                    {{-- ❗ ĐÃ SỬA: Dùng asset($file->path) để mở file trực tiếp ❗ --}}
                                    <a href="{{ asset($file->path) }}" target="_blank" style="color: #007bff; text-decoration: none;">
                                        {{ $file->name ?? pathinfo($file->path, PATHINFO_BASENAME) }}
                                    </a>
                                </td>
                                <td style="border: 1px solid #ddd; padding: 10px;">
                                    {{-- ❗ ĐÃ THÊM LẠI: Hiển thị thời gian tải lên ❗ --}}
                                    {{ $file->created_at->format('d/m/Y H:i') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500">Chưa có CV nào được tải lên.</p>
            @endif
        </div>
    </div>
@endsection
@extends('layouts.main') 

@section('content',)

@section('content')
    <div class="container">
        <h2>Personal Information</h2>
        <p><strong>Name:</strong> {{ $user->name ?? '' }}</p>
        <p><strong>Email:</strong> {{ $user->email ?? '' }}</p>

        {{-- Hiển thị thông báo thành công nếu có --}}
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        
        <div style="margin-top: 30px;">
            <h3>Uploaded CV List:</h3>
            
            @if (isset($uploadedFiles) && $uploadedFiles->isNotEmpty())
                <table class="table" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #f2f2f2;">
                            <th style="border: 1px solid #ddd; padding: 10px; text-align: left;">File Name</th>
                            <th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Upload Time</th>
                            <th style="border: 1px solid #ddd; padding: 10px; text-align: center; width: 80px;">Delete</th> {{-- THÊM CỘT XÓA --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($uploadedFiles as $file)
                            <tr>
                                <td style="border: 1px solid #ddd; padding: 10px;">
                                    <a href="{{ asset($file->path) }}" target="_blank" style="color: #007bff; text-decoration: none;">
                                        {{ $file->name ?? pathinfo($file->path, PATHINFO_BASENAME) }}
                                    </a>
                                </td>
                                <td style="border: 1px solid #ddd; padding: 10px;">
                                    {{ $file->created_at->format('d/m/Y H:i') }}
                                </td>
                                
                                {{-- NÚT XÓA --}}
                                <td style="border: 1px solid #ddd; padding: 10px; text-align: center;">
                                    <form action="{{ route('create_cv.delete', $file->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa CV này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: none; border: none; color: #dc3545; cursor: pointer; padding: 0;">
                                            <i class="bi-trash" style="font-size: 1.2rem;"></i>
                                        </button>
                                    </form>
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500">No CV has been uploaded yet.</p>
            @endif
        </div>
    </div>
@endsection

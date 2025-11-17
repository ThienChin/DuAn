@extends('layouts.main') 

@section('content')
<div class="container">
    <h2>Personal Information</h2>

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

    {{-- Form chỉnh sửa thông tin --}}
    <form action="{{ route('user.update', $user->id) }}" method="POST" style="margin-bottom: 30px;">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="name" class="form-label"><strong>Name:</strong></label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label"><strong>Email:</strong></label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label"><strong>Phone:</strong></label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>

    {{-- Danh sách CV đã upload --}}
    <div>
        <h3>Uploaded CV List:</h3>
        
        @if (isset($uploadedFiles) && $uploadedFiles->isNotEmpty())
            <table class="table" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #f2f2f2;">
                        <th style="border: 1px solid #ddd; padding: 10px; text-align: left;">File Name</th>
                        <th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Upload Time</th>
                        <th style="border: 1px solid #ddd; padding: 10px; text-align: center; width: 80px;">Delete</th>
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

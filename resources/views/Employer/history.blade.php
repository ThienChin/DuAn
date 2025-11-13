@extends('layouts.employer') {{-- Thay thế bằng layout của bạn --}}

@section('content')
<div class="container">
    <h1>Hồ sơ đã ứng tuyển</h1>
    <p>Tổng số hồ sơ: {{ $applications->count() }}</p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên Ứng viên</th>
                <th>Vị trí ứng tuyển</th>
                <th>Email/Phone</th>
                <th>Ngày ứng tuyển</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($applications as $application)
                <tr>
                    <td>{{ $application->name }}</td>
                    <td>{{ $application->job->title ?? 'Không tìm thấy Job' }}</td>
                    <td>
                        {{ $application->email }}<br>
                        {{ $application->phone ?? 'N/A' }} 
                    </td>
                    <td>{{ $application->created_at->format('d/m/Y') }}</td>
                    <td>
                        {{-- Nút Xem CV --}}
                        <a href="{{ route('employer.viewCV', $application) }}" class="btn btn-sm btn-info" target="_blank">
                            <i class="fas fa-eye"></i> Xem CV
                        </a>
                        
                        {{-- Nút Lưu Hồ Sơ (Dựa trên logic đã tạo trước đó) --}}
                        {{-- Giả định User Model có ID: $application->user_id --}}
                        <form action="{{ route('employer.candidate.save', $application->user_id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-secondary">
                                <i class="far fa-bookmark"></i> Lưu
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Chưa có hồ sơ ứng tuyển nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
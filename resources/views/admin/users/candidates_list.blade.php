@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom">
                <h3 class="card-title text-dark mb-0"><i class="mdi mdi-account-card-details me-2 text-info"></i> Danh Sách Ứng Viên</h3>
            </div>
            
            <div class="card-body">
                <div class="table-responsive mt-4">
                    <table class="table table-hover table-striped">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>ID</th>
                                <th>Tên Ứng Viên</th>
                                <th>Email</th>
                                <th>CV</th>
                                <th>Ngày đăng ký</th>
                                <th class="text-center">Xem chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($candidates as $candidate)
                                <tr>
                                    <td>{{ $candidate->id }}</td>
                                    <td>{{ $candidate->name }}</td>
                                    <td>{{ $candidate->email }}</td>
                                    <td>
                                        @if ($candidate->cv_path)
                                            <a href="{{ asset('storage/' . $candidate->cv_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">Tải CV</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($candidate->created_at)->format('d/m/Y') }}</td>
                                    <td class="text-center">
                                        {{-- Giả định có route xem chi tiết User/Candidate --}}
                                        <a href="{{ route('admin.users.candidate_show', $candidate->id) }}" class="btn btn-sm btn-info text-white">
                                            <i class="mdi mdi-eye"></i> Xem
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            @if($candidates->isEmpty())
                                <tr><td colspan="6" class="text-center text-muted p-3">Không có ứng viên nào.</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-3">{{ $candidates->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
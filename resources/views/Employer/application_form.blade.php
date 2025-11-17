    @extends('layouts.employer')

    @section('title', 'Gửi Quyết Định Ứng Tuyển')

    @section('content')
    <div class="container-fluid py-4" style="max-width: 1000px;">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-{{ $action === 'accepted' ? 'success' : 'danger' }} text-white">
                <h4 class="mb-0">
                    <i class="mdi mdi-email me-2"></i> Gửi Quyết Định: {{ $action === 'accepted' ? 'Chấp Nhận & Mời Phỏng Vấn' : 'Từ Chối Hồ Sơ' }}
                </h4>
            </div>
            
            <div class="card-body">
                
                <p class="mb-3">
                    <strong>Ứng viên:</strong> {{ $application->name }} ({{ $application->email }})
                    <br>
                    <strong>Vị trí:</strong> {{ $application->job->title ?? 'N/A' }}
                </p>
                
                <form action="{{ route('employer.send_decision', $application->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    {{-- Trạng thái sẽ được gửi đi --}}
                    <input type="hidden" name="status" value="{{ $action }}">

                    @if ($action === 'accepted')
                        <h5 class="mt-4 mb-3 text-success border-bottom pb-2">Thông Tin Phỏng Vấn</h5>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="interview_date" class="form-label required">Ngày Phỏng Vấn (*)</label>
                                <input type="date" class="form-control @error('interview_date') is-invalid @enderror" id="interview_date" name="interview_date" value="{{ old('interview_date', Carbon\Carbon::tomorrow()->format('Y-m-d')) }}" required>
                                @error('interview_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="interview_time" class="form-label required">Thời Gian Phỏng Vấn (*)</label>
                                <input type="time" class="form-control @error('interview_time') is-invalid @enderror" id="interview_time" name="interview_time" value="{{ old('interview_time', '09:00') }}" required>
                                @error('interview_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="interview_location" class="form-label required">Địa Điểm Phỏng Vấn (*)</label>
                            <textarea class="form-control @error('interview_location') is-invalid @enderror" id="interview_location" name="interview_location" rows="3" required>{{ old('interview_location', $application->job->company_name . ' - ' . $application->job->locationItem->value ?? 'Văn phòng chính') }}</textarea>
                            @error('interview_location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    @else
                        <h5 class="mt-4 mb-3 text-danger border-bottom pb-2">Lý Do/Tin Nhắn Từ Chối</h5>
                        <div class="alert alert-warning">Ứng viên sẽ không nhận được bất kỳ chi tiết phỏng vấn nào.</div>
                    @endif
                    
                    <div class="mb-3">
                        <label for="message" class="form-label">Tin nhắn cá nhân gửi kèm Email (Tùy chọn)</label>
                        <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" placeholder="Bạn có thể thêm lời nhắn cá nhân chi tiết ở đây...">{{ old('message') }}</textarea>
                        @error('message') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('employer.history') }}" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left"></i> Quay lại
                        </a>
                        <button type="submit" class="btn btn-{{ $action === 'accepted' ? 'success' : 'danger' }}">
                            <i class="mdi mdi-send"></i> Gửi Quyết Định & Email
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
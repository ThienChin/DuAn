@extends('layouts.main')

@section('content')
    <main>
        <div class="container">
            <h1>Tạo công việc mới</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Tiêu đề công việc</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Vị trí</label>
                    <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}" required>
                </div>
                <div class="mb-3">
                    <label for="salary" class="form-label">Lương (VND)</label>
                    <input type="number" class="form-control" id="salary" name="salary" value="{{ old('salary') }}" required>
                </div>
                <div class="mb-3">
                    <label for="level" class="form-label">Cấp bậc</label>
                    <select class="form-control" id="level" name="level" required>
                        <option value="Internship" {{ old('level') == 'Internship' ? 'selected' : '' }}>Thực tập</option>
                        <option value="Junior" {{ old('level') == 'Junior' ? 'selected' : '' }}>Junior</option>
                        <option value="Senior" {{ old('level') == 'Senior' ? 'selected' : '' }}>Senior</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="remote_type" class="form-label">Loại công việc</label>
                    <select class="form-control" id="remote_type" name="remote_type" required>
                        <option value="Full Time" {{ old('remote_type') == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                        <option value="Contract" {{ old('remote_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                        <option value="Part Time" {{ old('remote_type') == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="company_name" class="form-label">Tên công ty</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name') }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Lưu công việc</button>
            </form>
        </div>
    </main>
@endsection
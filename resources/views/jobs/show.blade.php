<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $job->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-4">
        <h2>{{ $job->title }}</h2>
        <p><strong>Vị trí:</strong> {{ $job->location }}</p>
        <p><strong>Lương:</strong> {{ number_format($job->salary, 0, ',', '.') }} VNĐ</p>
        <p><strong>Mô tả:</strong> {{ $job->description }}</p>
        <a href="#" class="btn btn-apply">Ứng tuyển ngay</a>
    </div>
</body>
</html>
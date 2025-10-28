<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CV Hoàn chỉnh</title>
    <link rel="stylesheet" href="{{ asset('page/css/style.css') }}">
    <style>
        /* CSS CẦN THIẾT ĐỂ TÁI TẠO CẤU TRÚC CHUYÊN NGHIỆP TỪ ẢNH MẪU */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
            color: #333;
        }
        .resume {
            max-width: 900px;
            margin: 30px auto;
            padding: 30px;
            background: #fff;
            border: 1px solid #ccc; /* Thêm đường viền như trong ảnh */
        }
        .header-info {
            /* Đã bỏ display: flex vì không còn ảnh, chỉ còn 1 khối thông tin */
            /* Nếu bạn muốn giữ cấu trúc 1 hàng cho personal-details, bạn có thể để nguyên */
            /* Tuy nhiên, do không có ảnh, ta loại bỏ các thuộc tính liên quan đến flex */
            /* display: flex; */ 
            align-items: flex-start;
            margin-bottom: 20px;
        }
        
        /* ĐÃ LOẠI BỎ CSS LIÊN QUAN ĐẾN .profile-img VÀ .placeholder */

        .personal-details {
            /* Đã loại bỏ flex-grow: 1 vì không còn flex container */
        }
        .personal-details h1 {
            margin: 0 0 5px 0;
            font-size: 28px;
            color: #007bff; /* Màu xanh nổi bật như trong ảnh */
        }
        .personal-details p {
            margin: 2px 0;
            font-size: 14px;
        }
        .section h2 {
            /* Tiêu đề màu xanh, gạch chân đen mờ */
            color: #007bff;
            border-bottom: 1px solid #ccc; 
            padding-bottom: 5px;
            margin-top: 25px;
            margin-bottom: 10px;
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
        }
        /* Bố cục 2 cột cho Học vấn và Kinh nghiệm */
        .entry {
            margin-bottom: 15px;
        }
        .timeline-date {
            width: 20%; /* Cột thời gian chiếm khoảng 20% */
            float: left;
            font-weight: normal;
            font-size: 14px;
            padding-right: 10px;
        }
        .detail-content {
            width: 80%; /* Cột nội dung chiếm khoảng 80% */
            float: right;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
        .detail-content strong {
            font-size: 15px;
        }
        .detail-content p, .detail-content ul {
            margin: 5px 0 0 0;
            font-size: 14px;
        }
        .skills-entry ul {
            list-style: disc inside;
            padding-left: 0;
            margin-top: 5px;
        }
        .skills-entry li {
            margin-bottom: 3px;
        }
    </style>
</head>
<body>

{{-- KIỂM TRA DỮ LIỆU CẦN THIẾT --}}
@if(isset($contract) && isset($experiences) && isset($educations) && isset($about))

        <div class="resume" id="resumeContent">

        <div class="header-info">
            {{-- ĐÃ XÓA BLOCK THÊM ẢNH Ở ĐÂY --}}

        <div class="personal-details">
            <h1>{{ $contract->first_name ?? '' }} {{ $contract->last_name ?? '' }}</h1>
            
            <p>Job Title: {{ $experiences->job_title ?? 'Chưa xác định' }}</p> 
            <p>Phone: {{ $contract->phone ?? '' }}</p>
            <p>Email: {{ $contract->email ?? '' }}</p>
            <p>Address: {{ $contract->city ?? '' }}{{ $contract->postal_code ? ', ' . $contract->postal_code : '' }}</p>
        </div>
    </div>
    <div class="line"></div>

    <div class="section">
        <h2>Summary</h2>
        <p>{{ $about->summary ?? 'Vui lòng điền Mục tiêu nghề nghiệp.' }}</p>
    </div>
    <div class="line"></div>
    
    <div class="section">
        <h2>SKILL</h2>
        <div class="skills-entry clearfix">
            <p>{{ $about->skill ?? 'Kỹ năng chưa được nhập' }} — {{ $about->level ?? 'N/A' }}</p>
        </div>
    </div>
    <div class="line"></div>


    <div class="section">
        <h2>EDUCATION</h2>
        <div class="entry clearfix">
            <span class="timeline-date">
                {{ \Carbon\Carbon::parse($educations->grad_date ?? 'now')->format('Y') }}
            </span>
            <div class="detail-content">
                <strong>{{ $educations->school ?? 'Tên trường' }}</strong> — {{ $educations->city ?? '' }}<br>
                Degree: {{ $educations->degree ?? 'Chưa cập nhật' }}<br>
                Graduation : {{ \Carbon\Carbon::parse($educations->grad_date)->format('F Y') }}<br>
                {{ $educations->description ?? '' }}
            </div>
        </div>
    </div>
    <div class="line"></div>


    <div class="section">
        <h2>EXPERIENCE</h2>
        <div class="entry clearfix">
            <span class="timeline-date">
                {{ \Carbon\Carbon::parse($experiences->start_date ?? 'now')->format('m/Y') }} - 
                {{ \Carbon\Carbon::parse($experiences->end_date ?? 'now')->format('m/Y') }}
            </span>
            <div class="detail-content">
                <span class="label">{{ $experiences->job_title ?? 'Chức danh' }}</span><br>
                {{ $experiences->employer ?? 'Tên công ty' }} — {{ $experiences->city ?? '' }}<br>
                {{ \Carbon\Carbon::parse($experiences->start_date)->format('F Y') }} đến
                {{ \Carbon\Carbon::parse($experiences->end_date)->format('F Y') }}<br>
                <p>{{ $experiences->description ?? 'Mô tả kinh nghiệm của bạn.' }}</p>
            </div>
        </div>
    </div>
    <div class="line"></div>

</div>

<button class="download-btn" onclick="downloadPDF()">Download PDF</button>

@else

{{-- HIỂN THỊ THÔNG BÁO NẾU DỮ LIỆU CHƯA ĐẦY ĐỦ --}}
<div style="text-align: center; margin-top: 50px; padding: 20px; border: 1px solid #ccc; max-width: 600px; margin: 50px auto;">
    <h2>Dữ liệu chưa đầy đủ</h2>
    <p>Vui lòng điền đầy đủ thông tin **CONTACT**, **EXPERIENCE**, **EDUCATION** và **ABOUT** để hiển thị Resume hoàn chỉnh theo mẫu.</p>
</div>

@endif

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
function downloadPDF() {
    const element = document.getElementById("resumeContent");
    const opt = {
        // ... (các tùy chọn khác)
        filename: '{{ Str::slug(($contract->first_name ?? "user") . "_" . ($contract->last_name ?? "resume")) }}.pdf',
        // ... (các tùy chọn khác)
    };
    html2pdf().set(opt).from(element).save();
}
</script>
</body>
</html>
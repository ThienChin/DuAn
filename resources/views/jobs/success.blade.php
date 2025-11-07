<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ứng tuyển thành công</title>
    <style>
        /* Reset nhẹ */
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Inter, "Helvetica Neue", Arial, sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #06202a 100%);
            color: #0f172a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .card {
            background: linear-gradient(180deg, #ffffff 0%, #f7fbff 100%);
            width: 100%;
            max-width: 900px;
            border-radius: 18px;
            box-shadow: 0 20px 40px rgba(2,6,23,0.25);
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 420px;
        }

        /* Left content */
        .card .left {
            padding: 48px;
            display: flex;
            flex-direction: column;
            gap: 18px;
            justify-content: center;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            border-radius: 999px;
            font-weight: 600;
            background: linear-gradient(90deg,#06b6d4,#3b82f6);
            color: white;
            width: fit-content;
            box-shadow: 0 6px 18px rgba(59,130,246,0.18);
        }

        .title {
            font-size: 30px;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.05;
            margin-top: 8px;
        }

        .subtitle {
            color: #334155;
            font-size: 16px;
            margin-top: 6px;
        }

        .detail {
            margin-top: 18px;
            background: #f1f9ff;
            border-left: 4px solid #3b82f6;
            padding: 14px;
            border-radius: 8px;
            color: #0f172a;
        }

        .actions {
            margin-top: 20px;
            display:flex;
            gap:12px;
            align-items:center;
        }

        .btn {
            display:inline-flex;
            align-items:center;
            gap:10px;
            padding:10px 16px;
            border-radius: 12px;
            font-weight:600;
            text-decoration:none;
            cursor:pointer;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(90deg,#0ea5e9,#6366f1);
            color: white;
            box-shadow: 0 8px 30px rgba(99,102,241,0.18);
        }
        .btn-outline {
            background: transparent;
            border: 1px solid rgba(15,23,42,0.06);
            color: #0f172a;
        }

        /* Right illustration */
        .card .right {
            background: linear-gradient(180deg, rgba(59,130,246,0.06), rgba(6,182,212,0.03));
            padding: 36px;
            display:flex;
            align-items:center;
            justify-content:center;
            position:relative;
        }

        .circle {
            width: 180px;
            height: 180px;
            border-radius: 999px;
            background: radial-gradient(circle at 30% 30%, #34d399 0%, #06b6d4 40%, rgba(59,130,246,0.15) 100%);
            display:flex;
            align-items:center;
            justify-content:center;
            box-shadow: 0 20px 60px rgba(3,105,161,0.18);
            transform: translateY(-10px);
            animation: pop 800ms cubic-bezier(.2,.9,.3,1);
        }

        @keyframes pop {
            0% { transform: scale(0.4) translateY(10px); opacity: 0; }
            60% { transform: scale(1.08) translateY(-6px); opacity: 1; }
            100% { transform: scale(1) translateY(0); }
        }

        .check {
            width: 110px;
            height: 110px;
            background: white;
            border-radius: 999px;
            display:flex;
            align-items:center;
            justify-content:center;
            box-shadow: 0 8px 30px rgba(2,6,23,0.12);
            transform: rotate(-15deg);
        }

        .check svg {
            width:72px;
            height:72px;
        }

        /* Responsive */
        @media (max-width: 880px) {
            .card { grid-template-columns: 1fr; padding:0; }
            .card .right { padding: 26px 24px; }
            .left { padding: 28px; text-align: center; }
            .actions { justify-content: center; }
        }
    </style>
</head>
<body>
    <div class="card" role="main" aria-labelledby="success-heading">
        <div class="left">
            <span class="badge">Ứng tuyển thành công</span>

            <h1 id="success-heading" class="title">Cảm ơn {{ $name }}! <br> Hồ sơ của bạn đã được gửi</h1>

            <p class="subtitle">Bạn đã ứng tuyển vào vị trí <strong>"{{ $title }}"</strong>. Chúng tôi đã nhận được hồ sơ của bạn và sẽ liên hệ nếu phù hợp.</p>

            <div class="detail" aria-live="polite">
                <strong>Gửi tới:</strong> đội ngũ tuyển dụng<br>
                <strong>Thời gian:</strong> {{ \Carbon\Carbon::now()->format('H:i, d/m/Y') }}<br>
                <small>Nếu bạn muốn, hãy kiểm tra email để xác nhận (và thư rác nếu không thấy trong Inbox).</small>
            </div>

            <div class="actions">
                <a href="{{ route('jobs.list') }}" class="btn btn-outline">Quay lại</a>
                <a href="{{ route('jobs.list') }}" class="btn btn-primary">Xem thêm công việc</a>
            </div>

            <p style="margin-top:12px; color:#475569; font-size:13px;">
                Bạn có thể kiểm tra lại CV trong trang quản lý hồ sơ hoặc liên hệ support nếu có vấn đề.
            </p>
        </div>

        <div class="right" aria-hidden="true">
            <div class="circle">
                <div class="check" style="transform: rotate(-12deg);">
                    <!-- SVG check -->
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <circle cx="12" cy="12" r="11" stroke="#10B981" stroke-width="1.5" fill="none"/>
                        <path d="M6.5 12.5L10 16l7-8" stroke="#059669" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

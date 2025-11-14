@extends('layouts.admin')
@section('content')

{{-- Bắt đầu nội dung chính trong Page Wrapper --}}
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Dashboard Tuyển Dụng</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Phân Tích Hoạt Động Hệ Thống</h4>
                                <h5 class="card-subtitle">Tổng quan trong {{ request('days', 7) }} ngày gần nhất</h5>
                            </div>
                            
                            {{-- CHỌN KHOẢNG THỜI GIAN --}}
                            <div class="ml-auto">
                                <select class="form-control" id="chart-time-period">
                                    <option value="7" {{ request('days', 7) == 7 ? 'selected' : '' }}>7 Ngày Gần Nhất</option>
                                    <option value="30" {{ request('days') == 30 ? 'selected' : '' }}>30 Ngày Gần Nhất</option>
                                </select>
                            </div>
                            {{-- END CHỌN KHOẢNG THỜI GIAN --}}

                        </div>
                        <div class="row">
                            
                            {{-- VỊ TRÍ BIỂU ĐỒ 1: LINE CHART (Dùng Flot Chart) --}}
                            <div class="col-lg-7">
                                <div class="flot-chart">
                                    <div class="flot-chart-content" id="flot-line-chart">
                                        <div id="flot-line-chart-placeholder" style="height: 300px;"></div>
                                    </div>
                                </div>
                            </div>
                            
                            {{-- CÁC KPI BOXES MỚI --}}
                            <div class="col-lg-5">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="bg-danger p-10 text-white text-center">
                                           <i class="fa fa-table m-b-5 font-16"></i>
                                           <h5 class="m-b-0 m-t-5">{{ $stats['pending_jobs'] ?? 0 }}</h5>
                                           <small class="font-light">Tin Chờ Duyệt</small>
                                        </div>
                                    </div>
                                     <div class="col-4">
                                        <div class="bg-info p-10 text-white text-center">
                                           <i class="fa fa-user m-b-5 font-16"></i>
                                           <h5 class="m-b-0 m-t-5">{{ $stats['new_candidates'] ?? 0 }}</h5>
                                           <small class="font-light">Tổng Ứng Viên</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        {{-- KPI MỚI: Tỷ lệ chuyển đổi --}}
                                        <div class="bg-primary p-10 text-white text-center">
                                           <i class="fa fa-exchange m-b-5 font-16"></i>
                                           <h5 class="m-b-0 m-t-5">{{ $stats['ctr'] ?? 0 }}%</h5>
                                           <small class="font-light">Tỉ lệ CĐ (CTR)</small>
                                        </div>
                                    </div>
                                    <div class="col-4 m-t-15">
                                        <div class="bg-warning p-10 text-dark text-center">
                                           <i class="fa fa-plus m-b-5 font-16"></i>
                                           <h5 class="m-b-0 m-t-5">{{ $stats['new_employers'] ?? 0 }}</h5>
                                           <small class="font-light">Tổng Employer</small>
                                        </div>
                                    </div>
                                     <div class="col-4 m-t-15">
                                        <div class="bg-success p-10 text-white text-center">
                                           <i class="fa fa-cart-plus m-b-5 font-16"></i>
                                           <h5 class="m-b-0 m-t-5">{{ $stats['total_applications'] ?? 0 }}</h5>
                                           <small class="font-light">Tổng Đơn Ứng Tuyển</small>
                                        </div>
                                    </div>
                                    <div class="col-4 m-t-15">
                                        <div class="bg-dark p-10 text-white text-center">
                                           <i class="fa fa-tag m-b-5 font-16"></i>
                                           <h5 class="m-b-0 m-t-5">{{ $stats['active_jobs'] ?? 0 }}</h5>
                                           <small class="font-light">Tin Đang Hoạt Động</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    
                    {{-- BIỂU ĐỒ MỚI: TOP ĐỊA ĐIỂM --}}
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-primary">Top 5 Địa Điểm Nhu Cầu Cao</h4>
                                <div id="flot-bar-chart-placeholder" style="height: 350px;"></div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- BIỂU ĐỒ NGÀNH NGHỀ (PIE) --}}
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Top 5 Ngành Nghề Đang Hot</h4>
                                <div class="flot-chart-content" id="flot-pie-chart" style="height:350px;">
                                    <div id="flot-pie-chart-placeholder" style="height: 350px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- TIN CHỜ DUYỆT (THÊM NÚT HÀNH ĐỘNG) --}}
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-danger">Tin Tuyển Dụng Chờ Duyệt Mới</h4>
                            </div>
                            {{-- Form duyệt nhanh (Giả định Route) --}}
                            <form id="quick-approve-form" method="POST" style="display: none;">
                                @csrf
                                <input type="hidden" name="action" id="approve-action-input" value="approve">
                            </form>
                            
                            <div class="comment-widgets scrollable" style="max-height: 400px;">
                                
                                @forelse ($recentPendingJobs as $job)
                                <div class="d-flex flex-row comment-row m-t-0 border-bottom">
                                    <div class="p-2"><img src="{{ asset('storage/' . $job->company_logo_url ?? 'default-logo.png') }}" alt="logo" width="50" class="rounded-circle"></div>
                                    <div class="comment-text w-100">
                                        <h6 class="font-medium">{{ Str::limit($job->title, 40) }}</h6>
                                        <span class="m-b-15 d-block text-muted">{{ $job->company_name }} tại {{ $job->locationItem->value ?? 'N/A' }}</span>
                                        <div class="comment-footer">
                                            <span class="text-muted float-right">{{ $job->created_at->diffForHumans() }}</span> 
                                            
                                            {{-- NÚT HÀNH ĐỘNG MỚI: Duyệt Nhanh --}}
                                            <button 
                                                type="button" 
                                                class="btn btn-success btn-sm quick-approve-btn" 
                                                data-job-id="{{ $job->id }}"
                                                data-route="{{ route('admin.jobs.update_status', $job->id) }}">
                                                Duyệt Nhanh
                                            </button>
                                            <a href="{{ route('admin.jobs.show', $job->id) }}" class="btn btn-cyan btn-sm">Xem & Sửa</a>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="p-4 text-center text-muted">
                                    Không có tin tuyển dụng nào đang chờ duyệt.
                                </div>
                                @endforelse
                                
                            </div>
                        </div>
                        
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-info">Ứng Viên Mới Nhất</h4>
                            </div>
                            <div class="comment-widgets scrollable" style="max-height: 250px;">
                                @forelse ($recentCandidates as $candidate)
                                <div class="d-flex flex-row comment-row m-t-0 border-bottom">
                                    <div class="p-2"><i class="fa fa-user font-24 text-info"></i></div>
                                    <div class="comment-text w-100">
                                        <h6 class="font-medium">{{ $candidate->name }}</h6>
                                        <span class="m-b-15 d-block text-muted">{{ $candidate->email }}</span>
                                        <div class="comment-footer">
                                            <span class="text-muted float-right">{{ $candidate->created_at->diffForHumans() }}</span> 
                                            <a href="{{ route('admin.users.candidate_show', $candidate->id) }}" class="btn btn-cyan btn-sm">Xem Hồ Sơ</a>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="p-4 text-center text-muted">Không có ứng viên mới nào.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title m-b-0 text-warning">5 Nhà Tuyển Dụng Mới Nhất</h4>
                                    </div>
                                    <ul class="list-style-none">
                                        @forelse ($recentEmployers as $employer)
                                        <li class="d-flex no-block card-body border-top">
                                            <i class="fa fa-bank w-30px m-t-5 text-warning"></i>
                                            <div>
                                                <a href="{{ route('admin.users.employer_show', $employer->id) }}" class="m-b-0 font-medium p-0">{{ $employer->company_name ?? $employer->name }}</a>
                                                <span class="text-muted d-block">{{ $employer->email }}</span>
                                            </div>
                                            <div class="ml-auto">
                                                <div class="tetx-right">
                                                    <h5 class="text-muted m-b-0">{{ $employer->created_at->diffForHumans() }}</h5>
                                                </div>
                                            </div>
                                        </li>
                                        @empty
                                        <li class="p-4 text-center text-muted">Chưa có nhà tuyển dụng mới nào.</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            
            <footer class="footer text-center">
                All Rights Reserved by GottoJob. Designed and Developed by <a href="https://yourwebsite.com">Your Team</a>.
            </footer>
        </div>
    </div>

@endsection

@section('scripts')
{{-- Flot Chart Initialization Scripts --}}

<script>
    $(function () {
        "use strict";

        // Bắt sự kiện thay đổi của selectbox
        $('#chart-time-period').on('change', function() {
            const days = $(this).val();
            window.location.href = "{{ route('admin.dashboard') }}" + "?days=" + days;
        });


        // Lấy dữ liệu từ PHP đã truyền qua Controller
        const lineChartData = @json($lineChartData);
        const pieChartRawData = @json($pieChartData);
        const topLocationData = @json($topLocationData); // Dữ liệu mới

        // ============================================================== 
        // BIỂU ĐỒ 1: LINE CHART - Tăng trưởng Ứng dụng & User (Flot Chart)
        // ============================================================== 
        
        const applicationsData = lineChartData.applications.map((value, index) => [index, value]);
        const usersData = lineChartData.users.map((value, index) => [index, value]);
        
        const maxDataValue = Math.max(...lineChartData.applications, ...lineChartData.users) || 10;
        const maxY = Math.ceil(maxDataValue / 5) * 5; 

        const plot = $.plot($("#flot-line-chart-placeholder"), [
            { data: applicationsData, label: "Đơn Ứng Tuyển", color: "#009efb" },
            { data: usersData, label: "Ứng Viên Mới", color: "#55ce63" }
        ], {
            series: {
                lines: { show: true, lineWidth: 2, fill: true, fillColor: { colors: [{ opacity: 0.1 }, { opacity: 0.1 }] } },
                points: { show: true, radius: 3 }
            },
            grid: {
                hoverable: true, clickable: true, borderColor: '#e0e0e0', borderWidth: 1, labelMargin: 10, backgroundColor: 'transparent'
            },
            xaxis: {
                ticks: lineChartData.labels.map((label, index) => [index, label]),
                tickLength: 0,
                mode: "categories",
            },
            yaxis: {
                min: 0, max: maxY, tickDecimals: 0 
            },
            legend: { show: true, position: "nw" }
        });

        // Tooltip cho Flot Line Chart (Giữ nguyên)
        let previousPoint = null;
        $("#flot-line-chart-placeholder").bind("plothover", function(event, pos, item) {
             // Tooltip logic...
        });


        // ============================================================== 
        // BIỂU ĐỒ 2: PIE CHART - Phân bổ Ngành Nghề (Flot Donut Chart)
        // ==============================================================

        const pieChartFlotData = pieChartRawData.map(item => ({
            label: item.label,
            data: item.data
        }));
        
        const pieColors = [
            '#009efb', '#55ce63', '#ffbc34', '#f62d51', '#8b572a'
        ];

        pieChartFlotData.forEach((item, index) => {
            item.color = pieColors[index % pieColors.length];
        });

        $.plot($("#flot-pie-chart-placeholder"), pieChartFlotData, {
            series: {
                pie: {
                    show: true,
                    radius: 1, 
                    label: {
                        show: true,
                        radius: 2/3,
                        formatter: function (label, series) {
                            return '<div style="font-size:8pt; text-align:center; padding:2px; color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
                        },
                        threshold: 0.1
                    },
                    innerRadius: 0.5
                }
            },
            grid: { hoverable: true, clickable: true },
            legend: { show: true }
        });
        
        // Tooltip cho Flot Pie/Donut Chart (Giữ nguyên)
        $("#flot-pie-chart-placeholder").bind("plothover", function (event, pos, item) {
            // Tooltip logic...
        });
        
        // ============================================================== 
        // BIỂU ĐỒ 3 MỚI: BAR CHART - Top 5 Địa điểm (Flot Bar Chart)
        // ==============================================================
        
        // Chuẩn bị dữ liệu cho Flot Bar (phải đảo ngược để hiển thị trục Y là categories)
        const locationLabels = topLocationData.map(item => item.label);
        const locationCounts = topLocationData.map(item => item.data);
        
        // Tạo dữ liệu dưới dạng [[count, index]] cho biểu đồ ngang
        const barData = locationCounts.map((count, index) => [count, index]);

        // Tạo ticks cho trục Y (địa điểm)
        const yTicks = locationLabels.map((label, index) => [index, label]);

        $.plot($("#flot-bar-chart-placeholder"), [
            { data: barData, label: "Số lượng tin", color: "#007bff" } // Màu xanh primary
        ], {
            series: {
                bars: {
                    show: true,
                    barWidth: 0.6,
                    align: "center",
                    horizontal: true, // Vẽ biểu đồ thanh ngang
                    fill: 0.8
                }
            },
            xaxis: {
                min: 0,
                tickDecimals: 0
            },
            yaxis: {
                ticks: yTicks,
                tickLength: 0,
                mode: "categories",
            },
            grid: {
                hoverable: true,
                clickable: true,
                borderColor: '#e0e0e0',
                borderWidth: 1,
                backgroundColor: 'transparent'
            },
            legend: { show: false }
        });

        // Tooltip cho Flot Bar Chart (Cần đơn giản hóa vì Bar Horizontal)
        $("#flot-bar-chart-placeholder").bind("plothover", function(event, pos, item) {
            if (item) {
                $("#tooltip").remove();
                const locationLabel = locationLabels[item.dataIndex];
                const count = item.datapoint[0].toFixed(0);

                $('<div id="tooltip">' + locationLabel + ': ' + count + ' tin</div>').css({
                    position: 'absolute',
                    top: item.pageY + 5,
                    left: item.pageX + 5,
                    border: '1px solid #fdd',
                    padding: '2px',
                    'background-color': '#fee',
                    opacity: 0.80
                }).appendTo("body").fadeIn(200);
            } else {
                $("#tooltip").remove();
            }
        });


        // ============================================================== 
        // CHỨC NĂNG DUYỆT NHANH (Form Submit)
        // ==============================================================
        $('.quick-approve-btn').on('click', function() {
            if (confirm('Bạn có chắc chắn muốn duyệt tin tuyển dụng này?')) {
                const jobId = $(this).data('job-id');
                const route = $(this).data('route');
                
                // Cấu hình form và submit
                const form = $('#quick-approve-form');
                form.attr('action', route);
                form.find('#approve-action-input').val('approved'); // Gửi status 'approved'
                
                // Thêm method spoofing cho Laravel (vì form chỉ có POST)
                if (form.find('input[name="_method"]').length === 0) {
                     form.append('<input type="hidden" name="_method" value="PUT">');
                }
                
                form.submit();
            }
        });


    });
</script>
@endsection
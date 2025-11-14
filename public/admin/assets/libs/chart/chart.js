$(document).ready(function() {

    // === Prepare peity charts === //
    maruti.peity();

    // === Prepare the chart data ===/
    // Thay thế vòng lặp for bằng dữ liệu thực tế của bạn
    var traffic_data = [
        [1, 2500],   // Tháng 1: 2500 lượt
        [2, 4200],   // Tháng 2: 4200 lượt
        [3, 3800],   // Tháng 3: 3800 lượt
        [4, 5100],   // Tháng 4: 5100 lượt
        [5, 6000]    // Tháng 5: 6000 lượt
        // Thêm dữ liệu tiếp theo nếu có
    ];
    
    // Xóa/chú thích phần sin/cos cũ:
    /*
    var sin = [], cos = [];
    for (var i = 0; i < 14; i += 0.5) {
        sin.push([i, Math.sin(i)]);
        cos.push([i, Math.cos(i)]);
    }
    */

    // === Make chart === //
    // Thay thế mảng dữ liệu trong $.plot()
    var plot = $.plot($(".chart"), [
        { data: traffic_data, label: "Lượng Truy Cập", color: "#ee7951" } // Chỉ hiển thị một series
    ], {
        series: {
            lines: { show: true },
            points: { show: true }
        },
        grid: { hoverable: true, clickable: true },
        // Điều chỉnh lại yaxis nếu cần
        yaxis: { min: 0, max: 7000 } // Đặt Min = 0 và Max cao hơn giá trị lớn nhất của bạn
    });

    // === Point hover in chart === //
    // Giữ nguyên hoặc điều chỉnh theo ý muốn của bạn
    var previousPoint = null;
    $(".chart").bind("plothover", function(event, pos, item) {
        if (item) {
            if (previousPoint != item.dataIndex) {
                previousPoint = item.dataIndex;
                $('#tooltip').fadeOut(200, function() {
                    $(this).remove();
                });
                var x = item.datapoint[0].toFixed(0); // Làm tròn tháng (X)
                var y = item.datapoint[1].toFixed(0); // Làm tròn giá trị (Y)
                
                // Thay đổi hiển thị tooltip
                maruti.flot_tooltip(item.pageX, item.pageY, "Tháng " + x + ": " + y + " lượt");
            }
        } else {
            $('#tooltip').fadeOut(200, function() {
                $(this).remove();
            });
            previousPoint = null;
        }
    });
});
<x-mail::message>
# Chúc Mừng! Thư Mời Phỏng Vấn Chính Thức

Kính gửi **{{ $candidateName }}**,

Công ty **{{ $companyName }}** xin chúc mừng bạn! Hồ sơ ứng tuyển vị trí **{{ $jobTitle }}** của bạn đã được chấp nhận.

Bạn đã lọt vào vòng tiếp theo: **Phỏng Vấn**.

{{-- ✨ HIỂN THỊ TIN NHẮN TÙY CHỈNH NẾU CÓ --}}
@if ($customMessage)
<x-mail::panel>
### Tin nhắn từ Nhà tuyển dụng:
{!! nl2br(e($customMessage)) !!}
</x-mail::panel>
@endif

<x-mail::panel>
### Thông tin Phỏng vấn Chính thức
* **Vị trí:** {{ $jobTitle }}
* **Ngày:** **{{ $interviewDate }}**
* **Thời gian:** **{{ $interviewTime }}**
* **Địa điểm:** **{{ $interviewLocation }}**
</x-mail::panel>

Vui lòng xác nhận lại email này nếu bạn có bất kỳ thay đổi nào về lịch hẹn hoặc cần hỗ trợ thêm.

<x-mail::button :url="route('home')">
Truy cập Website Công ty
</x-mail::button>

Trân trọng,

Đội ngũ Tuyển dụng **{{ $companyName }}**.
</x-mail::message>
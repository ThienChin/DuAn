<x-mail::message>
# Thông Báo Kết Quả Hồ Sơ Ứng Tuyển

Kính gửi **{{ $candidateName }}**,

Công ty **{{ $companyName }}** xin chân thành cảm ơn bạn đã dành thời gian ứng tuyển vị trí **{{ $jobTitle }}**.

Chúng tôi đã xem xét kỹ lưỡng hồ sơ của bạn.

@if (!empty($customMessage))
<x-mail::panel>
### Phản hồi từ Nhà tuyển dụng:
{!! nl2br(e($customMessage)) !!}
</x-mail::panel>
@endif

Chúng tôi đánh giá cao sự quan tâm của bạn đến công ty và sẽ lưu giữ thông tin của bạn cho các cơ hội công việc phù hợp khác trong tương lai.

Chúc bạn sớm tìm được công việc như mong muốn.

Trân trọng,

Đội ngũ Tuyển dụng **{{ $companyName }}**.
</x-mail::message>

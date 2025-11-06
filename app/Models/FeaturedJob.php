<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Support\Facades\URL; // ⬅️ THÊM DÒNG NÀY NẾU DÙNG URL::asset

class FeaturedJob extends Model
{
    use HasFactory;
    
    protected $table = 'featured_jobs'; 
    protected $fillable = ['title', 'location', 'salary', 'sort_order', 'company_logo_url']; // ⬅️ NÊN THÊM COMPANY_LOGO VÀO FILLABLE

    // =======================================================
    // 💡 ACCESSOR: TỰ ĐỘNG SINH URL CHO LOGO
    // =======================================================
    // Tên hàm phải là get + TênCột (PascalCase) + Attribute
    public function getCompanyLogoAttribute($value)
    {
        // 1. Nếu cột company_logo trong DB bị NULL/rỗng
        if (!$value) {
            // Trả về ảnh mặc định (Tùy chọn: bạn có thể bỏ dòng này nếu không muốn ảnh mặc định)
            return asset('page/images/logos/default-logo.png'); 
        }

        // 2. Nếu có giá trị, tự động nối với base URL (asset)
        // Lưu ý: Nếu bạn dùng Storage (phải chạy storage:link), dùng return asset('storage/' . $value);
        return asset($value); 
    }
    
    // ...
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; // 🌟 DÒNG PHẢI CÓ (Nếu không sẽ báo lỗi Class 'Model' not found)

class FeaturedJob extends Model
{
    use HasFactory;
    
    // Đảm bảo tên bảng là featured_jobs (Nếu tên class không phải FeaturedJob)
    protected $table = 'featured_jobs'; 
    
    // Cho phép gán các cột này (cột trong bảng độc lập của bạn)
    protected $fillable = ['title', 'location', 'salary', 'sort_order'];

    // ... (Không cần mối quan hệ job() nếu bạn dùng bảng độc lập) ...
}
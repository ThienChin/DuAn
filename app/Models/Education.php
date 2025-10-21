<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
     use HasFactory;

    protected $table = 'educations'; // tên bảng trong database

    public $timestamps = false; // Không cần created_at, updated_at

    protected $fillable = [
        'user_id',
        'school',
        'degree',
        'grad_date',
        'city',
        'description',
    ];
    
    // ✅ đảm bảo Laravel không chặn field nào
    protected $guarded = [];

    // ✅ đảm bảo khóa chính hoạt động đúng
    protected $primaryKey = 'id';
}

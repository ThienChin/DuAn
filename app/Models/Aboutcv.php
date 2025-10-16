<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aboutcv extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'summary',
        'skill',
        'level',
    ];
    public $timestamps = false; // Không cần created_at, updated_at

    // ✅ đảm bảo Laravel không chặn field nào
    protected $guarded = [];

    // ✅ đảm bảo khóa chính hoạt động đúng
    protected $primaryKey = 'id';

    protected $table = 'abouts'; // tên bảng trong database
}

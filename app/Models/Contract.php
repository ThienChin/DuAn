<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $table = 'contracts';

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'city',
        'postal_code',
        'phone',
        'email',
        'photo_url',
    ];

    // ✅ Nếu bảng không có created_at / updated_at thì mới cần dòng này
    public $timestamps = false;

    // ✅ Thêm bảo đảm Laravel nhận khóa chính đúng
    protected $primaryKey = 'id';

    // ✅ Đảm bảo user_id được chèn
    protected $guarded = [];
}

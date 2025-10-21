<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Experience extends Model
{
    use HasFactory;

    protected $table = 'experiences'; // tên bảng trong database

    protected $fillable = [
        'user_id',
        'job_title',
        'employer' ,
        'start_date',
        'end_date',
        'city' ,
        'description' ,
    ];
    public $timestamps = false;

    // ✅ đảm bảo Laravel không chặn field nào
    protected $guarded = [];

    // ✅ đảm bảo khóa chính hoạt động đúng
    protected $primaryKey = 'id';
}
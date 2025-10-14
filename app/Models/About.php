<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'summary',
        'skill',
        'level',
    ];
    public $timestamps = false; // Không cần created_at, updated_at

    protected $table = 'abouts'; // tên bảng trong database
}

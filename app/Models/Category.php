<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Khai báo rõ tên bảng
    protected $table = 'categories'; 

    protected $fillable = [
        'key',
        'value',
        'order',
    ];
}
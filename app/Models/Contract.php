<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Contract extends Model
{
    use HasFactory;

    protected $table = 'contracts'; // tên bảng trong database

    protected $fillable = [
        'first_name',
        'last_name',
        'city',
        'postal_code',
        'phone',
        'email',
    ];
    public $timestamps = false;
}
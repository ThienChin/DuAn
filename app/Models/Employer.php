<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Dùng Authenticatable
use Illuminate\Database\Eloquent\Model;

class Employer extends Authenticatable // Kế thừa từ Authenticatable
{
    use HasFactory;

    public function jobs()
    {
        return $this->hasMany(Job::class, 'employer_id', 'id');
    }
    
    protected $fillable = [
        'name',
        'company_name',
        'position',
        'email',
        'phone',
        'password',
        'gender',
        'address',
        'website',
        'description',
    ];

    protected $hidden = [
        'password',
    ];
}

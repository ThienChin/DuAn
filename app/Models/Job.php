<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';
<<<<<<< HEAD
    protected $fillable = ['title', 'location', 'salary', 'category', 'description', 'is_featured', 'posted_at'];
    protected $dates = ['posted_at', 'created_at', 'updated_at'];
=======
    protected $fillable = [
        'title',
        'location',
        'level',
        'remote_type',
        'salary',
        'category',
        'description',
        'is_featured',
        'posted_at',
        'company_name',
        'company_description',
        'website',
        'phone',
        'email',
        'remote',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'remote' => 'boolean',
    ];

    protected $dates = ['posted_at'];
>>>>>>> main
}
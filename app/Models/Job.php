<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';
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
        'jobs_images',
        'company_logo_url',
        'company_name',
        'company_description',
        'website',
        'phone',
        'email',
        'remote',
        'status',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'remote' => 'boolean',
    ];

    protected $dates = ['posted_at'];
}
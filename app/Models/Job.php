<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';
    protected $fillable = ['title', 'location', 'salary', 'category', 'description', 'is_featured', 'posted_at'];
    protected $dates = ['posted_at', 'created_at', 'updated_at'];
}
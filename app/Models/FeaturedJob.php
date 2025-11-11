<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturedJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'sort_order',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
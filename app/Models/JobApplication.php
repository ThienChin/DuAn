<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'user_id',
        'name',
        'email',
        'phone',
        'cv',
        'message',
        'status',
        'is_viewed_by_employer', // Nếu bạn thêm cột này vào DB
        'viewed_at', // Hoặc cột timestamp
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

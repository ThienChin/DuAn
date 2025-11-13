<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\JobApplication;
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
        'employer_id',
        
        // CÁC TRƯỜNG ĐÃ THÊM LẠI THEO YÊU CẦU:
        'experience',         // Thêm lại
        'degree',             // Thêm lại
        'gender',             // Thêm lại
        'age',                // Thêm lại
        'required_skills',    // Thêm lại
        'company_description',// Thêm lại
        'jobs_images',        // Thêm lại
        'company_logo_url',   // Thêm lại
        // HẾT CÁC TRƯỜNG ĐÃ THÊM LẠI
        
        'is_featured',
        'posted_at',
        'company_name',
        'website',
        'phone',
        'email',
        'remote',
        'status',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'remote' => 'boolean',
        'posted_at' => 'datetime',
    ];

    // protected $dates = ['posted_at'];
    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
    public function applications()
    {
        // Một Job có nhiều JobApplication
        // Khóa ngoại: job_id
        return $this->hasMany(JobApplication::class, 'job_id');
    }
    public function savedCandidates()
    {
        // Giả định bảng trung gian là 'saved_candidates'
        // 'employer_id' là khóa ngoại của Employer trong bảng trung gian
        // 'user_id' là khóa ngoại của User trong bảng trung gian
        return $this->belongsToMany(User::class, 'saved_candidates', 'employer_id', 'user_id');
    }
}
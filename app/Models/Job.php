<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\JobApplication;
use App\Models\Employer;
use App\Models\User;
// Cần import Category vì các quan hệ khác đang dùng nó
use App\Models\Category; 

class Job extends Model
{
    protected $table = 'jobs';

    protected $fillable = [
        'title',
        'salary',
        'description',
        'employer_id',
        
        // CÁC CỘT KHÓA NGOẠI (từ bảng categories)
        'category_id',
        'location_id',
        'level_id',
        'experience_id',
        'degree_id',
        'gender_id',
        
        // SỬA: Thay 'remote_type' bằng 'remote_type_id'
        'remote_type_id',  // <-- KHÓA NGOẠI MỚI
        
        // CÁC TRƯỜNG KHÁC
        'age',                
        'required_skills',    
        'company_description',
        'jobs_images',        
        'company_logo_url',   
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
        'remote'      => 'boolean',
        'posted_at'   => 'datetime',
        'salary'      => 'integer',
    ];

    // ==================== QUAN HỆ ====================

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'job_id');
    }

    public function savedCandidates()
    {
        return $this->belongsToMany(User::class, 'saved_candidates', 'employer_id', 'user_id');
    }

    // --- QUAN HỆ VỚI CATEGORY ---
    public function locationItem()
    {
        return $this->belongsTo(Category::class, 'location_id', 'key');    
    }

    public function levelItem()
    {
        return $this->belongsTo(Category::class, 'level_id');
    }

    public function categoryItem()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function experienceItem()
    {
        return $this->belongsTo(Category::class, 'experience_id');
    }

    public function genderItem()
    {
        return $this->belongsTo(Category::class, 'gender_id');
    }

    public function degreeItem()
    {
        return $this->belongsTo(Category::class, 'degree_id');
    }

    // SỬA: BỎ COMMENT và sử dụng quan hệ này
    public function remoteTypeItem()
    {
        return $this->belongsTo(Category::class, 'remote_type_id');
    }
}
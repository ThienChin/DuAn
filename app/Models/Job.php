<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\JobApplication;
class Job extends Model
{
    protected $table = 'jobs';
    protected $fillable = [
        'title',
        'salary',
        'description',
        'employer_id',
        
        // ✅ CÁC CỘT KHÓA NGOẠI MỚI (Từ bảng categories)
        'category_id',
        'location_id',
        'level_id',
        'remote_type_id',
        'experience_id',
        'degree_id',
        'gender_id',
        
        // ... CÁC TRƯỜNG CÒN LẠI GIỮ NGUYÊN ...
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
    // ✅ THÊM MỐI QUAN HỆ VỚI TỪNG DANH MỤC
    public function categoryItem()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    
    public function locationItem()
    {
        return $this->belongsTo(Category::class, 'location_id', 'key');    
    }
    
    public function levelItem()
    {
        return $this->belongsTo(Category::class, 'level_id');
    }
    
    public function remoteTypeItem()
    {
        return $this->belongsTo(Category::class, 'remote_type_id');
    }
    
    public function experienceItem()
    {
        return $this->belongsTo(Category::class, 'experience_id');
    }
    
    public function degreeItem()
    {
        return $this->belongsTo(Category::class, 'degree_id');
    }
    
    public function genderItem()
    {
        return $this->belongsTo(Category::class, 'gender_id');
    }
}
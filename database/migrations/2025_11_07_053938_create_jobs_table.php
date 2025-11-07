<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Sử dụng Schema::create('jobs') theo yêu cầu của bạn
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            
            // Cột cơ bản
            $table->string('title');
            $table->string('location');
            $table->enum('level', ['Internship', 'Junior', 'Senior']);
            $table->enum('remote_type', ['Full Time', 'Contract', 'Part Time']);
            $table->decimal('salary', 15, 2);
            $table->string('category')->nullable();
            $table->text('description');
            
            // Cột Featured
            $table->boolean('is_featured')->default(false);
            $table->timestamp('posted_at')->nullable();
            
            // CỘT ẢNH: jobs_images (Ảnh lớn cho Featured Job)
            // Cột này cần thiết nếu bạn muốn sử dụng logic Featured Job
            $table->string('jobs_images')->nullable(); 
            
            // CỘT ẢNH: company_logo_url (Logo nhỏ, dùng trong job card thông thường)
            // Cột này đã được thêm vào lệnh INSERT và Blade template của bạn
            $table->string('company_logo_url')->nullable(); 

            // Thông tin công ty
            $table->string('company_name');
            $table->text('company_description')->nullable();
            $table->string('website')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->boolean('remote')->default(false);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
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
        Schema::create('featured_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('location');
            
            // Cột 'salary'
            $table->decimal('salary', 15, 2);
            
            // CỘT MỚI ĐƯỢC THÊM: company_logo_url
            // Dùng để lưu đường dẫn đến logo nhỏ của công ty (dạng URL string)
            $table->string('company_logo_url')->nullable(); 

            // Các cột còn lại
            $table->enum('level', ['Internship', 'Junior', 'Senior']);
            $table->enum('remote_type', ['Full Time', 'Contract', 'Part Time']);
            $table->string('category')->nullable();
            $table->text('description');
            $table->boolean('is_featured')->default(false);
            $table->timestamp('posted_at')->nullable();
            
            // Cột jobs_images (trước đó bạn muốn đặt là jobs_oimages)
            $table->string('jobs_images')->nullable(); 
            
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
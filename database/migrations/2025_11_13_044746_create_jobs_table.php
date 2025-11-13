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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();

            // ✅ Nhà tuyển dụng đăng job (FOREIGN KEY)
            $table->foreignId('employer_id')
                ->constrained('employers')
                ->onDelete('cascade');

            // Cột cơ bản
            $table->string('title');
            $table->string('location');
            $table->enum('level', ['Internship', 'Junior', 'Senior']);
            $table->enum('remote_type', ['Full Time', 'Contract', 'Part Time']);
            $table->decimal('salary', 15, 2)->nullable(); // Cho phép 'Thương lượng' (NULL/0)
            $table->string('category')->nullable();
            $table->text('description');

            // ✅ CÁC CỘT MỚI THÊM VÀO THEO MODEL
            $table->string('experience')->nullable();
            $table->string('degree')->nullable();
            $table->string('gender')->nullable();
            $table->string('age')->nullable();
            $table->text('required_skills')->nullable(); 

            // Featured & Posted
            $table->boolean('is_featured')->default(false);
            $table->timestamp('posted_at')->nullable();

            // Ảnh & Thông tin công ty
            $table->string('jobs_images')->nullable(); 
            $table->string('company_logo_url')->nullable();
            $table->string('company_name');
            $table->text('company_description')->nullable();
            $table->string('website')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->boolean('remote')->default(false);

            // ✅ STATUS: admin duyệt job
            $table->enum('status', ['pending', 'approved', 'rejected'])
                ->default('pending');

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
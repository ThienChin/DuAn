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
            
            // Cột cơ bản
            $table->string('title');
            $table->string('location');
            $table->enum('level', ['Internship', 'Junior', 'Senior']);
            $table->enum('remote_type', ['Full Time', 'Contract', 'Part Time']);
            $table->decimal('salary', 15, 2);
            $table->string('category')->nullable();
            $table->text('description');
            
            // Featured
            $table->boolean('is_featured')->default(false);
            $table->timestamp('posted_at')->nullable();
            
            // Ảnh
            $table->string('jobs_images')->nullable(); 
            $table->string('company_logo_url')->nullable();

            // Thông tin công ty
            $table->string('company_name');
            $table->text('company_description')->nullable();
            $table->string('website')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->boolean('remote')->default(false);

            // ✅ STATUS
            $table->enum('status', ['pending', 'approved', 'rejected'])
                  ->default('pending')
                  ->comment('pending = đợi duyệt, approved = đã duyệt, rejected = từ chối');

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
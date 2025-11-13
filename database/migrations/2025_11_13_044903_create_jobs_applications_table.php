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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            
            // ✨ KHÓA NGOẠI CHUẨN: job_id tham chiếu đến bảng 'jobs'
            $table->foreignId('job_id')->constrained('jobs')->onDelete('cascade');
            
            // ✨ KHÓA NGOẠI CHUẨN: user_id tham chiếu đến bảng 'users', cho phép NULL nếu user bị xóa
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); 

            $table->string('name');
            $table->string('email');
            $table->string('cv')->nullable(); // link tới file CV nếu có upload
            $table->text('message')->nullable();
            
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
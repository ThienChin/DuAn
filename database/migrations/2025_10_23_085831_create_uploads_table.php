<?php

// ...
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
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            // Khóa ngoại liên kết với bảng users
            $table->unsignedBigInteger('user_id'); 
            $table->string('name');              // Tên file gốc (ví dụ: "CV_NguyenVanA.pdf")
            $table->string('path');              // Đường dẫn file đã lưu (ví dụ: "uploads/cv/1678888888_CV.pdf")
            $table->timestamps();

            // Thiết lập ràng buộc khóa ngoại
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uploads');
    }
};

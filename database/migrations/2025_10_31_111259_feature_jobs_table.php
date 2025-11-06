<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('featured_jobs', function (Blueprint $table) {
            $table->id(); 
            
            // 🌟 CÁC CỘT CHI TIẾT CÔNG VIỆC 🌟
            $table->string('title', 255)->notNull();
            $table->string('location', 100)->notNull();
            $table->decimal('salary', 15, 2)->notNull(); 

            // 🌟 THAY THẾ: featured_image_url thành company_logo_url 🌟
            $table->string('company_logo_url', 255)->nullable()
                ->comment('Đường dẫn URL logo công ty'); // Cập nhật comment cho rõ ràng hơn

            // Cột tùy chọn: Thứ tự hiển thị
            $table->integer('sort_order')->default(0); 

            $table->timestamps();

            // Thêm index cho sắp xếp
            $table->index('sort_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('featured_jobs');
    }
};
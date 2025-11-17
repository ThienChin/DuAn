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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            
            // Ví dụ: 'category', 'location', 'level', 'experience'...
            $table->string('key'); 
            
            // Giá trị cụ thể: 'IT', 'Hà Nội', 'Senior'...
            $table->string('value'); 
            
            // Thứ tự hiển thị
            $table->unsignedInteger('order')->default(0);

            // Đảm bảo không có 2 danh mục cùng loại (key) có cùng giá trị (value)
            $table->unique(['key', 'value']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
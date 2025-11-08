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
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            // 1. Thông tin cá nhân
            $table->string('name'); // Tên người liên hệ (tên cá nhân)
            $table->enum('gender', ['Nam', 'Nữ'])->nullable(); // Giới tính (theo form đăng ký)

            // 2. Thông tin xác thực
            $table->string('email')->unique(); // Email (để đăng nhập, phải là duy nhất)
            $table->string('password'); // Mật khẩu (đã hash)
            $table->rememberToken()->nullable(); // Token ghi nhớ đăng nhập

            // 3. Thông tin công ty
            $table->string('company_name'); // Tên công ty
            $table->string('position')->nullable(); // Chức vụ người liên hệ
            $table->string('phone')->nullable(); // Số điện thoại
            $table->string('address')->nullable(); // Địa chỉ (hoặc tỉnh/thành)
            $table->string('website')->nullable(); // Website công ty
            $table->text('description')->nullable(); // Mô tả công ty

            // Laravel Timestamps (created_at và updated_at)
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employers');
    }
};
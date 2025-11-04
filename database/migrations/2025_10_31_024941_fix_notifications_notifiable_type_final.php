<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            // BƯỚC 1: Cho phép NULL tạm thời
            $table->string('notifiable_type')->nullable()->change();

            // BƯỚC 2: Cập nhật tất cả NULL → 'App\Models\User'
            \DB::statement("UPDATE notifications SET notifiable_type = 'App\\Models\\User' WHERE notifiable_type IS NULL");

            // BƯỚC 3: Đặt NOT NULL + DEFAULT
            $table->string('notifiable_type')->default('App\\Models\\User')->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->string('notifiable_type')->nullable()->change();
        });
    }
};
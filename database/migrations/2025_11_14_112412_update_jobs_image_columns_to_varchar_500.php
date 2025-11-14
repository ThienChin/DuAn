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
        // Yêu cầu package doctrine/dbal nếu chưa có để dùng change()
        Schema::table('jobs', function (Blueprint $table) {
            // Tăng giới hạn VARCHAR từ 255 lên 500 ký tự
            $table->string('jobs_images', 500)->nullable()->change();
            $table->string('company_logo_url', 500)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            // Quay lại giới hạn VARCHAR mặc định
            $table->string('jobs_images', 255)->nullable()->change();
            $table->string('company_logo_url', 255)->nullable()->change();
        });
    }
};
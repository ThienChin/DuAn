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
        Schema::table('users', function (Blueprint $table) {
            // Thêm cột Phone (String, độ dài 20, có thể null)
            $table->string('phone', 20)->nullable()->after('email');
            
            // Thêm cột Address (String, có thể null)
            $table->string('address')->nullable()->after('phone');
            
            // Thêm cột Gender (Enum, có thể null)
            $table->enum('gender', ['Male', 'Female'])->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Lệnh rollback để xóa các cột khi hoàn tác
            $table->dropColumn(['phone', 'address', 'gender']);
        });
    }
};
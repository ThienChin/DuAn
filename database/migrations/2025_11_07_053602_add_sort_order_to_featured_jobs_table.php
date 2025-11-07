<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('featured_jobs', function (Blueprint $table) {
            // Thêm cột 'sort_order' là kiểu số nguyên, cho phép NULL và có giá trị mặc định là 0
            $table->unsignedInteger('sort_order')->default(0)->after('is_featured'); 
        });
    }

    public function down(): void
    {
        Schema::table('featured_jobs', function (Blueprint $table) {
            $table->dropColumn('sort_order');
        });
    }
};
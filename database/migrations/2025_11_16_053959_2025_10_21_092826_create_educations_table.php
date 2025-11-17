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
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('school', 255);         // tên trường
            $table->string('degree', 100)->nullable(); // bằng cấp
            $table->date('grad_date')->nullable();     // ngày tốt nghiệp
            $table->string('city', 255)->nullable();   // thành phố
            $table->text('description')->nullable();   // mô tả thêm
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {   
        Schema::dropIfExists('educations');
    }
};
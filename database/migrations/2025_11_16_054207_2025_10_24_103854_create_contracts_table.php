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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('city', 100)->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 255);
            
            // --- ĐÃ SỬA LỖI: BỎ AFTER KHI DÙNG Schema::create ---
            // Cột này sẽ được đặt ở cuối danh sách (trước timestamps)
            $table->string('photo_url')->nullable(); 
            // ----------------------------------------------------
            
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    { 
        Schema::dropIfExists('contracts'); 
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('location', 255);
            $table->decimal('salary', 10, 2);
            $table->string('category', 255);
            $table->text('description')->nullable();
            $table->tinyInteger('is_featured')->default(0);
            $table->timestamp('posted_at')->useCurrent(); // Đảm bảo là timestamp
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
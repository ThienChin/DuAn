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
        Schema::create('job_applications', function (Blueprint $table) {
        $table->id();

        $table->foreignId('job_id')->constrained('jobs')->onDelete('cascade');
        $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();

        // Thông tin ứng viên
        $table->string('name');
        $table->string('email');
        $table->string('phone')->nullable();

        // CV & message
        $table->string('cv')->nullable();
        $table->text('message')->nullable();

        // Trạng thái ứng tuyển
        $table->enum('status', ['pending', 'reviewed', 'accepted', 'rejected'])
            ->default('pending');

        $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};

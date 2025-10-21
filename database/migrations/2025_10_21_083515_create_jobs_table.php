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
            $table->string('title');
            $table->string('location');
            $table->enum('level', ['Internship', 'Junior', 'Senior']);
            $table->enum('remote_type', ['Full Time', 'Contract', 'Part Time']);
            $table->decimal('salary', 15, 2);
            $table->string('category')->nullable();
            $table->text('description');
            $table->boolean('is_featured')->default(false);
            $table->date('posted_at')->nullable();
            $table->string('company_name');
            $table->text('company_description')->nullable();
            $table->string('website')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->boolean('remote')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
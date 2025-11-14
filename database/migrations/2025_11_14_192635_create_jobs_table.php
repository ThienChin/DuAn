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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')
                ->constrained('employers')
                ->onDelete('cascade');

            // Cột cơ bản
            $table->string('title');

            $table->decimal('salary', 15, 2)->nullable(); // Cho phép 'Thương lượng' (NULL/0)
            $table->string('category')->nullable();
            $table->text('description');
            
            // ✅ CÁC CỘT KHÓA NGOẠI trỏ đến bảng categories
            $table->foreignId('category_id')->nullable()->constrained('categories');     // Ngành nghề
            $table->foreignId('location_id')->nullable()->constrained('categories');     // Địa điểm
            $table->foreignId('level_id')->nullable()->constrained('categories');        // Cấp bậc
            $table->foreignId('remote_type_id')->nullable()->constrained('categories');  // Hình thức làm việc (Mục đích của bạn)
            $table->foreignId('experience_id')->nullable()->constrained('categories');   // Kinh nghiệm
            $table->foreignId('degree_id')->nullable()->constrained('categories');       // Bằng cấp
            $table->foreignId('gender_id')->nullable()->constrained('categories');       // Giới tính
            $table->string('age')->nullable();
            $table->text('required_skills')->nullable();  

            // Featured & Posted
            $table->boolean('is_featured')->default(false);
            $table->timestamp('posted_at')->nullable();
            $table->string('jobs_images')->nullable(); 
            $table->string('company_logo_url')->nullable();
            $table->string('company_name');
            $table->text('company_description')->nullable();
            $table->string('website')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->boolean('remote')->default(false); // Làm việc Remote hay tại văn phòng

            // ✅ STATUS: admin duyệt job
            $table->enum('status', ['pending', 'approved', 'rejected'])
                ->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    
    }
};
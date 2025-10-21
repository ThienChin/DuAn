<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // 🔹 Kiểm tra nếu chưa có admin nào thì mới tạo
        if (!Admin::where('email', 'thiendz362@gmail.com')->exists()) {
            Admin::create([
                'name' => 'Thien',
                'email' => 'thiendz362@gmail.com',
                'password' => Hash::make('thien1221'), // đổi khi deploy nhé
            ]);
        }
    }
}

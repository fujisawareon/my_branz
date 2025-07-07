<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Manager;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ManagerSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make('password');
        Manager::create([
            'user_name' => 'Test User',
            'email' => 'test@test.jp',
            'role' => 1,
            'status' => 1,
            'password' => $password,
        ]);

        $bulk_insert_data = [];
        for ($customer_id = 1; $customer_id <= 300; $customer_id++) {
            $factory = Manager::factory()->make()->toArray();

            $factory['password'] = $password;
            $bulk_insert_data[] = $factory;
        }

        // 一括挿入
        Manager::insert($bulk_insert_data);
    }
}

<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\CustomerBuilding;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make('password');

        $bulk_insert_data = [];
        for ($customer_id = 1; $customer_id <= 1000; $customer_id++) {
            $factory = Customer::factory()->make()->toArray();

            $factory['email_verified_at'] = now()->format('Y-m-d H:i:s');
            $factory['password'] = $password;
            $bulk_insert_data[] = $factory;
        }

        // 一括挿入
        Customer::insert($bulk_insert_data);

        // Customer-Buildingリレーションを作成
        // 全Customerと全BuildingのIDを取得
        $customer_ids = Customer::pluck('id')->all();
        $building_ids = \App\Models\Building::pluck('id')->all();
        $bulk_pivot_data = [];

        foreach ($customer_ids as $customer_id) {
            // 0〜3件のランダムなBuildingを選択
            $num = rand(0, 3);
            $selected_building_ids = collect($building_ids)->shuffle()->take($num);
            foreach ($selected_building_ids as $building_id) {
                $factory = CustomerBuilding::factory()->make()->toArray();
                $factory['building_id'] = $building_id;
                $factory['customer_id'] = $customer_id;
                $factory['entry_at'] = now()->format('Y-m-d H:i:s');

                $bulk_pivot_data[] = $factory;
            }
        }

        if (!empty($bulk_pivot_data)) {
            \App\Models\CustomerBuilding::insert($bulk_pivot_data);
        }
    }
}

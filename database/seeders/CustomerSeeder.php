<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Building;
use App\Models\Customer;
use App\Models\CustomerBuilding;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        // 顧客ユーザー作成
        $password = Hash::make('password');
        $bulk_insert_data = [];
        for ($i = 1; $i <= 1000; $i++) {
            $factory = Customer::factory()->make()->toArray();

            $factory['email_verified_at'] = now()->format('Y-m-d H:i:s');
            $factory['password'] = $password;
            $bulk_insert_data[] = $factory;
        }
        Customer::insert($bulk_insert_data);

        // 顧客と物件のリレーションを作成
        $customer_ids = Customer::pluck('id')->all(); // 全顧客のIDを取得
        $building_ids = Building::where('id', '<=', 10)->pluck('id')->all(); // 全物件のIDを取得
        $bulk_pivot_data = [];
        foreach ($customer_ids as $customer_id) {
            // 3件未満の適当な物件を選択
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
            CustomerBuilding::insert($bulk_pivot_data);
        }
    }
}

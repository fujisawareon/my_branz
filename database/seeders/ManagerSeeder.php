<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Building;
use App\Models\Manager;
use App\Models\BuildingInvitation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ManagerSeeder extends Seeder
{
    public function run(): void
    {
        // 業務ユーザー作成
        $password = Hash::make('password');
        Manager::create([
            'user_name' => 'Test User',
            'email' => 'test@test.jp',
            'role' => 1,
            'status' => 1,
            'password' => $password,
        ]);
        $bulk_insert_data = [];
        for ($i = 1; $i <= 300; $i++) {
            $factory = Manager::factory()->make()->toArray();

            $factory['password'] = $password;
            $bulk_insert_data[] = $factory;
        }
        Manager::insert($bulk_insert_data);

        // 業務ユーザーと物件のリレーションを作成
        $manager_ids = Manager::where('id', '!=', 1)->pluck('id')->all(); // 全業務ユーザーのIDを取得
        $building_ids = Building::pluck('id')->all(); // 全物件のIDを取得
        $bulk_pivot_data = [];
        foreach ($manager_ids as $manager_id) {
            // 3件未満の適当な物件を選択
            $num = rand(0, 3);
            $selected_building_ids = collect($building_ids)->shuffle()->take($num);
            foreach ($selected_building_ids as $building_id) {
                $building_invitation = [
                    'building_id' => $building_id,
                    'manager_id' => $manager_id,
                    'created_by' => 1,
                ];
                $bulk_pivot_data[] = $building_invitation;
            }
        }

        if (!empty($bulk_pivot_data)) {
            BuildingInvitation::insert($bulk_pivot_data);
        }
    }
}

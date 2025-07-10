<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Manager>
 */
class CustomerBuildingFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $customer_status = fake()->numberBetween(0, 12);

        return [
            'customer_id' => 1,
            'building_id' => 1,
            'person_in_charge' => rand(0, 5),

            'prefecture' => $this->faker->randomElement(['東京都', '大阪府', '愛知県']),
            'city' => $this->faker->randomElement(['渋谷区', '港区', '世田谷区']),
            'town' => $this->faker->randomElement(['麻布', '芝浦', '祖師谷大蔵']),
            'chome' => rand(1, 5) . '丁目',
            'banchi' => rand(1, 50) . '-' . rand(1, 20),
            'apartment_detail' => $this->faker->randomElement([
                'サンシャインハイツ 101号室',
                'グリーンコート 202号室',
                'スカイレジデンス 305号室',
                'メゾンフローラ 1-A',
            ]),

            'sumai_type' => '未設定', // 必須項目があれば適宜修正

            'desired_area_min' => rand(20, 100),
            'desired_area_max' => rand(20, 100),
            'desired_price' => rand(1000, 5000),
            'fund' => rand(1000, 5000),
            'income' => rand(1000, 5000),
            'household_income' => rand(1000, 5000),
            'expected_residents' => rand(1, 5),
            'occupation' => fake()->word(),
            'office' => fake()->word(),

            'is_inner' => fake()->numberBetween(0, 1),
            'is_online_seminar_watching' => $customer_status >= 1 ? 1 : 0,
            'is_online_sales_meeting_reserve' => $customer_status >= 2 ? 1 : 0,
            'is_online_sales_meeting' => $customer_status >= 3 ? 1 : 0,
            'is_free_observe_reserve' => $customer_status >= 4 ? 1 : 0,
            'is_free_observe' => $customer_status >= 5 ? 1 : 0,
            'is_first_visit_reserve' => $customer_status >= 6 ? 1 : 0,
            'is_first_visit' => $customer_status >= 7 ? 1 : 0,
            'is_needs_recept' => $customer_status >= 8 ? 1 : 0,
            'is_regist_recept' => $customer_status >= 9 ? 1 : 0,
            'is_apply' => $customer_status >= 10 ? 1 : 0,
            'is_contract' => $customer_status >= 11 ? 1 : 0,
            'is_handover' => $customer_status >= 12 ? 1 : 0,
            'is_stop_considering' => (rand(1, 10) === 1 && $customer_status < 10) ? 1 : 0,

            'base_score' => rand(0, 100),
            'behavior_score' => rand(0, 999),
            'score' => fake()->word(),

            'customer_status' => $customer_status, // 0〜5 のランダムな数字
            'relation_status' => rand(1, 2), // 1〜2 のランダムな数字
            'created_by' => 1,
        ];
    }
}

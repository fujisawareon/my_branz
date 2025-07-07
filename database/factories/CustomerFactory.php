<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Manager>
 */
class CustomerFactory extends Factory
{
    private static int $sequence = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        self::$sequence++;

        return [
            'web_customer_id' => 'WEB' . str_pad((string)self::$sequence, 5, '0', STR_PAD_LEFT),
            'sei' => '姓' . self::$sequence,
            'mei' => '名' . self::$sequence,
            'sei_kana' => 'セイ' . self::$sequence,
            'mei_kana' => 'メイ' . self::$sequence,
            'gender' => rand(0, 1),
            'birthday' => (string)now()->subYears(rand(20, 60))->format('Y-m-d'),
            'tel' => '090' . rand(10000000, 99999999),
            'fax' => '03' . rand(10000000, 99999999),
            'email' => 'customer' . self::$sequence . '@example.com',
            'status' => rand(0, 1),
            'remember_token' => Str::random(10),
            'first_registration_flag' => rand(0, 1),
            'agreement_at' => now(),
            'created_by' => 1,
            'updated_by_manager' => 1,
            'updated_by_customer' => 1,
        ];
    }
}

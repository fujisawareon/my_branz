<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // キャッシュをクリアする
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');

        $tables = [
            'buildings',
            'building_setting',
            'customers',
            'customer_building',
            'managers',
        ];

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        $this->call([
            BuildingSeeder::class,
            CustomerSeeder::class,
            ManagerSeeder::class,
        ]);
    }
}

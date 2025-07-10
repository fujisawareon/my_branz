<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Building;
use App\Models\BuildingSetting;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Building::factory(30)->create()->each(function ($building) {
            BuildingSetting::create([
                'building_id' => $building->id,
                'sales_suspension_title' => '',
                'sales_suspension_message' => '',
                'location' => null,
                'nearest_station' => null,
                'max_building_price' => 0,
                'max_interest_rate' => 0.000,
                'building_site_url' => '',
                'building_site_display_flg' => 0,
                'image_gallery_annotation' => null,
                'local_photo_annotation' => null,
                'environment_image_path' => null,
                'annotation_text' => null,
                'area_map_address' => null,
                'area_map_latitude' => null,
                'area_map_longitude' => null,
                'created_by' => 1,
                'updated_by' => null,
            ]);
        });
    }
}

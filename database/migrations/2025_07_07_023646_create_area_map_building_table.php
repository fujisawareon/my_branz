<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('area_map_building', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->bigInteger('building_id')->default(0)->comment('物件ID');
            $table->bigInteger('area_map_category_id')->default(0)->comment('周辺マップカテゴリID');
            $table->string('name', 100)->default('')->comment('建物名');
            $table->string('address', 1000)->default('')->comment('住所');
            $table->decimal('latitude', 10, 7)->comment('緯度');
            $table->decimal('longitude', 11, 7)->comment('経度');
            $table->tinyInteger('sort')->default(0)->comment('並び順');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('作成日時');
            $table->integer('created_by')->nullable()->comment('作成者');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');
            $table->softDeletes();

            $table->index('building_id', 'idx_area_map_building_building_id');
        });

        Schema::create('area_map_building_history', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');

            $table->bigInteger('area_map_building_id')->comment('area_map_buildingのID');
            $table->bigInteger('building_id')->comment('物件ID');
            $table->bigInteger('area_map_category_id')->comment('周辺マップカテゴリID');
            $table->string('name', 100)->comment('建物名');
            $table->string('address', 1000)->comment('住所');
            $table->decimal('latitude', 10, 7)->comment('緯度');
            $table->decimal('longitude', 11, 7)->comment('経度');
            $table->tinyInteger('sort')->default(0)->comment('並び順');

            $table->timestamp('created_at')->comment('作成日時');
            $table->integer('created_by')->comment('作成者');
            $table->timestamp('updated_at')->nullable()->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');

            $table->index('building_id', 'idx_area_map_building_history_building_id');
        });

        DB::unprepared('
            CREATE TRIGGER trg_area_map_building_after_update
            AFTER UPDATE ON area_map_building
            FOR EACH ROW
            BEGIN
                INSERT INTO area_map_building_history (
                    area_map_building_id,
                    building_id,
                    area_map_category_id,
                    name,
                    address,
                    latitude,
                    longitude,
                    sort,
                    created_at,
                    created_by,
                    updated_at,
                    updated_by
                ) VALUES (
                    OLD.id,
                    OLD.building_id,
                    OLD.area_map_category_id,
                    OLD.name,
                    OLD.address,
                    OLD.latitude,
                    OLD.longitude,
                    OLD.sort,
                    OLD.created_at,
                    OLD.created_by,
                    OLD.updated_at,
                    OLD.updated_by
                );
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('area_map_building');
        Schema::dropIfExists('area_map_building_history');
    }
};

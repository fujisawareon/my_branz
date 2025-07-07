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
        Schema::create('area_map_category', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->unsignedBigInteger('building_id')->comment('物件ID');
            $table->string('category_key', 100)->comment('カテゴリーキー');
            $table->tinyInteger('use_flg')->default(0)->comment('表示フラグ');
            $table->tinyInteger('sort')->default(0)->comment('並び順');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('作成日時');
            $table->integer('created_by')->nullable()->comment('作成者');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');
            $table->softDeletes();

            $table->index('building_id', 'idx_area_map_category_building_id');
        });

        Schema::create('area_map_category_history', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');

            $table->unsignedBigInteger('area_map_category_id')->comment('area_map_categoryのID');
            $table->unsignedBigInteger('building_id')->comment('物件ID');
            $table->string('category_key', 100)->comment('カテゴリーキー');
            $table->tinyInteger('use_flg')->default(0)->comment('表示フラグ');
            $table->tinyInteger('sort')->default(0)->comment('並び順');

            $table->timestamp('created_at')->comment('作成日時');
            $table->integer('created_by')->comment('作成者');
            $table->timestamp('updated_at')->nullable()->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');

            $table->index('building_id', 'idx_area_map_category_history_building_id');
        });

        DB::unprepared('
            CREATE TRIGGER trg_area_map_category_after_update
            AFTER UPDATE ON area_map_category
            FOR EACH ROW
            BEGIN
                INSERT INTO area_map_category_history (
                    area_map_category_id,
                    building_id,
                    category_key,
                    use_flg,
                    sort,
                    created_at,
                    created_by,
                    updated_at,
                    updated_by
                ) VALUES (
                    OLD.id,
                    OLD.building_id,
                    OLD.category_key,
                    OLD.use_flg,
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
        Schema::dropIfExists('area_map_category');
        Schema::dropIfExists('area_map_category_history');
    }
};

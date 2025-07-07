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
        Schema::create('buildings', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('物件ID');
            $table->string('building_name', 255)->comment('物件名');
            $table->string('building_8_digit_code', 10)->comment('物件8桁コード');
            $table->string('building_4_digit_code', 5)->comment('物件4桁コード');
            $table->tinyInteger('contents_design_flg')->default(0)->comment('限定コンテンツデザイン');
            $table->tinyInteger('sales_status')->default(0)->comment('販売フラグ');
            $table->string('top_image')->nullable()->comment('TOP画像');
            $table->string('thumbnail_image')->comment('サムネイル画像');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('作成日時');
            $table->integer('created_by')->comment('作成者');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');
            $table->softDeletes();

            // インデックス
            $table->index(['building_8_digit_code'], 'idx_buildings_building_8_digit_code');
            $table->index(['building_4_digit_code'], 'idx_buildings_building_4_digit_code');
        });

        Schema::create('buildings_history', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');

            $table->unsignedBigInteger('building_id')->comment('物件ID');
            $table->string('building_name', 255)->comment('物件名');
            $table->string('building_8_digit_code', 10)->comment('物件8桁コード');
            $table->string('building_4_digit_code', 5)->comment('物件4桁コード');
            $table->tinyInteger('contents_design_flg')->default(0)->comment('限定コンテンツデザイン');
            $table->tinyInteger('sales_status')->default(0)->comment('販売フラグ');
            $table->string('top_image')->nullable()->comment('TOP画像');
            $table->string('thumbnail_image')->comment('サムネイル画像');

            $table->timestamp('created_at')->comment('作成日時');
            $table->integer('created_by')->comment('作成者');
            $table->timestamp('updated_at')->nullable()->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');

            // インデックス
            $table->index(['building_id'], 'idx_buildings_history_building_id');
        });

        DB::unprepared('
            CREATE TRIGGER trg_buildings_after_update
            AFTER UPDATE ON buildings
            FOR EACH ROW
            BEGIN
                INSERT INTO buildings_history (
                    building_id,
                    building_name,
                    building_8_digit_code,
                    building_4_digit_code,
                    contents_design_flg,
                    sales_status,
                    top_image,
                    thumbnail_image,
                    created_at,
                    created_by,
                    updated_at,
                    updated_by
                ) VALUES (
                    old.id,
                    old.building_name,
                    old.building_8_digit_code,
                    old.building_4_digit_code,
                    old.contents_design_flg,
                    old.sales_status,
                    old.top_image,
                    old.thumbnail_image,
                    old.created_at,
                    old.created_by,
                    old.updated_at,
                    old.updated_by
                );
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buildings');
        Schema::dropIfExists('buildings_history');
    }
};

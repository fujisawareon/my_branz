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
        Schema::create('floor_plan', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->bigInteger('building_id')->comment('物件ID');
            $table->bigInteger('floor_type_id')->comment('間取タイプID');
            $table->string('title', 100)->comment('プランタイトル');
            $table->tinyInteger('layout')->comment('間取り');
            $table->string('display_name', 100)->comment('間取りプラン表示名');
            $table->string('image_pass', 100)->comment('画像');
            $table->string('note', 5000)->nullable()->default(null)->comment('注釈');
            $table->boolean('display_flg')->default(0)->comment('表示フラグ');
            $table->tinyInteger('sort')->default(0)->comment('並び順');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('作成日時');
            $table->integer('created_by')->comment('作成者');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');
            $table->softDeletes()->comment('削除日時');

            $table->index('building_id', 'idx_floor_plan_building_id');
            $table->index('floor_type_id', 'idx_floor_plan_floor_type_id');
        });

        Schema::create('floor_plan_history', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');

            $table->bigInteger('floor_plan_id')->comment('floor_planのID');
            $table->bigInteger('building_id')->comment('物件ID');
            $table->bigInteger('floor_type_id')->comment('間取タイプID');
            $table->string('title', 100)->comment('プランタイトル');
            $table->tinyInteger('layout')->comment('間取り');
            $table->string('display_name', 100)->comment('間取りプラン表示名');
            $table->string('image_pass', 100)->comment('画像');
            $table->string('note', 5000)->nullable()->default(null)->comment('注釈');
            $table->boolean('display_flg')->default(0)->comment('表示フラグ');
            $table->tinyInteger('sort')->default(0)->comment('並び順');

            $table->timestamp('created_at')->comment('作成日時');
            $table->integer('created_by')->comment('作成者');
            $table->timestamp('updated_at')->nullable()->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');

            $table->index('building_id', 'idx_floor_plan_history_building_id');
            $table->index('floor_type_id', 'idx_floor_plan_history_floor_type_id');
        });

        DB::unprepared('
            CREATE TRIGGER trg_floor_plan_after_update
            AFTER UPDATE ON floor_plan
            FOR EACH ROW
            BEGIN
                INSERT INTO floor_plan_history (
                    floor_plan_id,
                    building_id,
                    floor_type_id,
                    title,
                    layout,
                    display_name,
                    image_pass,
                    note,
                    display_flg,
                    sort,
                    created_at,
                    created_by,
                    updated_at,
                    updated_by
                ) VALUES (
                    OLD.id,
                    OLD.building_id,
                    OLD.floor_type_id,
                    OLD.title,
                    OLD.layout,
                    OLD.display_name,
                    OLD.image_pass,
                    OLD.note,
                    OLD.display_flg,
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
        Schema::dropIfExists('floor_plan');
        Schema::dropIfExists('floor_plan_history');
    }
};

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
        Schema::create('sales_schedule', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->unsignedBigInteger('building_id')->comment('物件ID');
            $table->string('schedule_key', 100)->comment('スケジュールキー');
            $table->tinyInteger('sort')->comment('並び順');
            $table->boolean('display_flg')->comment('表示フラグ');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('作成日時');
            $table->integer('created_by')->comment('作成者');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');
            $table->softDeletes()->comment('削除日時');

            $table->index('building_id', 'idx_sales_schedule_building_id');
        });

        Schema::create('sales_schedule_history', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');

            $table->bigInteger('sales_schedule_id')->comment('sales_scheduleのID');
            $table->bigInteger('building_id')->comment('物件ID');
            $table->string('schedule_key', 100)->comment('スケジュールキー');
            $table->tinyInteger('sort')->comment('並び順');
            $table->boolean('display_flg')->comment('表示フラグ');

            $table->timestamp('created_at')->comment('作成日時');
            $table->integer('created_by')->comment('作成者');
            $table->timestamp('updated_at')->nullable()->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');

            $table->index('building_id', 'idx_sales_schedule_history_building_id');
        });

        DB::unprepared('
            CREATE TRIGGER trg_sales_schedule_after_update
            AFTER UPDATE ON sales_schedule
            FOR EACH ROW
            BEGIN
                INSERT INTO sales_schedule_history (
                    sales_schedule_id,
                    building_id,
                    schedule_key,
                    sort,
                    display_flg,
                    created_at,
                    created_by,
                    updated_at,
                    updated_by
                ) VALUES (
                    OLD.id,
                    OLD.building_id,
                    OLD.schedule_key,
                    OLD.sort,
                    OLD.display_flg,
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
        Schema::dropIfExists('sales_schedule_history');
        Schema::dropIfExists('sales_schedule');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_sales_schedule_after_update;');
    }
};

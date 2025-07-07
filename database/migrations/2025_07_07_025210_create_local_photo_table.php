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
        Schema::create('local_photo', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');

            $table->bigInteger('building_id')->comment('物件ID');
            $table->text('local_photo_setting_data')->comment('現地写真設定データ');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('作成日時');
            $table->integer('created_by')->nullable()->comment('作成者');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');
            $table->softDeletes();

            $table->index('building_id', 'idx_local_photo_building_id');
        });

        Schema::create('local_photo_history', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');

            $table->bigInteger('local_photo_id')->comment('local_photoのID');
            $table->bigInteger('building_id')->default(0)->comment('物件ID');
            $table->text('local_photo_data')->comment('現地写真保存データ');

            $table->timestamp('created_at')->comment('作成日時');
            $table->integer('created_by')->comment('作成者');
            $table->timestamp('updated_at')->nullable()->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');

            $table->index('building_id', 'idx_local_photo_history_building_id');
        });

        DB::unprepared('
            CREATE TRIGGER trg_local_photo_after_update
            AFTER UPDATE ON local_photo
            FOR EACH ROW
            BEGIN
                INSERT INTO local_photo_history (
                    local_photo_id,
                    building_id,
                    local_photo_data,
                    created_at,
                    created_by,
                    updated_at,
                    updated_by
                ) VALUES (
                    OLD.id,
                    OLD.building_id,
                    OLD.local_photo_setting_data,
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
        Schema::dropIfExists('local_photo');
        Schema::dropIfExists('local_photo_history');
    }
};

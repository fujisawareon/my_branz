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
        Schema::create('action_btn_setting', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->unsignedBigInteger('building_id')->comment('物件ID');
            $table->string('button_name', 255)->comment('ボタン名');
            $table->string('url', 255)->comment('外部サイトURL');
            $table->boolean('display_flg')->default(0)->comment('表示フラグ');
            $table->tinyInteger('sort')->default(0)->comment('並び順');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('作成日時');
            $table->integer('created_by')->nullable()->comment('作成者');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');
            $table->softDeletes();

            $table->index(['building_id'], 'idx_action_btn_setting_building_id');
        });

        Schema::create('action_btn_setting_history', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('action_btn_setting_id')->comment('アクションボタン設定のID');

            $table->unsignedBigInteger('building_id')->comment('物件ID');
            $table->string('button_name', 255)->comment('ボタン名');
            $table->string('url', 255)->comment('外部サイトURL');
            $table->boolean('display_flg')->default(0)->comment('表示フラグ');
            $table->tinyInteger('sort')->default(0)->comment('並び順');

            $table->timestamp('created_at')->comment('作成日時');
            $table->integer('created_by')->comment('作成者');
            $table->timestamp('updated_at')->nullable()->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');

            $table->index(['building_id'], 'idx_action_btn_setting_history_building_id');
        });

        DB::unprepared('
            CREATE TRIGGER trg_action_btn_setting_after_update
            AFTER UPDATE ON action_btn_setting
            FOR EACH ROW
            BEGIN
                INSERT INTO action_btn_setting_history (
                    action_btn_setting_id,
                    building_id,
                    button_name,
                    url,
                    display_flg,
                    sort,
                    created_at,
                    created_by,
                    updated_at,
                    updated_by
                ) VALUES (
                    OLD.id,
                    OLD.building_id,
                    OLD.button_name,
                    OLD.url,
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
        Schema::dropIfExists('action_btn_setting');
        Schema::dropIfExists('action_btn_setting_history');
    }
};

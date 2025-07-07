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
        Schema::create('online_seminar_video', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->unsignedBigInteger('building_id')->comment('物件ID');
            $table->string('title', 255)->comment('タイトル');
            $table->string('vimeo_id', 30)->comment('Vimeo動画ID');
            $table->string('token', 30)->nullable()->default(null)->comment('限定公開時のトークン');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('作成日時');
            $table->integer('created_by')->comment('作成者');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');
            $table->softDeletes()->comment('削除日時');

            $table->index('building_id', 'idx_online_seminar_video_building_id');
        });

        Schema::create('online_seminar_video_history', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->unsignedBigInteger('online_seminar_video_id')->comment('オンラインセミナー動画のID');
            $table->unsignedBigInteger('building_id')->comment('物件ID');
            $table->string('title', 255)->comment('タイトル');
            $table->string('url', 100)->comment('動画URL');

            $table->timestamp('created_at')->comment('作成日時');
            $table->integer('created_by')->comment('作成者');
            $table->timestamp('updated_at')->nullable()->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');

            $table->index('building_id', 'idx_online_seminar_video_history_building_id');
        });

        // トリガー: online_seminar_videoのUPDATE時にhistoryへINSERT
        DB::unprepared('
            CREATE TRIGGER trg_online_seminar_video_after_update
            AFTER UPDATE ON online_seminar_video
            FOR EACH ROW
            BEGIN
                INSERT INTO online_seminar_video_history (
                    online_seminar_video_id,
                    building_id,
                    title,
                    url,
                    created_at,
                    created_by,
                    updated_at,
                    updated_by
                ) VALUES (
                    OLD.id,
                    OLD.building_id,
                    OLD.title,
                    OLD.vimeo_id,
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
        Schema::dropIfExists('online_seminar_video');
        Schema::dropIfExists('online_seminar_video_history');
    }
};

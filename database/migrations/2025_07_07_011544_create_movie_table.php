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
        Schema::create('movie', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->bigInteger('building_id')->default(0)->comment('物件ID');
            $table->bigInteger('movie_category_id')->default(0)->comment('動画カテゴリID');
            $table->string('title', 255)->comment('タイトル');
            $table->string('vimeo_id', 30)->comment('Vimeo動画ID');
            $table->string('token', 30)->nullable()->default(null)->comment('限定公開時のトークン');
            $table->tinyInteger('sort')->default(0)->comment('並び順');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('作成日時');
            $table->integer('created_by')->comment('作成者');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');
            $table->softDeletes()->comment('削除日時');

            $table->index('building_id', 'idx_movie_building_id');
        });
        Schema::create('movie_history', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');

            $table->bigInteger('movie_id')->comment('動画ID');
            $table->bigInteger('building_id')->default(0)->comment('物件ID');
            $table->bigInteger('movie_category_id')->default(0)->comment('動画カテゴリID');
            $table->string('title', 255)->comment('タイトル');
            $table->string('vimeo_id', 30)->comment('Vimeo動画ID');
            $table->string('token', 30)->nullable()->default(null)->comment('限定公開時のトークン');
            $table->tinyInteger('sort')->default(0)->comment('並び順');

            $table->timestamp('created_at')->comment('作成日時');
            $table->integer('created_by')->comment('作成者');
            $table->timestamp('updated_at')->nullable()->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');

            $table->index('building_id', 'idx_movie_history_building_id');
        });

        DB::unprepared('
            CREATE TRIGGER trg_movie_after_update
            AFTER UPDATE ON movie
            FOR EACH ROW
            BEGIN
                INSERT INTO movie_history (
                    movie_id,
                    building_id,
                    movie_category_id,
                    title,
                    vimeo_id,
                    token,
                    sort,
                    created_at,
                    created_by,
                    updated_at,
                    updated_by
                ) VALUES (
                    OLD.id,
                    OLD.building_id,
                    OLD.movie_category_id,
                    OLD.title,
                    OLD.vimeo_id,
                    OLD.token,
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
        Schema::dropIfExists('movie');
        Schema::dropIfExists('movie_history');
    }
};

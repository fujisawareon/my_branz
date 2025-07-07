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
        // movie_category テーブル
        Schema::create('movie_category', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->unsignedBigInteger('building_id')->comment('物件ID');
            $table->tinyInteger('movie_type')->comment('動画種別');
            $table->string('category_name', 255)->comment('カテゴリ名');
            $table->tinyInteger('sort')->comment('並び順');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('作成日時');
            $table->integer('created_by')->comment('作成者');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');
            $table->softDeletes()->comment('削除日時');

            $table->index('building_id', 'idx_movie_category_building_id');
        });

        // movie_category_history テーブル
        Schema::create('movie_category_history', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->unsignedBigInteger('movie_category_id')->comment('movie_categoryのID');
            $table->unsignedBigInteger('building_id')->comment('物件ID');
            $table->tinyInteger('movie_type')->comment('動画種別');
            $table->string('category_name', 255)->comment('カテゴリ名');
            $table->tinyInteger('sort')->comment('並び順');

            $table->timestamp('created_at')->comment('作成日時');
            $table->integer('created_by')->comment('作成者');
            $table->timestamp('updated_at')->nullable()->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');

            $table->index('building_id', 'idx_movie_category_history_building_id');
        });

        // トリガー: movie_categoryのUPDATE時にhistoryへINSERT
        DB::unprepared('
            CREATE TRIGGER trg_movie_category_after_update
            AFTER UPDATE ON movie_category
            FOR EACH ROW
            BEGIN
                INSERT INTO movie_category_history (
                    movie_category_id,
                    building_id,
                    movie_type,
                    category_name,
                    sort,
                    created_at,
                    created_by,
                    updated_at,
                    updated_by
                ) VALUES (
                    OLD.id,
                    OLD.building_id,
                    OLD.movie_type,
                    OLD.category_name,
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
        Schema::dropIfExists('movie_category');
        Schema::dropIfExists('movie_category_history');
    }
};

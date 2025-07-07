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
        Schema::create('binder', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->unsignedBigInteger('building_id')->comment('物件ID');
            $table->unsignedBigInteger('binder_category_id')->default(0)->comment('カテゴリーID');
            $table->tinyInteger('binder_type')->default(1)->comment('1:ファイル、2:URL');
            $table->string('file_path', 255)->nullable()->comment('ファイルパス');
            $table->string('url', 255)->nullable()->comment('URL');
            $table->string('thumbnail_file_path', 255)->nullable()->comment('サムネイルファイルパス');
            $table->string('binder_name', 100)->comment('登録名');
            $table->tinyInteger('sort')->default(0)->comment('並び順');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('作成日時');
            $table->integer('created_by')->nullable()->comment('作成者');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');
            $table->softDeletes();

            $table->index('building_id', 'idx_binder_building_id');
        });

        Schema::create('binder_history', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');

            $table->unsignedBigInteger('binder_id')->comment('binderのID');
            $table->unsignedBigInteger('building_id')->comment('物件ID');
            $table->unsignedBigInteger('binder_category_id')->default(0)->comment('カテゴリーID');
            $table->tinyInteger('binder_type')->default(1)->comment('1:ファイル、2:URL');
            $table->string('file_path', 255)->nullable()->comment('ファイルパス');
            $table->string('url', 255)->nullable()->comment('URL');
            $table->string('thumbnail_file_path', 255)->nullable()->comment('サムネイルファイルパス');
            $table->string('binder_name', 100)->comment('登録名');
            $table->tinyInteger('sort')->default(0)->comment('並び順');

            $table->timestamp('created_at')->comment('作成日時');
            $table->integer('created_by')->comment('作成者');
            $table->timestamp('updated_at')->nullable()->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');

            $table->index('building_id', 'idx_binder_history_building_id');
        });

        DB::unprepared('
            DROP TRIGGER IF EXISTS trg_binder_after_update;
            CREATE TRIGGER trg_binder_after_update
            AFTER UPDATE ON binder
            FOR EACH ROW
            BEGIN
                INSERT INTO binder_history (
                    binder_id,
                    building_id,
                    binder_category_id,
                    binder_type,
                    file_path,
                    url,
                    thumbnail_file_path,
                    binder_name,
                    sort,
                    created_at,
                    created_by,
                    updated_at,
                    updated_by
                ) VALUES (
                    OLD.id,
                    OLD.building_id,
                    OLD.binder_category_id,
                    OLD.binder_type,
                    OLD.file_path,
                    OLD.url,
                    OLD.thumbnail_file_path,
                    OLD.binder_name,
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
        Schema::dropIfExists('binder');
        Schema::dropIfExists('binder_history');
    }
};

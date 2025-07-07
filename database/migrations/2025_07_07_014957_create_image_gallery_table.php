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
        Schema::create('image_gallery', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->bigInteger('building_id')->comment('物件ID');
            $table->string('title', 100)->comment('プランタイトル');
            $table->string('image_file_pass', 100)->comment('画像ギャラリー');
            $table->tinyInteger('sort')->comment('並び順');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('作成日時');
            $table->integer('created_by')->comment('作成者');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');
            $table->softDeletes()->comment('削除日時');

            $table->index('building_id', 'idx_image_gallery_building_id');
        });

        Schema::create('image_gallery_history', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->bigInteger('image_gallery_id')->comment('image_galleryのID');
            $table->bigInteger('building_id')->comment('物件ID');
            $table->string('title', 100)->comment('プランタイトル');
            $table->string('image_file_pass', 100)->comment('画像ギャラリー');
            $table->tinyInteger('sort')->comment('並び順');

            $table->timestamp('created_at')->comment('作成日時');
            $table->integer('created_by')->comment('作成者');
            $table->timestamp('updated_at')->nullable()->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');

            $table->index('building_id', 'idx_image_gallery_history_building_id');
        });

        DB::unprepared('
            CREATE TRIGGER trg_image_gallery_after_update
            AFTER UPDATE ON image_gallery
            FOR EACH ROW
            BEGIN
                INSERT INTO image_gallery_history (
                    image_gallery_id,
                    building_id,
                    title,
                    image_file_pass,
                    sort,
                    created_at,
                    created_by,
                    updated_at,
                    updated_by
                ) VALUES (
                    OLD.id,
                    OLD.building_id,
                    OLD.title,
                    OLD.image_file_pass,
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
        Schema::dropIfExists('image_gallery');
        Schema::dropIfExists('image_gallery_history');
    }
};

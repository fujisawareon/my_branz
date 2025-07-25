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
        Schema::create('limited_contents', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->unsignedBigInteger('building_id')->comment('物件ID');
            $table->string('data_key', 100)->comment('データキー');
            $table->tinyInteger('sort')->default(0)->comment('並び順');
            $table->boolean('display_flg')->default(0)->comment('表示フラグ');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('作成日時');
            $table->integer('created_by')->nullable()->comment('作成者');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');
            $table->softDeletes();

            $table->index('building_id', 'idx_limited_contents_building_id');
        });

        Schema::create('limited_contents_history', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->unsignedBigInteger('limited_contents_id')->comment('limited_contentsのID');

            $table->unsignedBigInteger('building_id')->comment('物件ID');
            $table->string('data_key', 100)->comment('データキー');
            $table->tinyInteger('sort')->default(0)->comment('並び順');
            $table->boolean('display_flg')->default(0)->comment('表示フラグ');

            $table->timestamp('created_at')->comment('作成日時');
            $table->integer('created_by')->comment('作成者');
            $table->timestamp('updated_at')->nullable()->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');

            $table->index('building_id', 'idx_limited_contents_history_building_id');
        });

        DB::unprepared('
            CREATE TRIGGER trg_limited_contents_after_update
            AFTER UPDATE ON limited_contents
            FOR EACH ROW
            BEGIN
                INSERT INTO limited_contents_history (
                    limited_contents_id,
                    building_id,
                    data_key,
                    sort,
                    display_flg,
                    created_at,
                    created_by,
                    updated_at,
                    updated_by
                ) VALUES (
                    OLD.id,
                    OLD.building_id,
                    OLD.data_key,
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
        Schema::dropIfExists('limited_contents');
        Schema::dropIfExists('limited_contents_history');
    }
};

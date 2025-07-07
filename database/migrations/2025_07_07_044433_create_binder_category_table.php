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
        Schema::create('binder_category', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->bigInteger('building_id')->comment('物件ID');
            $table->tinyInteger('type')->default(1)->comment('1:物件資料集、2:担当者専用資料集');
            $table->string('category_name', 100)->comment('カテゴリ―名');
            $table->tinyInteger('sort')->default(0)->comment('並び順');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('作成日時');
            $table->integer('created_by')->nullable()->comment('作成者');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');
            $table->softDeletes();

            $table->index('building_id', 'idx_binder_category');
        });

        Schema::create('binder_category_history', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');

            $table->bigInteger('binder_category_id')->comment('binder_categoryのID');
            $table->bigInteger('building_id')->comment('物件ID');
            $table->tinyInteger('type')->default(1)->comment('1:物件資料集、2:担当者専用資料集');
            $table->string('category_name', 100)->comment('カテゴリ―名');
            $table->tinyInteger('sort')->default(0)->comment('並び順');

            $table->timestamp('created_at')->comment('作成日時');
            $table->integer('created_by')->comment('作成者');
            $table->timestamp('updated_at')->nullable()->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');

            $table->index('building_id', 'idx_binder_category');
        });

        DB::unprepared('
            DROP TRIGGER IF EXISTS trg_binder_category_after_update;
            CREATE TRIGGER trg_binder_category_after_update
            AFTER UPDATE ON binder_category
            FOR EACH ROW
            BEGIN
                INSERT INTO binder_category_history (
                    binder_category_id,
                    building_id,
                    type,
                    category_name,
                    sort,
                    created_at,
                    created_by,
                    updated_at,
                    updated_by
                ) VALUES (
                    OLD.id,
                    OLD.building_id,
                    OLD.type,
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
        Schema::dropIfExists('binder_category');
        Schema::dropIfExists('binder_category_history');
    }
};

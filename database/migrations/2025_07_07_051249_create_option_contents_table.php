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
        Schema::create('option_contents', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->bigInteger('building_id')->default(0)->comment('物件ID');
            $table->tinyInteger('view_type')->comment('オプションコンテンツタイプ(データ定義書.xlsxに基づく)');
            $table->string('url', 255)->comment('URL');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('作成日時');
            $table->integer('created_by')->nullable()->comment('作成者');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');
            $table->softDeletes();

            $table->index('building_id', 'idx_option_contents_building_id');
        });

        Schema::create('option_contents_history', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');

            $table->bigInteger('option_contents_id')->comment('option_contentsのID');
            $table->bigInteger('building_id')->default(0)->comment('物件ID');
            $table->tinyInteger('view_type')->comment('オプションコンテンツタイプ(データ定義書.xlsxに基づく)');
            $table->string('url', 255)->comment('URL');

            $table->timestamp('created_at')->comment('作成日時');
            $table->integer('created_by')->comment('作成者');
            $table->timestamp('updated_at')->nullable()->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');

            $table->index('building_id', 'idx_option_contents_history_building_id');
        });

        DB::unprepared('
            DROP TRIGGER IF EXISTS trg_option_contents_after_update;
            CREATE TRIGGER trg_option_contents_after_update
            AFTER UPDATE ON option_contents
            FOR EACH ROW
            BEGIN
                INSERT INTO option_contents_history (
                    option_contents_id,
                    building_id,
                    view_type,
                    url,
                    created_at,
                    created_by,
                    updated_at,
                    updated_by
                ) VALUES (
                    OLD.id,
                    OLD.building_id,
                    OLD.view_type,
                    OLD.url,
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
        Schema::dropIfExists('option_contents');
        Schema::dropIfExists('option_contents_history');
    }
};

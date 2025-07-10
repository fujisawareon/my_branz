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
        Schema::create('sales_price_data', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->unsignedBigInteger('building_id')->comment('物件ID');
            $table->string('file_path', 255)->comment('ファイルパス');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('作成日時');
            $table->integer('created_by')->nullable()->comment('作成者');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');
            $table->softDeletes();

            $table->index('building_id', 'idx_sales_price_data_building_id');
        });

        Schema::create('sales_price_data_history', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');

            $table->unsignedBigInteger('sales_price_data_id')->comment('sales_price_dataのID');
            $table->unsignedBigInteger('building_id')->comment('物件ID');
            $table->string('file_path', 255)->comment('ファイルパス');

            $table->timestamp('created_at')->comment('作成日時');
            $table->integer('created_by')->comment('作成者');
            $table->timestamp('updated_at')->nullable()->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');

            $table->index('building_id', 'idx_sales_price_data_history_building_id');
        });

        DB::unprepared('
            DROP TRIGGER IF EXISTS trg_sales_price_data_after_update;
            CREATE TRIGGER trg_sales_price_data_after_update
            AFTER UPDATE ON sales_price_data
            FOR EACH ROW
            BEGIN
                INSERT INTO sales_price_data_history (
                    sales_price_data_id,
                    building_id,
                    file_path,
                    created_at,
                    created_by,
                    updated_at,
                    updated_by
                ) VALUES (
                    OLD.id,
                    OLD.building_id,
                    OLD.file_path,
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
        Schema::dropIfExists('sales_price_data');
        Schema::dropIfExists('sales_price_data_history');
    }
};

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
        Schema::create('share_item_customer', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('building_id')->default(0)->comment('物件ID');
            $table->tinyInteger('status_id')->default(0)->comment('ステータスID');
            $table->bigInteger('customer_id')->default(0)->comment('顧客ID');
            $table->tinyInteger('data_type')->default(0)->comment('データタイプ');
            $table->bigInteger('external_id')->default(0)->comment('結合する外部テーブルのID');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('作成日時');
            $table->integer('created_by')->comment('作成者');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');
            $table->softDeletes()->comment('削除日時');

            $table->index('building_id', 'idx_share_item_customer_building_id');
            $table->index('status_id', 'idx_share_item_customer_status_id');
            $table->index('customer_id', 'idx_share_item_customer_customer_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('share_item_customer');
    }
};

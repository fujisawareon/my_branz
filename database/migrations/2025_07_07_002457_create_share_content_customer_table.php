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
        Schema::create('share_content_customer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('building_id')->default(0)->comment('物件ID');
            $table->tinyInteger('status_id')->default(0)->comment('ステータスID');
            $table->unsignedBigInteger('customer_id')->default(0)->comment('顧客ID');
            $table->string('content_key', 100)->comment('コンテンツキー');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('作成日時');
            $table->integer('created_by')->comment('作成者');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');
            $table->softDeletes()->comment('削除日時');

            $table->index('building_id', 'idx_share_content_customer_building_id');
            $table->index('status_id', 'idx_share_content_customer_status_id');
            $table->index('customer_id', 'idx_share_content_customer_customer_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('share_content_customer');
    }
};

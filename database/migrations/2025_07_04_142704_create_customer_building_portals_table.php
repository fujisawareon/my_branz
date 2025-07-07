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
        Schema::create('customer_building_portals', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');

            $table->unsignedBigInteger('customer_id')->comment('顧客ID');
            $table->unsignedBigInteger('building_id')->comment('物件ID');
            $table->string('portal_id', 10)->comment('ポータルID');
            $table->integer('hankyo_id')->comment('反響ID');
            $table->timestamp('hankyo_date')->comment('反響日時');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('作成日時');
            $table->integer('created_by')->comment('作成者');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');
            $table->softDeletes();

            // インデックス
            $table->index(
                ['customer_id', 'building_id'],
                'idx_customer_id_customer_building_id'
            );
            $table->index(['hankyo_id'], 'idx_customer_building_portals_hankyo_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_building_portals');
    }
};

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
        Schema::create('floor_type_log', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->integer('building_id')->comment('物件ID');
            $table->integer('customer_id')->comment('顧客ID');
            $table->json('layout')->nullable()->comment('レイアウト（データ定義、間取り、値を配列で格納）');
            $table->json('area_m2')->nullable()->comment('専有面積（専有面積の"xx~xxm2"の値を配列で格納）');
            $table->json('direction')->nullable()->comment('方位（データ定義、間取り方位、値を配列で格納）');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('作成日時');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('更新日時');
            $table->softDeletes()->comment('削除日時');

            $table->index('building_id', 'idx_floor_type_log_building_id');
            $table->index('customer_id', 'idx_floor_type_log_customer_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('floor_type_log');
    }
};

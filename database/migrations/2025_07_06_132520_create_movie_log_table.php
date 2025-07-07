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
        Schema::create('movie_log', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->integer('building_id')->comment('物件ID');
            $table->integer('customer_id')->comment('顧客ID');
            $table->string('view_id', 35)->comment('画面表示時の識別ID');
            $table->bigInteger('movie_id')->nullable()->comment('動画ID');
            $table->tinyInteger('movie_type')->comment('動画タイプ 1:オンラインセミナー動画,2:物件紹介動画,3:マンション購入の基礎知識編,4:BRANZの管理と購入後のサポート編)');
            $table->string('movie_title', 100)->comment('動画タイトル');
            $table->string('movie_url', 255)->comment('元URLリンク');
            $table->integer('viewed_rate')->comment('閲覧率');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('作成日時');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment('更新日時');
            $table->softDeletes();

            $table->index('building_id', 'idx_movie_log_building_id');
            $table->index('customer_id', 'idx_movie_log_customer_id');
            $table->index('view_id', 'idx_movie_log_view_id');
            $table->index('movie_id', 'idx_movie_log_movie_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_log');
    }
};

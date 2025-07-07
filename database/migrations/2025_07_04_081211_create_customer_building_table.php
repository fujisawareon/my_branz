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
        Schema::create('customer_building', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');

            $table->unsignedBigInteger('customer_id')->comment('顧客ID');
            $table->unsignedBigInteger('building_id')->comment('物件ID');

            $table->unsignedBigInteger('person_in_charge')->nullable()->comment('担当者');
            $table->string('zip_code_3', 3)->nullable()->comment('郵便番号3桁');
            $table->string('zip_code_4', 4)->nullable()->comment('郵便番号4桁');
            $table->string('prefecture_code', 3)->nullable()->comment('都道府県コード');
            $table->string('prefecture', 100)->nullable()->comment('都道府県');
            $table->string('city', 100)->nullable()->comment('市区町村');
            $table->string('town', 100)->nullable()->comment('町名');
            $table->string('chome', 100)->nullable()->comment('丁目');
            $table->string('banchi', 100)->nullable()->comment('番地');
            $table->string('apartment_detail', 255)->nullable()->comment('建物名・号室');
            $table->string('country', 100)->nullable()->comment('国名');
            $table->string('address_extra', 255)->nullable()->comment('その他住所');

            $table->string('sumai_type', 10)->default('')->comment('住宅区分');
            $table->string('sumai', 10)->default('')->comment('現在の住まい');
            $table->tinyInteger('renew_flg')->default(0)->comment('買い替えの有無');

            $table->string('desired_plan', 100)->nullable()->comment('希望間取り');
            $table->integer('desired_area_min')->nullable()->comment('希望面積（下限）');
            $table->integer('desired_area_max')->nullable()->comment('希望面積（上限）');
            $table->integer('desired_price')->nullable()->comment('希望価格');
            $table->integer('fund')->nullable()->comment('自己資金');
            $table->integer('income')->nullable()->comment('年収');
            $table->integer('household_income')->nullable()->comment('世帯年収');
            $table->integer('expected_residents')->nullable()->comment('想定入居人数');

            $table->string('occupation', 100)->nullable()->comment('職業');
            $table->string('office', 100)->nullable()->comment('勤務先');

            $table->tinyInteger('customer_status')->default(0)->comment('ステータス');
            $table->boolean('is_inner')->default(0)->comment('インナー');
            $table->boolean('is_online_seminar_watching')->default(0)->comment('オンラインセミナー動画視聴');
            $table->boolean('is_online_sales_meeting_reserve')->default(0)->comment('オンライン商談予約');
            $table->boolean('is_online_sales_meeting')->default(0)->comment('オンライン商談');
            $table->boolean('is_free_observe_reserve')->default(0)->comment('フリー見学予約');
            $table->boolean('is_free_observe')->default(0)->comment('フリー見学');
            $table->boolean('is_first_visit_reserve')->default(0)->comment('初来場予約');
            $table->boolean('is_first_visit')->default(0)->comment('初来場');
            $table->boolean('is_needs_recept')->default(0)->comment('要望受付');
            $table->boolean('is_regist_recept')->default(0)->comment('要望登録');
            $table->boolean('is_apply')->default(0)->comment('申込');
            $table->boolean('is_contract')->default(0)->comment('契約');
            $table->boolean('is_handover')->default(0)->comment('引渡し');
            $table->boolean('is_stop_considering')->default(0)->comment('検討中止');

            $table->integer('base_score')->nullable()->comment('基本スコア');
            $table->integer('behavior_score')->nullable()->comment('行動スコア');
            $table->string('score', 100)->nullable()->comment('スコア');

            $table->tinyInteger('relation_status')->default(0)->comment('状態');

            $table->timestamp('entry_at')->nullable()->comment('エントリー日時');
            $table->string('hp_inflow_type')->nullable()->comment('HP流入種別');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('作成日時');
            $table->integer('created_by')->comment('作成者');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');
            $table->softDeletes();

            // インデックス
            $table->index(['building_id'], 'idx_customer_building_building_id');
            $table->index(['customer_id'], 'idx_customer_building_customer_id');
        });

        // TODO: 履歴テーブル作成
        Schema::create('customer_building_history', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_building');
        Schema::dropIfExists('customer_building_history');
    }
};

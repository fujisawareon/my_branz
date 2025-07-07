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
        Schema::create('loan_simulation_log', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->integer('building_id')->comment('物件ID');
            $table->integer('customer_id')->comment('顧客ID');
            $table->integer('condominium_price')->comment('分譲価格（税込）');
            $table->integer('deposit')->comment('頭金');
            $table->decimal('interest', 6, 3)->default(0.000)->comment('金利');
            $table->integer('loan_period')->comment('借入期間');
            $table->integer('bonus_payment')->comment('ボーナス払い（年2回）');
            $table->integer('monthly_fee')->comment('月々の支払金額（目安）');
            $table->integer('loan')->comment('借金額（分譲価格-頭金）');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('作成日時');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment('更新日時');
            $table->softDeletes();


            $table->index('building_id', 'idx_loan_simulation_log_building_id');
            $table->index('customer_id', 'idx_loan_simulation_log_customer_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_simulation_log');
    }
};

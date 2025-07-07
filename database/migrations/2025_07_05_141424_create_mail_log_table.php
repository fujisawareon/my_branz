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
        Schema::create('mail_log', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->integer('building_id')->default(0)->comment('物件ID');
            $table->integer('customer_id')->default(0)->comment('顧客ID');
            $table->string('mail_to', 255)->comment('送信先メールアドレス');
            $table->string('mail_subject', 255)->comment('件名');
            $table->text('mail_header')->comment('ヘッダー');
            $table->text('mail_body')->comment('本文');
            $table->timestamp('opened_date')->nullable()->comment('メール開封日時');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('作成日時');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment('更新日時');
            $table->softDeletes();

            $table->index('building_id', 'idx_mail_log_building_id');
            $table->index('customer_id', 'idx_mail_log_customer_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mail_log');
    }
};

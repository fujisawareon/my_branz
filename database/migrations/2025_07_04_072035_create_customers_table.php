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
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('顧客ID');
            $table->string('web_customer_id', 20)->nullable()->comment('WEB顧客ID');
            $table->string('sei', 100)->comment('姓');
            $table->string('mei', 50)->comment('名');
            $table->string('sei_kana', 100)->comment('姓（カナ）');
            $table->string('mei_kana', 50)->comment('名（カナ）');
            $table->integer('gender')->default(0)->comment('性別');
            $table->string('birthday', 10)->nullable()->comment('生年月日');
            $table->string('tel', 20)->nullable()->comment('電話番号');
            $table->string('fax', 20)->nullable()->comment('FAX');

            $table->string('email', 255)->unique()->comment('メールアドレス');
            $table->timestamp('email_verified_at')->nullable()->comment('メールアドレス認証日時');

            $table->string('password', 255)->comment('パスワード');
            $table->tinyInteger('status')->default(0)->comment('状態');
            $table->rememberToken();
            $table->tinyInteger('first_registration_flag')->default(0)->comment('初回登録済フラグ');
            $table->timestamp('agreement_at')->nullable()->comment('利用規約同意日時');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('作成日時');
            $table->integer('created_by')->nullable()->comment('作成者');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment('更新日時');
            $table->integer('updated_by_manager')->nullable()->comment('更新者(管理者)');
            $table->integer('updated_by_customer')->nullable()->comment('更新者(顧客)');
            $table->softDeletes();

            // インデックス
            $table->index(['email_verified_at'], 'idx_customers_email_verified_at');
            $table->index(['web_customer_id'], 'idx_customers_web_customer_id');
        });

        Schema::create('customers_history', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');

            $table->unsignedBigInteger('customer_id')->comment('顧客ID');
            $table->string('web_customer_id', 20)->nullable()->comment('WEB顧客ID');
            $table->string('sei', 100)->comment('姓');
            $table->string('mei', 50)->comment('名');
            $table->string('sei_kana', 100)->comment('姓（カナ）');
            $table->string('mei_kana', 50)->comment('名（カナ）');
            $table->integer('gender')->default(0)->comment('性別');
            $table->string('birthday', 10)->nullable()->comment('生年月日');
            $table->string('tel', 20)->nullable()->comment('電話番号');
            $table->string('fax', 20)->nullable()->comment('FAX');

            $table->string('email', 255)->unique()->comment('メールアドレス');
            $table->timestamp('email_verified_at')->nullable()->comment('メールアドレス認証日時');

            $table->string('password', 255)->comment('パスワード');
            $table->tinyInteger('status')->default(0)->comment('状態');
            $table->rememberToken();
            $table->tinyInteger('first_registration_flag')->default(0)->comment('初回登録済フラグ');
            $table->timestamp('agreement_at')->nullable()->comment('利用規約同意日時');

            $table->timestamp('created_at')->comment('作成日時');
            $table->integer('created_by')->comment('作成者');
            $table->timestamp('updated_at')->nullable()->comment('更新日時');
            $table->integer('updated_by_manager')->nullable()->comment('更新者(管理者)');
            $table->integer('updated_by_customer')->nullable()->comment('更新者(顧客)');

            // インデックス
            $table->index(['email'], 'idx_customers_history_email');
            $table->index(['customer_id'], 'idx_customers_history_customer_id');
            $table->index(['web_customer_id'], 'idx_customers_history_web_customer_id');
        });


        DB::unprepared('
            CREATE TRIGGER trg_customers_after_update
            AFTER UPDATE ON customers
            FOR EACH ROW
            BEGIN
                INSERT INTO customers_history (
                    customer_id,
                    web_customer_id,
                    sei,
                    mei,
                    sei_kana,
                    mei_kana,
                    gender,
                    birthday,
                    tel,
                    fax,
                    email,
                    email_verified_at,
                    password,
                    status,
                    remember_token,
                    agreement_at,
                    created_at,
                    created_by,
                    updated_at,
                    updated_by_manager,
                    updated_by_customer
                ) VALUES (
                    old.id,
                    old.web_customer_id,
                    old.sei,
                    old.mei,
                    old.sei_kana,
                    old.mei_kana,
                    old.gender,
                    old.birthday,
                    old.tel,
                    old.fax,
                    old.email,
                    old.email_verified_at,
                    old.password,
                    old.status,
                    old.remember_token,
                    old.agreement_at,
                    old.created_at,
                    old.created_by,
                    old.updated_at,
                    old.updated_by_manager,
                    old.updated_by_customer
                );
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
        Schema::dropIfExists('customers_history');
    }
};

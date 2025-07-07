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
        Schema::create('managers', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('業務ユーザーID');

            $table->string('user_name')->comment('名前');
            $table->string('password')->comment('パスワード');
            $table->string('email')->unique()->comment('メールアドレス');
            $table->tinyInteger('role')->default(0)->comment('権限');
            $table->tinyInteger('status')->default(0)->comment('状態');
            $table->timestamp('last_login_at')->nullable()->comment('最終ログイン(認証)日時');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('作成日時');
            $table->integer('created_by')->nullable()->comment('作成者');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');
            $table->softDeletes();

            $table->index(['user_name'], 'idx_managers_user_name');
        });

        Schema::create('managers_history', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->unsignedBigInteger('managers_id')->comment('managersのID');

            $table->string('user_name')->comment('名前');
            $table->string('password')->comment('パスワード');
            $table->string('email')->unique()->comment('メールアドレス');
            $table->tinyInteger('role')->default(0)->comment('権限');
            $table->tinyInteger('status')->default(0)->comment('状態');
            $table->timestamp('last_login_at')->nullable()->comment('最終ログイン(認証)日時');

            $table->timestamp('created_at')->comment('作成日時');
            $table->integer('created_by')->comment('作成者');
            $table->timestamp('updated_at')->nullable()->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');

            $table->index(['email'], 'idx_managers_history_email');
        });

        DB::unprepared('
            CREATE TRIGGER trg_managers_after_update
            AFTER UPDATE ON managers
            FOR EACH ROW
            BEGIN
                INSERT INTO managers_history (
                    managers_id,
                    user_name,
                    password,
                    email,
                    role,
                    status,
                    last_login_at,
                    created_at,
                    created_by,
                    updated_at,
                    updated_by
                ) VALUES (
                    OLD.id,
                    OLD.user_name,
                    OLD.password,
                    OLD.email,
                    OLD.role,
                    OLD.status,
                    OLD.last_login_at,
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
        Schema::dropIfExists('managers');
        Schema::dropIfExists('managers_history');
    }
};

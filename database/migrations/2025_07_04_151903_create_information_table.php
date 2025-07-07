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
        Schema::create('information', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->unsignedBigInteger('building_id')->comment('物件ID');
            $table->tinyInteger('status')->comment('状態');
            $table->date('from_at')->nullable()->comment('公開開始日');
            $table->date('to_at')->nullable()->comment('公開終了日');
            $table->string('content', 2000)->comment('内容');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('作成日時');
            $table->integer('created_by')->comment('作成者');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');
            $table->softDeletes()->comment('削除日時');

            $table->index('building_id', 'idx_information_building_id');
        });

        Schema::create('information_history', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->unsignedBigInteger('information_id')->comment('インフォメーションのID');
            $table->unsignedBigInteger('building_id')->comment('物件ID');
            $table->tinyInteger('status')->comment('状態');
            $table->date('from_at')->nullable()->comment('公開開始日');
            $table->date('to_at')->nullable()->comment('公開終了日');
            $table->string('content', 2000)->comment('内容');

            $table->timestamp('created_at')->comment('作成日時');
            $table->integer('created_by')->comment('作成者');
            $table->timestamp('updated_at')->nullable()->comment('更新日時');
            $table->integer('updated_by')->nullable()->comment('更新者');

            $table->index('building_id', 'idx_information_history_building_id');
        });

        DB::unprepared('
            CREATE TRIGGER trg_information_after_update
            AFTER UPDATE ON information
            FOR EACH ROW
            BEGIN
                INSERT INTO information_history (
                    information_id,
                    building_id,
                    status,
                    from_at,
                    to_at,
                    content,
                    created_at,
                    created_by,
                    updated_at,
                    updated_by
                ) VALUES (
                    OLD.id,
                    OLD.building_id,
                    OLD.status,
                    OLD.from_at,
                    OLD.to_at,
                    OLD.content,
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
        Schema::dropIfExists('information_history');
        Schema::dropIfExists('information');
    }
};

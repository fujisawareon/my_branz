<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id ID
 * @property int $building_id 物件ID
 * @property int $customer_id 顧客ID
 * @property string $mail_to 送信先メールアドレス
 * @property string $mail_subject 件名
 * @property string $mail_header ヘッダー
 * @property string $mail_body 本文
 * @property string|null $opened_date メール開封日時
 * @property string $created_at 作成日時
 * @property string $updated_at 更新日時
 * @property string|null $deleted_at 削除日時
 * @method static MailLog create(array $attributes = [])
 */
class MailLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mail_log';

    protected $fillable = [
        'building_id',
        'customer_id',
        'mail_to',
        'mail_subject',
        'mail_header',
        'mail_body',
        'opened_date',
    ];
}

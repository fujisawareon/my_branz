<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id ID
 * @property int $customer_id 顧客ID
 * @property string|null $uid 識別ID
 * @property string|null $last_login_at 最終ログイン日時
 * @property string $created_at 作成日時
 * @property string $updated_at 更新日時
 * @property string|null $deleted_at 削除日時
 * @method static CustomerSessions create(array $attributes = [])
 */
class CustomerSessions extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'customer_sessions';

    protected $fillable = [
        'customer_id',
        'uid',
        'last_login_at',
    ];
}

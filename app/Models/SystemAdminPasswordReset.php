<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id ID
 * @property string $email メールアドレス
 * @property string $token パスワードリセットトークン
 * @property string $created_at 作成日時
 * @property string $updated_at 削除日時
 * @method static SystemAdminPasswordReset create(array $attributes = [])
 */
class SystemAdminPasswordReset extends Model
{
    use HasFactory;

    protected $table = 'system_admin_password_reset';

    protected $fillable = [
        'email',
        'token',
    ];
}

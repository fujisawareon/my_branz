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
 * @method static PasswordReset create(array $attributes = [])
 */
class PasswordReset extends Model
{
    use HasFactory;

    protected $table = 'password_reset';

    protected $fillable = [
        'email',
        'token',
    ];
}

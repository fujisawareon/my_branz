<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id 業務ユーザーID
 * @property string $user_name 名前
 * @property string $password パスワード
 * @property string $email メールアドレス
 * @property int $role 権限
 * @property int $status 状態
 * @property string|null $last_login_at 最終ログイン日時
 * @property string $created_at 作成日時
 * @property int|null $created_by 作成者
 * @property string $updated_at 更新日時
 * @property int|null $updated_by 更新者
 * @property string|null $deleted_at 削除日時
 * @method static Managers create(array $attributes = [])
 */
class Managers extends Authenticatable
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $table = 'managers';

    protected $fillable = [
        'user_name',
        'password',
        'email',
        'role',
        'status',
        'last_login_at',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}

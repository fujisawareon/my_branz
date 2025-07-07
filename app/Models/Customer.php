<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id 顧客ID
 * @property string|null $web_customer_id WEB顧客ID
 * @property string $sei 姓
 * @property string $mei 名
 * @property string $sei_kana 姓（カナ）
 * @property string $mei_kana 名（カナ）
 * @property int $gender 性別
 * @property string|null $birthday 生年月日
 * @property string|null $tel 電話番号
 * @property string|null $fax FAX
 * @property string $email メールアドレス
 * @property string|null $email_verified_at メールアドレス認証日時
 * @property string $password パスワード
 * @property int $status 状態
 * @property string|null $remember_token リメンバートークン
 * @property int $first_registration_flag 初回登録済フラグ
 * @property string|null $agreement_at 利用規約同意日時
 * @property string $created_at 作成日時
 * @property int|null $created_by 作成者
 * @property string $updated_at 更新日時
 * @property int|null $updated_by_manager 更新者(管理者)
 * @property int|null $updated_by_customer 更新者(顧客)
 * @property string|null $deleted_at 論理削除日時
 * @method static Customer create(array $attributes = [])
 */
class Customer extends Authenticatable
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $table = 'customers';

    protected $fillable = [
        'web_customer_id',
        'sei',
        'mei',
        'sei_kana',
        'mei_kana',
        'gender',
        'birthday',
        'tel',
        'fax',
        'email',
        'email_verified_at',
        'password',
        'status',
        'remember_token',
        'first_registration_flag',
        'agreement_at',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by_manager',
        'updated_by_customer',
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

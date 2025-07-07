<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id ID
 * @property int $building_id 物件ID
 * @property int $status_id ステータスID
 * @property int $customer_id 顧客ID
 * @property string $content_key コンテンツキー
 * @property string $created_at 作成日時
 * @property int $created_by 作成者
 * @property string $updated_at 更新日時
 * @property int|null $updated_by 更新者
 * @property string|null $deleted_at 削除日時
 * @method static ShareContentCustomer create(array $attributes = [])
 */
class ShareContentCustomer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'share_content_customer';

    protected $fillable = [
        'building_id',
        'status_id',
        'customer_id',
        'content_key',
        'created_by',
        'updated_by',
    ];
}

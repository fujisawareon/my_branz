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
 * @property int $data_type データタイプ
 * @property int $external_id 結合する外部テーブルのID
 * @property string $created_at 作成日時
 * @property int $created_by 作成者
 * @property string $updated_at 更新日時
 * @property int|null $updated_by 更新者
 * @property string|null $deleted_at 削除日時
 * @method static ShareItemStatus create(array $attributes = [])
 */
class ShareItemStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'share_item_status';

    protected $fillable = [
        'building_id',
        'status_id',
        'data_type',
        'external_id',
        'created_by',
        'updated_by',
    ];
}

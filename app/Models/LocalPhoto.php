<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id ID
 * @property int $building_id 物件ID
 * @property string $local_photo_setting_data 現地写真設定データ
 * @property string $created_at 作成日時
 * @property int|null $created_by 作成者
 * @property string $updated_at 更新日時
 * @property int|null $updated_by 更新者
 * @property string|null $deleted_at 削除日時
 * @method static LocalPhoto create(array $attributes = [])
 */
class LocalPhoto extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'local_photo';

    protected $fillable = [
        'building_id',
        'local_photo_setting_data',
        'created_by',
        'updated_by',
    ];
}

<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id ID
 * @property int $building_id 物件ID
 * @property string $type_name 間取タイプ名
 * @property int $sort 並び順
 * @property bool $display_flg 表示フラグ
 * @property float $area_m2 専有面積の㎡
 * @property float $area_tsubo 専有面積の坪
 * @property int $direction 方位
 * @property array|null $additional_data 専有面積以外の名前・㎡・坪
 * @property string $created_at 作成日時
 * @property int $created_by 作成者
 * @property string $updated_at 更新日時
 * @property int|null $updated_by 更新者
 * @property string|null $deleted_at 削除日時
 * @method static FloorType create(array $attributes = [])
 */
class FloorType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'floor_type';

    protected $casts = [
        'additional_data' => 'array',
    ];

    protected $fillable = [
        'building_id',
        'type_name',
        'sort',
        'display_flg',
        'area_m2',
        'area_tsubo',
        'direction',
        'additional_data',
        'created_by',
        'updated_by',
    ];
}

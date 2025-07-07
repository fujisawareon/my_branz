<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id ID
 * @property int $building_id 物件ID
 * @property int $area_map_category_id 周辺マップカテゴリID
 * @property string $name 建物名
 * @property string $address 住所
 * @property float $latitude 緯度
 * @property float $longitude 経度
 * @property int $sort 並び順
 * @property string $created_at 作成日時
 * @property int|null $created_by 作成者
 * @property string $updated_at 更新日時
 * @property int|null $updated_by 更新者
 * @property string|null $deleted_at 削除日時
 * @method static AreaMapBuilding create(array $attributes = [])
 */
class AreaMapBuilding extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'area_map_building';

    protected $fillable = [
        'building_id',
        'area_map_category_id',
        'name',
        'address',
        'latitude',
        'longitude',
        'sort',
        'created_by',
        'updated_by',
    ];
}

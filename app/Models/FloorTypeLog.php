<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id ID
 * @property int $building_id 物件ID
 * @property int $customer_id 顧客ID
 * @property array|null $layout レイアウト
 * @property array|null $area_m2 専有面積
 * @property array|null $direction 方位
 * @property string $created_at 作成日時
 * @property string $updated_at 更新日時
 * @property string|null $deleted_at 削除日時
 * @method static FloorTypeLog create(array $attributes = [])
 */
class FloorTypeLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'floor_type_log';

    protected $casts = [
        'layout' => 'array',
        'area_m2' => 'array',
        'direction' => 'array',
    ];

    protected $fillable = [
        'building_id',
        'customer_id',
        'layout',
        'area_m2',
        'direction',
    ];
}

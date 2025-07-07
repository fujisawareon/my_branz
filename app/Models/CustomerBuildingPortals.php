<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id ID
 * @property int $customer_id 顧客ID
 * @property int $building_id 物件ID
 * @property string $portal_id ポータルID
 * @property int $hankyo_id 反響ID
 * @property string $hankyo_date 反響日時
 * @property string $created_at 作成日時
 * @property int $created_by 作成者
 * @property string $updated_at 更新日時
 * @property int|null $updated_by 更新者
 * @property string|null $deleted_at 削除日時
 * @method static CustomerBuildingPortals create(array $attributes = [])
 */
class CustomerBuildingPortals extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'customer_building_portals';

    protected $fillable = [
        'customer_id',
        'building_id',
        'portal_id',
        'hankyo_id',
        'hankyo_date',
        'created_by',
        'updated_by',
    ];
}

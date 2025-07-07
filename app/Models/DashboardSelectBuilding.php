<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id ID
 * @property int $building_id 物件ID
 * @property int $manager_id 業務ユーザーID
 * @property string|null $created_at 作成日時
 * @property string $updated_at 更新日時
 * @property string|null $deleted_at 削除日時
 * @method static DashboardSelectBuilding create(array $attributes = [])
 */
class DashboardSelectBuilding extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'dashboard_select_building';

    protected $fillable = [
        'building_id',
        'manager_id',
    ];
}

<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id ID
 * @property int $building_id 物件ID
 * @property string $category_key カテゴリーキー
 * @property int $use_flg 表示フラグ
 * @property int $sort 並び順
 * @property string $created_at 作成日時
 * @property int|null $created_by 作成者
 * @property string $updated_at 更新日時
 * @property int|null $updated_by 更新者
 * @property string|null $deleted_at 削除日時
 * @method static AreaMapCategory create(array $attributes = [])
 */
class AreaMapCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'area_map_category';

    protected $fillable = [
        'building_id',
        'category_key',
        'use_flg',
        'sort',
        'created_by',
        'updated_by',
    ];
}

<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id ID
 * @property int $building_id 物件ID
 * @property int $type 1:物件資料集,2:担当者専用資料集
 * @property string $category_name カテゴリー名
 * @property int $sort 並び順
 * @property string $created_at 作成日時
 * @property int|null $created_by 作成者
 * @property string $updated_at 更新日時
 * @property int|null $updated_by 更新者
 * @property string|null $deleted_at 削除日時
 * @method static BinderCategory create(array $attributes = [])
 */
class BinderCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'binder_category';

    protected $fillable = [
        'building_id',
        'type',
        'category_name',
        'sort',
        'created_by',
        'updated_by',
    ];
}

<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id ID
 * @property int $building_id 物件ID
 * @property int $floor_type_id 間取タイプID
 * @property string $title プランタイトル
 * @property int $layout 間取り
 * @property string $display_name 間取りプラン表示名
 * @property string $image_pass 画像
 * @property string|null $note 注釈
 * @property bool $display_flg 表示フラグ
 * @property int $sort 並び順
 * @property string $created_at 作成日時
 * @property int $created_by 作成者
 * @property string $updated_at 更新日時
 * @property int|null $updated_by 更新者
 * @property string|null $deleted_at 削除日時
 * @method static FloorPlan create(array $attributes = [])
 */
class FloorPlan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'floor_plan';

    protected $fillable = [
        'building_id',
        'floor_type_id',
        'title',
        'layout',
        'display_name',
        'image_pass',
        'note',
        'display_flg',
        'sort',
        'created_by',
        'updated_by',
    ];
}

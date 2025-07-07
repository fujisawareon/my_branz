<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id ID
 * @property int $building_id 物件ID
 * @property string $button_name ボタン名
 * @property string $url 外部サイトURL
 * @property bool $display_flg 表示フラグ
 * @property int $sort 並び順
 * @property string $created_at 作成日時
 * @property int|null $created_by 作成者
 * @property string $updated_at 更新日時
 * @property int|null $updated_by 更新者
 * @property string|null $deleted_at 削除日時
 * @method static ActionBtnSetting create(array $attributes = [])
 */
class ActionBtnSetting extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'action_btn_setting';

    protected $fillable = [
        'building_id',
        'button_name',
        'url',
        'display_flg',
        'sort',
        'created_by',
        'updated_by',
    ];
}

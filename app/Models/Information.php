<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id ID
 * @property int $building_id 物件ID
 * @property int $status 状態
 * @property string|null $from_at 公開開始日
 * @property string|null $to_at 公開終了日
 * @property string $content 内容
 * @property string $created_at 作成日時
 * @property int $created_by 作成者
 * @property string $updated_at 更新日時
 * @property int|null $updated_by 更新者
 * @property string|null $deleted_at 削除日時
 * @method static Information create(array $attributes = [])
 */
class Information extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'information';

    protected $fillable = [
        'building_id',
        'status',
        'from_at',
        'to_at',
        'content',
        'created_by',
        'updated_by',
    ];
}

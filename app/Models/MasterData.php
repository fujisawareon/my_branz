<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id ID
 * @property int $data_type データタイプ
 * @property string $data_key データキー
 * @property string $name データ名
 * @property int $sort 並び順
 * @property string $created_at 作成日時
 * @property int $created_by 作成者
 * @property string $updated_at 更新日時
 * @property int|null $updated_by 更新者
 * @property string|null $deleted_at 削除日時
 * @method static MasterData create(array $attributes = [])
 */
class MasterData extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'master_data';

    protected $fillable = [
        'data_type',
        'data_key',
        'name',
        'sort',
        'created_by',
        'updated_by',
    ];
}

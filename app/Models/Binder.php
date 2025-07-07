<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id ID
 * @property int $building_id 物件ID
 * @property int $binder_category_id カテゴリーID
 * @property int $binder_type 1:ファイル,2:URL
 * @property string|null $file_path ファイルパス
 * @property string|null $url URL
 * @property string|null $thumbnail_file_path サムネイルファイルパス
 * @property string $binder_name 登録名
 * @property int $sort 並び順
 * @property string $created_at 作成日時
 * @property int|null $created_by 作成者
 * @property string $updated_at 更新日時
 * @property int|null $updated_by 更新者
 * @property string|null $deleted_at 削除日時
 * @method static Binder create(array $attributes = [])
 */
class Binder extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'binder';

    protected $fillable = [
        'building_id',
        'binder_category_id',
        'binder_type',
        'file_path',
        'url',
        'thumbnail_file_path',
        'binder_name',
        'sort',
        'created_by',
        'updated_by',
    ];
}

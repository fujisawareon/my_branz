<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id ID
 * @property int $building_id 物件ID
 * @property int $movie_type 動画種別
 * @property string $category_name カテゴリ名
 * @property int $sort 並び順
 * @property string $created_at 作成日時
 * @property int $created_by 作成者
 * @property string $updated_at 更新日時
 * @property int|null $updated_by 更新者
 * @property string|null $deleted_at 削除日時
 * @method static MovieCategory create(array $attributes = [])
 */
class MovieCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'movie_category';

    protected $fillable = [
        'building_id',
        'movie_type',
        'category_name',
        'sort',
        'created_by',
        'updated_by',
    ];
}

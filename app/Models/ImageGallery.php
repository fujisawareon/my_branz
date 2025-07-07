<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id ID
 * @property int $building_id 物件ID
 * @property string $title プランタイトル
 * @property string $image_file_pass 画像ギャラリー
 * @property int $sort 並び順
 * @property string $created_at 作成日時
 * @property int $created_by 作成者
 * @property string $updated_at 更新日時
 * @property int|null $updated_by 更新者
 * @property string|null $deleted_at 削除日時
 * @method static ImageGallery create(array $attributes = [])
 */
class ImageGallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'image_gallery';

    protected $fillable = [
        'building_id',
        'title',
        'image_file_pass',
        'sort',
        'created_by',
        'updated_by',
    ];
}

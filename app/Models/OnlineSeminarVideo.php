<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id ID
 * @property int $building_id 物件ID
 * @property string $title タイトル
 * @property string $vimeo_id Vimeo動画ID
 * @property string|null $token 限定公開時のトークン
 * @property string $created_at 作成日時
 * @property int $created_by 作成者
 * @property string $updated_at 更新日時
 * @property int|null $updated_by 更新者
 * @property string|null $deleted_at 削除日時
 * @method static OnlineSeminarVideo create(array $attributes = [])
 */
class OnlineSeminarVideo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'online_seminar_video';

    protected $fillable = [
        'building_id',
        'title',
        'vimeo_id',
        'token',
        'created_by',
        'updated_by',
    ];
}

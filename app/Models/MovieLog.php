<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id ID
 * @property int $building_id 物件ID
 * @property int $customer_id 顧客ID
 * @property string $view_id 画面表示時の識別ID
 * @property int|null $movie_id 動画ID
 * @property int $movie_type 動画タイプ
 * @property string $movie_title 動画タイトル
 * @property string $movie_url 元URLリンク
 * @property int $viewed_rate 閲覧率
 * @property string $created_at 作成日時
 * @property string $updated_at 更新日時
 * @property string|null $deleted_at 削除日時
 * @method static MovieLog create(array $attributes = [])
 */
class MovieLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'movie_log';

    protected $fillable = [
        'building_id',
        'customer_id',
        'view_id',
        'movie_id',
        'movie_type',
        'movie_title',
        'movie_url',
        'viewed_rate',
    ];
}

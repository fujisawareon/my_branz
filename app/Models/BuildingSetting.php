<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BuildingSetting
 *
 * @property int $building_id 物件ID
 * @property string $sales_suspension_title 販売停止タイトル
 * @property string $sales_suspension_message 販売停止メッセージ
 * @property string|null $location 所在地
 * @property string|null $nearest_station 最寄り
 * @property int $max_building_price 分譲価格最大値
 * @property float $max_interest_rate 金利最大値
 * @property string $building_site_url 物件サイトURL
 * @property bool $building_site_display_flg 物件サイト表示フラグ
 * @property string|null $image_gallery_annotation 画像ギャラリー注釈文
 * @property string|null $local_photo_annotation 現地写真設定注釈文
 * @property string|null $environment_image_path 間取環境性能画像
 * @property string|null $annotation_text 間取注釈文
 * @property string|null $area_map_address 周辺マップ住所
 * @property float|null $area_map_latitude 周辺マップ緯度
 * @property float|null $area_map_longitude 周辺マップ経度
 * @property \Illuminate\Support\Carbon $created_at 作成日時
 * @property int $created_by 作成者
 * @property \Illuminate\Support\Carbon $updated_at 更新日時
 * @property int|null $updated_by 更新者
 * @property \Illuminate\Support\Carbon|null $deleted_at 削除日時(ソフトデリート)
 * @method static BuildingSetting create(array $attributes = [])
 */
class BuildingSetting extends Model
{
    use SoftDeletes;

    protected $table = 'building_setting';

    protected $fillable = [
        'sales_suspension_title',
        'sales_suspension_message',
        'location',
        'nearest_station',
        'max_building_price',
        'max_interest_rate',
        'building_site_url',
        'building_site_display_flg',
        'image_gallery_annotation',
        'local_photo_annotation',
        'environment_image_path',
        'annotation_text',
        'area_map_address',
        'area_map_latitude',
        'area_map_longitude',
        'created_by',
        'updated_by',
    ];
}

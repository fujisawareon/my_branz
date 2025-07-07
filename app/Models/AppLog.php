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
 * @property string $page_key 限定コンテンツキー
 * @property int|null $floor_plan_id 間取プランID
 * @property int|null $binder_building_id 物件資料ID
 * @property string|null $stay_time 滞在時間
 * @property string $uid 識別ID
 * @property string $ip_address IPアドレス
 * @property string $browser ブラウザ
 * @property string|null $http_referer アクセス元
 * @property string $created_at 作成日時
 * @property string $updated_at 更新日時
 * @property string|null $deleted_at 削除日時
 * @method static AppLog create(array $attributes = [])
 */
class AppLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'app_log';

    protected $fillable = [
        'building_id',
        'customer_id',
        'page_key',
        'floor_plan_id',
        'binder_building_id',
        'stay_time',
        'uid',
        'ip_address',
        'browser',
        'http_referer',
    ];
}

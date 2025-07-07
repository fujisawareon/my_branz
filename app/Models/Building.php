<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id 物件ID
 * @property string $building_name 物件名
 * @property string $building_8_digit_code 物件8桁コード
 * @property string $building_4_digit_code 物件4桁コード
 * @property int $contents_design_flg 限定コンテンツデザイン
 * @property int $sales_status 販売フラグ
 * @property string|null $top_image TOP画像
 * @property string $thumbnail_image サムネイル画像
 * @property string $created_at 作成日時
 * @property int $created_by 作成者
 * @property string $updated_at 更新日時
 * @property int|null $updated_by 更新者
 * @property string|null $deleted_at 論理削除日時
 *
 * @property BuildingSetting $buildingSetting
 * @property-read Collection<int, Manager> $personCharge
 * @property-read Collection<int, ActionBtnSetting> $actionBtnSetting
 * @property-read Collection<int, BinderBuildingCategory> $binderBuildingCategory
 * @property-read Collection<int, SalesSchedule> $salesSchedule
 *
 */
class Building extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const SALES_STATUS_BEFORE_SALE = 1; // 販売前
    public const SALES_STATUS_ON_SALE = 2; // 販売中
    public const SALES_STATUS_CONTRACT_SOLD_OUT = 3; // 契約完売
    public const SALES_STATUS_DELIVERY_SOLD_OUT = 4; // 引渡完売
    public const SALES_STATUS = [
        self::SALES_STATUS_BEFORE_SALE => '準備中',
        self::SALES_STATUS_ON_SALE => '販売中',
        self::SALES_STATUS_CONTRACT_SOLD_OUT => '契約完売',
        self::SALES_STATUS_DELIVERY_SOLD_OUT => '引渡完売',
    ];

    /**
     * モデルと関連しているテーブル
     * @var string
     */
    protected $table = 'buildings';

    /**
     * 一括代入可能なカラム
     * @var string[]
     */
    protected $fillable = [
        'building_name',
        'building_8_digit_code',
        'building_4_digit_code',
        'sales_status',
        'site_url_flg',
        'site_url',
        'top_image',
        'thumbnail_image',
        'contents_url_flg',
        'created_by',
    ];

    /**
     * ブラックリスト
     * ※指定カラムのみ、create, fill, update不可
     * @var array
     */
    protected $guarded = [];

    /**
     * 物件設定情報とのリレーション
     * @return HasOne
     */
    public function buildingSetting(): HasOne
    {
        return $this->HasOne(BuildingSetting::class);
    }
}

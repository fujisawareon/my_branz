<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id ID
 * @property int $customer_id 顧客ID
 * @property int $building_id 物件ID
 * @property string|null $person_in_charge 担当者
 * @property string|null $zip_code_3 郵便番号3桁
 * @property string|null $zip_code_4 郵便番号4桁
 * @property string|null $prefecture_code 都道府県コード
 * @property string|null $prefecture 都道府県
 * @property string|null $city 市区町村
 * @property string|null $town 町名
 * @property string|null $chome 丁目
 * @property string|null $banchi 番地
 * @property string|null $apartment_detail 建物名・号室
 * @property string|null $country 国
 * @property string|null $address_extra その他住所
 * @property string $sumai_type 住宅の住まい
 * @property int $renew_flg 継続の有無
 * @property string|null $desired_plan 希望間取り
 * @property int|null $desired_area_min 希望面積（下限）
 * @property int|null $desired_area_max 希望面積（上限）
 * @property int|null $desired_price 希望価格
 * @property int|null $fund 自己資金
 * @property int|null $income 年収
 * @property int|null $household_income 世帯年収
 * @property int|null $expected_residents 想定入居人数
 * @property string|null $occupation 職業
 * @property string|null $office 勤務先
 * @property int $customer_status ステータス
 * @property int $is_inner インナー
 * @property int $is_online_seminar_watching オンラインセミナー動画視聴
 * @property int $is_online_sales_meeting_reserve オンライン商談予約
 * @property int $is_online_sales_meeting オンライン商談
 * @property int $is_free_observe_reserve フリー見学予約
 * @property int $is_free_observe フリー見学
 * @property int $is_first_visit_reserve 初来場予約
 * @property int $is_first_visit 初来場
 * @property int $is_needs_recept 要望受付
 * @property int $is_regist_recept 要望登録
 * @property int $is_apply 申込
 * @property int $is_contract 契約
 * @property int $is_handover 引渡し
 * @property int $is_stop_considering 検討中止
 * @property int|null $base_score 基本スコア
 * @property int|null $behavior_score 行動スコア
 * @property string|null $score スコア
 * @property int $relation_status 状態
 * @property string|null $entry_at エントリー日時
 * @property string|null $hp_inflow_type HP流入種別
 * @property string $created_at 作成日時
 * @property int $created_by 作成者
 * @property string $updated_at 更新日時
 * @property int|null $updated_by 更新者
 * @property string|null $deleted_at 削除日時
 * @method static CustomerBuilding create(array $attributes = [])
 */
class CustomerBuilding extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'customer_building';

    protected $fillable = [
        'customer_id',
        'building_id',
        'person_in_charge',
        'zip_code_3',
        'zip_code_4',
        'prefecture_code',
        'prefecture',
        'city',
        'town',
        'chome',
        'banchi',
        'apartment_detail',
        'country',
        'address_extra',
        'sumai_type',
        'renew_flg',
        'desired_plan',
        'desired_area_min',
        'desired_area_max',
        'desired_price',
        'fund',
        'income',
        'household_income',
        'expected_residents',
        'occupation',
        'office',
        'customer_status',
        'is_inner',
        'is_online_seminar_watching',
        'is_online_sales_meeting_reserve',
        'is_online_sales_meeting',
        'is_free_observe_reserve',
        'is_free_observe',
        'is_first_visit_reserve',
        'is_first_visit',
        'is_needs_recept',
        'is_regist_recept',
        'is_apply',
        'is_contract',
        'is_handover',
        'is_stop_considering',
        'base_score',
        'behavior_score',
        'score',
        'relation_status',
        'entry_at',
        'hp_inflow_type',
        'created_by',
        'updated_by',
    ];
}

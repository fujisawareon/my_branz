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
 * @property int $condominium_price 分譲価格（税込）
 * @property int $deposit 頭金
 * @property float $interest 金利
 * @property int $loan_period 借入期間
 * @property int $bonus_payment ボーナス払い（年2回）
 * @property int $monthly_fee 月々の支払金額（目安）
 * @property int $loan 借入額（分譲価格-頭金）
 * @property string $created_at 作成日時
 * @property string $updated_at 更新日時
 * @property string|null $deleted_at 削除日時
 * @method static LoanSimulationLog create(array $attributes = [])
 */
class LoanSimulationLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'loan_simulation_log';

    protected $fillable = [
        'building_id',
        'customer_id',
        'condominium_price',
        'deposit',
        'interest',
        'loan_period',
        'bonus_payment',
        'monthly_fee',
        'loan',
    ];
}

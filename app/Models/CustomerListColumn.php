<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id ID
 * @property int $building_id 物件ID
 * @property string $item_name 項目名
 * @property string $created_at 作成日時
 * @property int|null $created_by 作成者
 * @property string $updated_at 更新日時
 * @property int|null $updated_by 更新者
 * @property string|null $deleted_at 削除日時
 * @method static CustomerListColumn create(array $attributes = [])
 */
class CustomerListColumn extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'customer_list_column';

    protected $fillable = [
        'building_id',
        'item_name',
        'created_by',
        'updated_by',
    ];
}

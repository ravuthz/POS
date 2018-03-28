<?php

namespace App\Models;

use App\Traits\CrudsModelTrait;
use App\Traits\FieldsAuditTrait;
use App\Traits\SearchAndFilterTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes, FieldsAuditTrait, SearchAndFilterTrait, CrudsModelTrait;
    protected $dates = ['created_at', 'deleted_at', 'updated_at'];

    protected $fillable = ['type'];

    public function items()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function scopeGetItemProducts($query)
    {
        $query->with(['items' => function ($item) {
            $item->with('product');
        }]);
    }
}

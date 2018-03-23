<?php

namespace App\Models;

use App\Traits\FieldsAuditTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use SoftDeletes, FieldsAuditTrait;
    protected $dates = ['deleted_at'];

    protected $fillable = ['order_id', 'movement'];

    public function items()
    {
        return $this->hasMany(StockMovement::class);
    }
}

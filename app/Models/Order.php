<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\OrderProduct;
use App\Traits\FieldsAuditTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes, FieldsAuditTrait;
    protected $dates = ['deleted_at'];

    protected $fillable = ['ordered_by', 'ordered_at'];

    public function items() {
        return $this->hasMany(OrderProduct::class);
    }
    
    public function orderProduct($product, $quantity = 1, $customer = null) 
    {
        $customer = $customer ?: User::getCustomer()->id;
        $this->ordered_by = $customer;
        $this->ordered_at = Carbon::now();
        $this->save();
        
        $item = new OrderProduct();
        $item->product()->associate($product);
        $item->quantity = $quantity;
        $this->items()->save($item);
    }
}

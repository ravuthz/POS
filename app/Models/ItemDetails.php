<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemDetails extends Model
{
    protected $fillable = ['order_id', 'stock_id', 'product_id', 'price', 'quantity'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

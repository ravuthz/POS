<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    protected $fillable = ['stock_id', 'product_id', 'price', 'quantity'];
    
    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');    
    }
}

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
    
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    
    public function movements()
    {
        return $this->hasMany(StockMovement::class);
    }
    
    public function scopeMoveIns($query)
    {
        return $query->where('movement', 1)->with('movements');
    }
    
    public function scopeMoveOuts($query)
    {
        return $query->where('movement', 0)->with('movements');
    }
    
    public function increase($product, $price = null, $quantity = 1)
    {
        $this->movement = 1; // 1 in
        $this->save();
        
        $move = new StockMovement();
        $move->product()->associate($product);
        $move->quantity = $quantity;
        $move->price = ($price ?: $product->buy_price); // buy_price
        $this->movements()->save($move);
    }
    
    public function decrease($product, $price = null, $quantity = 1)
    {
        $this->movement = 0; // 0 out
        $this->save();
        
        $move = new StockMovement();
        $move->product()->associate($product);
        $move->quantity = (-1 * $quantity);
        $move->price = ($price ?:$product->sale_price); // sale_price
        $this->movements()->save($move);
    }
}

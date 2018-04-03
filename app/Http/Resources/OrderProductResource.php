<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
//            'id' => $this->id,
//            'order_id' => $this->order_id,
//            'product_id' => $this->product_id,
            'product_id' => $this->product->id,
            'product_name' => $this->product->name,
            'price' => $this->price,
            'quantity' => $this->quantity,
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name,
            'name_kh' => $this->name_kh,
            'image' => $this->image,
            'status' => $this->status,
            'buy_price' => $this->buy_price,
            'sale_price' => $this->sale_price
        ];
    }
}

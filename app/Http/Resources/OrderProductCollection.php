<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return OrderProductResource::collection($this->collection);
//        return $this->collection->transform(function ($item) {
//            return [
//                'id' => $item->id,
//                'order_id' => $item->order_id,
//                'product_id' => $item->product_id,
//                'quantity' => $item->quantity
//            ];
//        });
    }
}

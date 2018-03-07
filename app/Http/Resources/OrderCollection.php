<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($order) {
            return [
                'id' => $order->id,
                'items' => new OrderProductCollection($order->items),
                'stocks' => $order->stocks,
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at
            ];
        });
    }
}
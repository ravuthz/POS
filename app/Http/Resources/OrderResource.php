<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "type" => $this->type,
            "items" => new OrderProductCollection($this->items),
//            "stock" => $this->stock,
            "no_of_items" => $this->items->count(),
            "created_at" => $this->createdDate(),
            "created_by" => $this->createdUser(),
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StockResource extends JsonResource
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
            'id'         => $this->id,
            'movement'   => $this->movement,
            'items'      => $this->items,
            'amount'     => $this->amount,
            'created_at' => $this->created_at->format('d m Y')
        ];
    }
}

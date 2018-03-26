<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StockCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($item) {
            return [
                "id"         => $item->id,
                "movement"   => $item->movement,
                "created_at" => $item->created_at->format('d m Y'),
                "created_by" => $item->created_by,
                "updated_at" => $item->updated_at->format('d m Y'),
                "updated_by" => $item->updated_by
            ];
        });
    }
}

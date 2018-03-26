<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StockCollection;
use App\Http\Resources\StockResource;
use App\Models\Stock;
use App\Models\StockMovement;
use function foo\func;

class StockController extends Controller
{
    public function index()
    {
//        $stocks = Stock::all();

        $stocks = Stock::getItemProducts()->get();
        return new StockCollection($stocks);

//        return response()->json([
//            'stocks' => $stocks
//        ]);
    }

    public function show($id)
    {
//        $stock = Stock::with('items')->findOrFail($id);


        $stock = Stock::getItemProducts()->findOrFail($id);

        $amount = 0;
        foreach ($stock->items as $item) {
            $item->amount = $item->price * $item->quantity;
            $amount += $item->amount;
        }

        $stock->amount = $amount;

        return new StockResource($stock);
//        return response()->json([
//            'stock' => $stock
//        ]);
    }
}

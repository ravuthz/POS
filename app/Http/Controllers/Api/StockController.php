<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stock;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::all();

        return response()->json([
            'stocks' => $stocks
        ]);
    }

    public function show($id)
    {
        $stock = Stock::with('items')->findOrFail($id);
        $amount = [];
        foreach ($stock->items as $item) {
            $item->amount = $item->price * $item->quantity;
        }

        return response()->json([
            'stock' => $stock
        ]);
    }
}

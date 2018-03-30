<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StockCollection;
use App\Http\Resources\StockResource;
use App\Models\Stock;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::getItemProducts()->latest()->paginate(10);
        return new StockCollection($stocks);
    }

    public function create()
    {
        $stock = [
            'items' => []
        ];

        return response()
            ->json(['data' => $stock]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'items'              => 'required|array|min:1',
            'items.*.product_id' => 'required|integer|exists:products,id',
            'items.*.price'      => 'required|numeric|min:0',
            'items.*.quantity'   => 'required|integer|min:1'
        ]);
        $request['movement'] = 1;

        $items = [];
        foreach ($request->items as $item) {
            $items[] = new StockMovement($item);
        }

        $stock = new Stock($request->all());
        $stock->save();
        $stock->items()->saveMany($items);

        return response()->json([
            'saved'   => true,
            'id'      => $stock->id,
            'message' => 'You have successfully created NEW stock!'
        ]);
    }

    public function show($id)
    {
        $stock = Stock::getItemProducts()->findOrFail($id);
        return new StockResource($stock);
    }

    public function edit($id)
    {
        $stock = Stock::getItemProducts()->findOrFail($id);
        return new StockResource($stock);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'items'              => 'required|array|min:1',
            'items.*.product_id' => 'required|integer|exists:products,id',
            'items.*.price'      => 'required|numeric|min:0',
            'items.*.quantity'   => 'required|integer|min:1'
        ]);

        $stock = Stock::findOrFail($id);

        $newItems = [];
        $itemsUpdated = [];
        foreach ($request->items as $item) {
            if (isset($item['id'])) {
                StockMovement::where('stock_id', $stock->id)
                    ->where('id', $item['id'])
                    ->update(['price' => $item['price'], 'quantity' => $item['quantity']]);

                $itemsUpdated[] = $item['id'];
            } else {
                $newItems[] = new StockMovement($item);
            }
        }

        StockMovement::whereNotIn('id', $itemsUpdated)
            ->where('stock_id', $stock->id)
            ->delete();

        if (count($newItems)) {
            $stock->items()->saveMany($newItems);
        }

        return response()->json([
            'saved'   => true,
            'id'      => $stock->id,
            'message' => 'You have successfully updated recipe!'
        ]);
    }
}

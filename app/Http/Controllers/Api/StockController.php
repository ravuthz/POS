<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StockCollection;
use App\Http\Resources\StockResource;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::getItemProducts()->get();
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

        Stock::create();

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
}

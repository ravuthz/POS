<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StockCollection;
use App\Http\Resources\StockResource;
use App\Models\Stock;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::getItemProducts()->get();
        return new StockCollection($stocks);
    }

    public function show($id)
    {
        $stock = Stock::getItemProducts()->findOrFail($id);
        return new StockResource($stock);
    }
}

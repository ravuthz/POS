<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StockMovement;

class StockController extends Controller
{
    public function index()
    {
        $stocks = StockMovement::all();

        return response()->json([
            'stocks' => $stocks
        ]);
    }
}

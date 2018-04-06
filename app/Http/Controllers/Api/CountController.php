<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class CountController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function orders(Request $request) {
        if ($request->has('field') && $request->has('value')) {
            return Order::count($request->get('field'), $request->get('value'));
        }
    }
}

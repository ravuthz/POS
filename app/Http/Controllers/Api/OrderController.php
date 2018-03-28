<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::select();
        $filter = $request->get('filter');
        if (!empty($filter)) {
            $query->where('id', 'like', $request->get('filter'));
        }
        $orders = $query->getPageAndSort($request);
        return new OrderCollection($orders);
    }

    public function show($id)
    {
        $order = Order::getItemProducts()->findOrFail($id);
        $amount = 0;
        foreach ($order->items as $item) {
            $item->amount = $item->price * $item->quantity;
            $amount += $item->amount;
        }
        $order->amount = $amount;
        return new OrderResource($order);
    }

    public function store(Request $request)
    {
        $order = null;
        $items = $request->get('items', []);

        if (count($items) > 0) {
            $order = Order::create(['type' => 1]);
            foreach ($items as $item) {
                $product = Product::find($item['id']);

                if ($product) {
                    $itemDetails = new OrderProduct();
                    $itemDetails->product()->associate($product);
                    $itemDetails->price = $item['sale_price'];
                    $itemDetails->quantity = $item['qty'];
                    $order->items()->save($itemDetails);
                }
            }
        }
        return new OrderResource($order);
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $items = $request->get('items', []);

        if (count($items) > 0) {
            foreach ($items as $item) {
                $itemDetails = OrderProduct::where('order_id', $order->id)
                    ->where('id', $item['id'])->first();
                $itemDetails->price = $item['sale_price'];
                $itemDetails->quantity = $item['qty'];
                $itemDetails->save();
//                $order->items()->save($itemDetails);
            }
        }
        return new OrderResource($order);
    }
}

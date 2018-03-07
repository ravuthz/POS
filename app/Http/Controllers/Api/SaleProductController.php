<?php

namespace App\Http\Controllers\Api;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Stock;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCollection;
use App\Models\StockMovement;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaleProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $order = Order::first();
        
        // return [
        //     Order::first(),
        //     Stock::where('order_id', 1)->first()->id,
        //     StockMovement::first(),
        //     // $order->stock,
        //     // $order->stock->with('movements')->where('movement', 0)->get(),
        //     // $order->stock->with('movements')->where('movement', 0)->first()
        // ];
        
        return new OrderCollection(Order::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $items = $request->get('items', []);
        
        if (count($items) > 0) {
            $order = new Order();
            $stock = new Stock();
            
            // create order and ordered items
            foreach ($items as $item) {
                $product = Product::find($item['id']);
                if ($product) {
                    $order->orderProduct($product, $item['sale_price'], $item['qty']);
                    $stock->decrease($product, $item['sale_price'], $item['qty']);
                }
            }
            
            $order->stock()->save($stock);
        }
        
        // $order = new Order();
        // $order->orderProduct($product, 3);
        // $order->orderProduct($product, 3);
        
        // $stock1 = new Stock();
        // $stock1->decrease($product, 1);
        // $stock1->decrease($product, 1);
        
        return new OrderResource($order);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new OrderResource(Order::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $items = $request->get('items', []);
        
        if (count($items) > 0) {
            $stockId = Stock::where('order_id', $id)->first();
            
            foreach ($items as $item) {
                $oldOrderItem  = OrderProduct::where('order_id', $id)
                    ->where('product_id', $item['id'])->first();
                    
                if ($oldOrderItem) {
                    $oldOrderItem->price = $item['sale_price'];
                    $oldOrderItem->quantity = $item['qty'];
                    $oldOrderItem->save();    
                }
                
                $oldStockItem = StockMovement::where('stock_id', $stockId)
                    ->where('product_id', $item['id'])->first();
                
                if ($oldStockItem) {
                    $oldStockItem->price = $item['sale_price'];
                    $oldStockItem->quantity = $item['qty'];
                    $oldStockItem->save();
                }
                
                dd( [
                    $oldOrderItem, $oldStockItem
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        new OrderResource($order);
    }
}

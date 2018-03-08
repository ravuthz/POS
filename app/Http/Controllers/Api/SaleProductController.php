<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SaleCollection;
use App\Http\Resources\SaleResource;
use App\Models\ItemDetails;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Stock;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaleProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new SaleCollection(Sale::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $items = $request->get('items', []);

        if (count($items) > 0) {
            $order = Order::create([
                'ordered_by' => optional(User::getCustomer())->id,
                'ordered_at' => Carbon::now()
            ]);

            $stock = Stock::create([
                'movement' => 1
            ]);

            $sale = new Sale();

            foreach ($items as $item) {
                $product = Product::find($item['id']);

                if ($product) {
                    $itemDetails = new ItemDetails();
                    $itemDetails->product()->associate($product);
                    $itemDetails->price = $item['sale_price'];
                    $itemDetails->quantity = $item['qty'];

                    $order->items()->save($itemDetails);
                    $stock->items()->save($itemDetails);
                }
            }

            $sale->order()->associate($order);
            $sale->stock()->associate($stock);
            $sale->save();
        }

        return new SaleResource($sale);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new SaleResource(Sale::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $items = $request->get('items', []);
        $sale = Sale::find($id);

        if (count($items) > 0 && $sale) {
            foreach ($items as $item) {
                $itemDetails = ItemDetails
                    ::where('order_id', $sale->order->id)
                    ->where('stock_id', $sale->stock->id)
                    ->where('product_id', $item['id'])
                    ->first();
                if ($itemDetails) {
                    $itemDetails->price = $item['sale_price'];
                    $itemDetails->quantity = $item['qty'];
                    $itemDetails->save();
                }
            }
        }

        return new SaleResource($sale);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale = Sale::find($id);
        $sale->delete();
        return new SaleResource($sale);
    }
}

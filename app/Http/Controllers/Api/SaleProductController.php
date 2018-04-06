<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SaleCollection;
use App\Http\Resources\SaleResource;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SettingItem;
use App\Models\SettingType;
use App\Models\Stock;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class SaleProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return SaleCollection
     */
    public function index()
    {
        $sales = Sale::orderBy('id', 'desc')->latest()->get();
        return new SaleCollection($sales);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return SaleResource
     */
    public function store(Request $request)
    {
        $items = $request->get('items', []);

        if (count($items) > 0) {

            $sold = SettingItem::whereSlug('sold')->first();
            $order = Order::create(['type' => $sold->id]);

            $stock = Stock::create([
                'movement' => 0
            ]);

            $sale = new Sale();

            foreach ($items as $item) {
                $product = Product::find($item['id']);

                if ($product) {
                    $itemDetails = new StockMovement();
                    $itemDetails->product()->associate($product);
                    $itemDetails->price = $item['sale_price'];
                    $itemDetails->quantity = $item['qty'];

                    $stock->items()->save($itemDetails);

                    $orderItem = new OrderProduct();
                    $orderItem->product()->associate($product);
                    $orderItem->price = $item['sale_price'];
                    $orderItem->quantity = $item['qty'];

                    $order->items()->save($orderItem);
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
     * @return SaleResource
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
     * @return SaleResource
     */
    public function update(Request $request, $id)
    {
        $items = $request->get('items', []);
        $sale = Sale::find($id);

        if (count($items) > 0 && $sale) {
            foreach ($items as $item) {

                $itemDetails = StockMovement::where('stock_id', $sale->stock->id)
                    ->where('product_id', $item['id'])->first();

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
     * @return SaleResource
     */
    public function destroy($id)
    {
        $sale = Sale::find($id);
        $sale->delete();
        return new SaleResource($sale);
    }
}

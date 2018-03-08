<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Stock;
use App\Models\StockMovement;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private function newProducts()
    {
        return [
            Product::firstOrCreate([
                'name'        => 'hat',
                'name_kh'     => 'មួក',
                'buy_price'   => 10000,
                'sale_price'  => 12000,
                'category_id' => 1
            ]),
            Product::firstOrCreate([
                'name'        => 'shirt',
                'name_kh'     => 'អាវយឺត',
                'buy_price'   => 30000,
                'sale_price'  => 40000,
                'category_id' => 1
            ])
        ];
    }

    public function sales(Request $request)
    {
        $seller = Auth::user();
        $customer = User::getCustomer();
        $products = $this->newProducts();

        // order items

        $item1 = new OrderProduct();
        $item1->product()->associate($products[0]);
        $item1->quantity = 1;

        $item2 = new OrderProduct();
        $item2->product_id = $products[1]->id;
        $item2->quantity = 2;

        // sale 1
        $order1 = new Order();
        $order1->ordered_by = $customer->id;
        $order1->ordered_at = Carbon::now();
        $order1->save();
        $order1->items()->save($item1);

        // sale 2
        $order2 = new Order();
        $order2->ordered_at = Carbon::now();
        $seller->orders()->save($order2);
        $order2->items()->save($item2);

        // sale 3
        $order3 = new Order();
        $order3->orderProduct($products[0], 3);
        $order3->orderProduct($products[1], 3);
        $order3->orderProduct($products[0], 100, 1);
        $order3->orderProduct($products[1], 100, 1);

        $stock1 = new Stock();
        $stock1->increase($products[0], 100);
        $stock1->increase($products[1], 100);

        $stock1 = new Stock();
        $stock1->decrease($products[0], 1);
        $stock1->decrease($products[1], 1);

        return [
            'orders' => Order::with('items')->select('id', 'ordered_by', 'created_by')->latest()->get(),
            'stocks' => Stock::with('movements')->select('id', 'created_by')->latest()->get(),

            'stock-in'           => Stock::where('movement', 1)->get(),
            'stock-out'          => Stock::where('movement', 0)->get(),
            'stock-now-price'    => StockMovement::sum('price'),
            'stock-now-quantity' => StockMovement::sum('quantity'),

            'seller' => $seller->toArray(),

            'order1' => $order1->toArray(),
            'item1'  => $item1->toArray(),

            'order2' => $order2->toArray(),
            'item2'  => $item2->toArray()
        ];

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Product::getNamePageSort($request);
        return new ProductCollection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Product();
        $data->fill($request->all());
        $data->save();
        return new ProductResource($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Product::findOrFail($id);
        return new ProductResource($data);
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
        $data = Product::findOrFail($id);
        $data->fill($request->all());
        $data->save();
        return new ProductResource($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Product::findOrFail($id);
        $data->delete();
        return new ProductResource($data);
    }
}

<?php

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order::class, 10)->create(['type' => 1])->each(function ($stock) {
            $items = factory(OrderProduct::class, 5)->make()->each(function ($item) {
                $item->product()->associate(factory(Product::class)->create());
            });
            $stock->items()->saveMany($items);
        });

        factory(Order::class, 3)->create(['type' => 0])->each(function ($stock) {
            $items = factory(OrderProduct::class, 2)->make()->each(function ($item) {
                $item->product()->associate(factory(Product::class)->create());
            });
            $stock->items()->saveMany($items);
        });
    }
}

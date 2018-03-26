<?php

use App\Models\Product;
use App\Models\Stock;
use App\Models\StockMovement;
use Illuminate\Database\Seeder;

class StocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Stock::class, 5)->create(['movement' => 1])->each(function ($stock) {
            $items = factory(StockMovement::class, 5)->make()->each(function ($item) {
                $item->product()->associate(factory(Product::class)->create());
            });
            $stock->items()->saveMany($items);
        });

        factory(Stock::class, 3)->create(['movement' => 0])->each(function ($stock) {
            $items = factory(StockMovement::class, 2)->make()->each(function ($item) {
                $item->product()->associate(factory(Product::class)->create());
            });
            $stock->items()->saveMany($items);
        });
    }
}

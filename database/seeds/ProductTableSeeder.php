<?php

use App\Models\Product;
use App\User;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Auth::login(User::first());

        factory(Product::class, 10)->create(['category_id' => 1]);
        factory(Product::class, 20)->create(['category_id' => 2]);
        factory(Product::class, 30)->create(['category_id' => 3]);
        factory(Product::class, 40)->create(['category_id' => 4]);

        $product1 = Product::first();
        $product1->status = 0;
        $product1->save();

        $product2 = Product::find(2);
        $product2->delete();
    }
}

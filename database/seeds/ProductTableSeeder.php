<?php

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
        DB::table('products')->insert([
            'slug' => str_random(10),
            'name' => str_random(10),
            'note' => str_random(10),
            'category_id' => rand(1, 5),
            'buy_price' => 123,
            'sale_price' => 134,
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ]);
    }
}

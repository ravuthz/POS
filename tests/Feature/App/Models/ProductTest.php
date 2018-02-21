<?php

namespace Tests\Feature\App\Models;

use App\Models\Product;
use App\User;
use Auth;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        Product::truncate();
        Auth::login(factory(User::class)->create());
        factory(Product::class)->create(['category_id' => 102, 'name' => 'product 2']);
        factory(Product::class)->create(['category_id' => 103, 'name' => 'product 3']);
        factory(Product::class)->create(['category_id' => 104, 'name' => 'product 4']);
    }

    public function testCreateProduct()
    {
        factory(Product::class)->create(['category_id' => 101, 'name' => 'product 1']);
        $this->assertDatabaseHas('products', ['category_id' => 101, 'name' => 'product 1', 'slug' => 'product-1']);
    }

    public function testUpdateProduct()
    {
        $product2 = Product::where('slug', 'product-2')->first();
        $product2->status = 0;
        $product2->save();
        $this->assertDatabaseHas('products', ['category_id' => 102, 'name' => 'product 2', 'slug' => 'product-2']);
    }

    public function testDeleteProduct()
    {
        $product3 = Product::where('slug', 'product-3')->first();
        $product3->delete();
        $this->assertSoftDeleted('products', ['category_id' => 103, 'name' => 'product 3', 'slug' => 'product-3']);
    }

    public function testFetchProduct()
    {
        $product1 = Product::where('slug', 'product-4')->first();
        $this->assertDatabaseHas('products', $product1->toArray());
    }
}

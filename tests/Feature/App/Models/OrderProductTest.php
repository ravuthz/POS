<?php

namespace Tests\Feature\App\Models;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\User;
use Auth;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class OrderProductTest extends TestCase
{
    use DatabaseTransactions;

    private $orders = 'orders';
    private $items = 'order_products';
    private $products = 'products';

    public function setUp()
    {
        parent::setUp();
        Order::truncate();
        Auth::login(factory(User::class)->create());
        factory(Order::class, 3)->create();
        factory(OrderProduct::class, 30)->create();
        factory(OrderProduct::class, 40)->create();
    }

    public function testOrderOneProduct()
    {
        $order1 = Order::first();
        $item1 = factory(OrderProduct::class)->create();
        $order1->items()->save($item1);
        $this->assertDatabaseHas($this->items, $item1->toArray());
    }

    public function testOrderSomeProducts()
    {
        $item1 = factory(OrderProduct::class)->create();
        $item2 = factory(OrderProduct::class)->create();
        $item3 = factory(OrderProduct::class)->create();

        $order2 = Order::find(2);
        $order2->items()->saveMany([$item1, $item2, $item3]);

        $this->assertDatabaseHas($this->items, $item1->toArray());
        $this->assertDatabaseHas($this->items, $item2->toArray());
        $this->assertDatabaseHas($this->items, $item3->toArray());
    }

    public function testOrderAssociateProduct()
    {
        $order3 = Order::find(3);
        $product3 = Product::find(3);
        $order3->items()->first()->product()->associate($product3);

        $this->assertDatabaseHas($this->products, $product3->toArray());
    }

    public function testOrderDissociateProduct()
    {
        $order3 = Order::find(3);
        $product3 = Product::find(3);
        $order3->items()->first()->product()->dissociate($product3);

        $this->assertDatabaseHas($this->products, $product3->toArray());
    }

}

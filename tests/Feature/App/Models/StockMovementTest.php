<?php

namespace Tests\Feature\App\Models;

use Auth;
use App\Models\User;
use Tests\TestCase;
use App\Models\Stock;
use App\Models\StockMovement;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StockMovementTest extends TestCase
{
    use RefreshDatabase;
    
    private $stocks = 'stocks';
    private $stock_movement = 'stock_movement';

    public function setUp()
    {
        parent::setUp();
        Auth::login(factory(User::class)->create());
    }
    
    public function testStockMovementIn()
    {
        $stock = Stock::create(['movement' => 1]);
        $items = factory(StockMovement::class)->create();
        
        $stock->movements()->save($items);
        $this->assertDatabaseHas($this->stocks, $stock->toArray());
    }
    
    public function testStockMovementOut()
    {
        $stock = Stock::create(['movement' => 0]);
        $items = factory(StockMovement::class)->create();
        
        $stock->movements()->save($items);
        $this->assertDatabaseHas($this->stocks, $stock->toArray());
    }

    public function factoryStockIn()
    {
        $stocks = factory(Stock::class, 10)->create(['movement' => 1])
            ->each(function($stock) {
                $items = factory(StockMovement::class, 10)->create();
                $stock->movements()->saveMany($items);   
                $stock->movements()->save(factory(StockMovement::class)->create());
                $stock->save();
            });
        $this->assertDatabaseHas($this->stocks, $stocks->toArray());
    }

    public function factoryStockOut()
    {
        $stocks = factory(Stock::class, 10)->create(['movement' => 0])
            ->each(function($stock) {
                $items = factory(StockMovement::class, 10)->create();
                $stock->movements()->saveMany($items);   
                $stock->movements()->save(factory(StockMovement::class)->create());
                $stock->save();
            });
        $this->assertDatabaseHas($this->stocks, $stocks->toArray());
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use App\Traits\CrudsControllerTrait;

class StockController extends Controller
{
    use CrudsControllerTrait;

    protected $itemName = 'stock_item';
    protected $listName = 'stock_list';

    protected $modelPath = StockMovement::class;
    protected $viewPrefix = 'stocks.';
    protected $routePrefix = 'stocks';
    public function __construct()
    {
        $this->initialize();
        $this->setPageTitle("Stock");
        $this->setSiteTitle("Stocks");
        $this->data['products'] = Product::pluck('name', 'id');
    }
}

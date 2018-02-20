<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Traits\CrudsControllerTrait;

class OrderController extends Controller
{
    use CrudsControllerTrait;

    protected $itemName = 'order_item';
    protected $listName = 'order_list';

    protected $modelPath = Order::class;
    protected $viewPrefix = 'orders.';
    protected $routePrefix = 'orders';
    public function __construct()
    {
        $this->initialize();
        $this->setPageTitle("Order");
        $this->setSiteTitle("Orders");
    }
}

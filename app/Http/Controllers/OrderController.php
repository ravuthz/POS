<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Traits\Authorizable;
use App\Traits\CrudsControllerTrait;

class OrderController extends Controller
{
    use Authorizable;
    use CrudsControllerTrait;

    protected $itemName = 'order';
    protected $listName = 'orders';
    protected $modelPath = Order::class;
    protected $viewPrefix = 'orders';
    protected $routePrefix = 'orders';

    public function __construct()
    {
        try {
            $this->initialize();
            $this->setPageTitle("Order");
            $this->setSiteTitle("Orders");
            $this->data['products_list'] = Product::pluck('name', 'id');
            $this->data['order_types_list'] = ['Book', 'Paid', 'Cancel'];
        } catch (Exception $e) {
            Log::debug($e);
        }
    }
}

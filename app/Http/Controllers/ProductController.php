<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Traits\CrudsControllerTrait;

class ProductController extends Controller
{
    use CrudsControllerTrait;

    protected $itemName = 'product_item';
    protected $listName = 'product_list';

    protected $modelPath = Product::class;
    protected $viewPrefix = 'products.';
    protected $routePrefix = 'products';
    public function __construct()
    {
        $this->initialize();
        $this->setPageTitle("Product");
        $this->setSiteTitle("Products");
    }
}

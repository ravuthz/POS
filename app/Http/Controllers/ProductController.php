<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $this->setSiteTitle('Product');
        $this->setPageTitle('Products');
        $this->data['categories'] = Category::pluck('name', 'id');
    }

    // Override query all data with search form
    public function getFilterData($request = null)
    {
        $name = $request->get('name', '');
        return Product::searchName($name)->latest()->paginate(10);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\CrudsControllerTrait;

class CategoryController extends Controller
{
    use CrudsControllerTrait;

    protected $itemName = 'category_item';
    protected $listName = 'category_list';
    protected $modelPath = Category::class;
    protected $viewPrefix = 'categories.';
    protected $routePrefix = 'categories';
    public function __construct()
    {
        $this->initialize();
        $this->setPageTitle("Category");
        $this->setSiteTitle("Categories");
        $this->data['parent_lists'] = Category::where('parent_id', '0')
            ->pluck('name', 'id')->prepend('No Parent', '0');
    }
    
    // Override query all data with search form
    public function getFilterData($request = null)
    {
        $name = $request->get('name', '');
        return Category::searchName($name)->latest()->paginate(10);
    }
}

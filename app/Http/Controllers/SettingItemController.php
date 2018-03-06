<?php

namespace App\Http\Controllers;

use App\Models\SettingItem;
use App\Models\SettingType;
use App\Traits\CrudsControllerTrait;

class SettingItemController extends Controller
{
    use CrudsControllerTrait;

    protected $itemName = 'settingitem_item';
    protected $listName = 'settingitem_list';

    protected $modelPath = SettingItem::class;
    protected $viewPrefix = 'settingitems.';
    protected $routePrefix = 'settingitems';
    public function __construct()
    {
        $this->initialize();
        $this->setPageTitle("SettingItem");
        $this->setSiteTitle("SettingItems");
        $this->data['parent_lists'] = SettingType::pluck('name', 'id')->prepend('No Parent', '0');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\SettingType;
use App\Traits\CrudsControllerTrait;

class SettingTypeController extends Controller
{
    use CrudsControllerTrait;

    protected $itemName = 'settingtype_item';
    protected $listName = 'settingtype_list';

    protected $modelPath = SettingType::class;
    protected $viewPrefix = 'settingtypes.';
    protected $routePrefix = 'settingtypes';
    public function __construct()
    {
        $this->initialize();
        $this->setPageTitle("SettingType");
        $this->setSiteTitle("SettingTypes");
    }
}
